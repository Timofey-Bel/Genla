<?php

namespace App\Services;

use App\Models\Lead;
use App\Support\Genla;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Доставка заявок с сайта в Telegram-группу «Заявки с наших сайтов».
 *
 * Группа: config('genla.notify.telegram_invite').
 * Реальная отправка идёт по числовому chat_id (config 'telegram_chat'),
 * который можно найти командой `php artisan genla:telegram:chats`.
 */
class TelegramNotifier
{
    public function token(): string
    {
        return trim((string) config('genla.notify.telegram_token'));
    }

    public function chat(): string
    {
        return trim((string) config('genla.notify.telegram_chat'));
    }

    public function configured(): bool
    {
        return $this->token() !== '' && $this->chat() !== '';
    }

    public function enabled(): bool
    {
        return (bool) config('genla.notify.enabled') && $this->configured();
    }

    /** Низкоуровневая отправка произвольного HTML-сообщения. */
    public function send(string $html, ?string $chat = null): ?Response
    {
        $token = $this->token();
        $chat = $chat !== null ? $chat : $this->chat();

        if ($token === '' || $chat === '') {
            return null;
        }

        return Http::timeout(8)
            ->retry(2, 250, throw: false)
            ->asForm()
            ->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chat,
                'text' => $html,
                'parse_mode' => 'HTML',
                'disable_web_page_preview' => true,
            ]);
    }

    /** Отправка заявки в группу. Не выбрасывает исключения — только логирует. */
    public function sendLead(Lead $lead): void
    {
        // Важно: причину пропуска всегда пишем в лог. Иначе получается ловушка
        // «тест работает, а реальные заявки не приходят»: команда genla:telegram:test
        // шлёт в обход флага enabled, а реальная заявка раньше молча терялась.
        if (! $this->configured()) {
            Log::warning('Telegram lead SKIPPED: не заданы GENLA_NOTIFY_TELEGRAM_TOKEN/CHAT.', ['lead' => $lead->id]);

            return;
        }

        if (! (bool) config('genla.notify.enabled')) {
            Log::warning('Telegram lead SKIPPED: GENLA_NOTIFY_ENABLED != true — реальные заявки не шлются (тест-команда шлёт всё равно).', ['lead' => $lead->id]);

            return;
        }

        try {
            $response = $this->send($this->formatLead($lead));

            if ($response && $response->successful()) {
                return;
            }

            // Группа была повышена до супергруппы → Telegram возвращает новый chat_id.
            // Досылаем по новому id и подсказываем в лог, что прописать в .env.
            $migrated = $response?->json('parameters.migrate_to_chat_id');
            if ($migrated) {
                Log::warning('Telegram: чат мигрировал в супергруппу. Обновите GENLA_NOTIFY_TELEGRAM_CHAT='.$migrated, [
                    'lead' => $lead->id,
                    'old_chat' => $this->chat(),
                    'new_chat' => $migrated,
                ]);

                $retry = $this->send($this->formatLead($lead), (string) $migrated);
                if ($retry && $retry->successful()) {
                    return;
                }
            }

            Log::warning('Telegram lead notify rejected', [
                'lead' => $lead->id,
                'status' => $response?->status(),
                'body' => $response?->body(),
            ]);
        } catch (\Throwable $e) {
            Log::warning('Telegram lead notify failed: '.$e->getMessage(), ['lead' => $lead->id]);
        }
    }

    /** getMe — проверка валидности токена. */
    public function getMe(): ?Response
    {
        $token = $this->token();
        if ($token === '') {
            return null;
        }

        return Http::timeout(8)->get("https://api.telegram.org/bot{$token}/getMe");
    }

    /** getUpdates — последние апдейты (для поиска chat_id групп/каналов). */
    public function getUpdates(): ?Response
    {
        $token = $this->token();
        if ($token === '') {
            return null;
        }

        return Http::timeout(8)->get("https://api.telegram.org/bot{$token}/getUpdates", [
            'allowed_updates' => '["message","channel_post","my_chat_member"]',
            'limit' => 100,
        ]);
    }

    /** Текст заявки (HTML для Telegram). */
    public function formatLead(Lead $lead): string
    {
        $e = static fn ($v) => htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8');

        $emojis = [
            'consultation' => '💬',
            'presentation' => '📑',
            'call' => '📞',
            'contact' => '✉️',
        ];
        $emoji = $emojis[$lead->action] ?? '🔔';

        $actionLabel = trans('genla.action_labels.'.$lead->action);
        if ($actionLabel === 'genla.action_labels.'.$lead->action) {
            $actionLabel = (string) $lead->action;
        }

        $direction = '—';
        if ($lead->lab) {
            try {
                $labData = Genla::lab($lead->lab);
                $name = $labData['name'] ?? $lead->lab;
                $url = ($labData['is_ai'] ?? false) ? Genla::aiUrl() : Genla::url($lead->lab);
                $direction = '<a href="'.$e($url).'">'.$e($name).'</a>';
            } catch (\Throwable $ex) {
                $direction = $e($lead->lab);
            }
        }

        $lines = [
            $emoji.' <b>Новая заявка</b> · genla.tech',
            '<b>'.$e($actionLabel).'</b>',
            '',
            '👤 <b>Имя:</b> '.$e($lead->name),
            '📲 <b>Контакт:</b> '.$this->contactLink((string) $lead->contact, $e),
        ];

        if (! empty($lead->email)) {
            $lines[] = '✉️ <b>Email:</b> <a href="mailto:'.$e($lead->email).'">'.$e($lead->email).'</a>';
        }

        $lines[] = '🧭 <b>Направление:</b> '.$direction;

        if (! empty($lead->source)) {
            $lines[] = '🌐 <b>Страница:</b> <code>'.$e($lead->source).'</code>';
        }

        if (! empty($lead->message)) {
            $lines[] = '';
            $lines[] = '📝 '.$e($lead->message);
        }

        $lines[] = '';
        $tz = (string) config('genla.notify.timezone', 'Europe/Moscow');
        $when = $lead->created_at?->copy()->timezone($tz)->format('d.m.Y H:i');
        $lines[] = '<i>#'.$lead->id.' · '.$e($when).' · IP '.$e($lead->ip).'</i>';

        return implode("\n", $lines);
    }

    /** Делает контакт кликабельным (email / телефон / @telegram). */
    private function contactLink(string $contact, callable $e): string
    {
        $c = trim($contact);

        if (filter_var($c, FILTER_VALIDATE_EMAIL)) {
            return '<a href="mailto:'.$e($c).'">'.$e($c).'</a>';
        }

        if (preg_match('/^@[A-Za-z0-9_]{4,}$/', $c)) {
            return '<a href="https://t.me/'.$e(ltrim($c, '@')).'">'.$e($c).'</a>';
        }

        $digits = preg_replace('/[^\d+]/', '', $c);
        if (is_string($digits) && preg_match('/^\+?\d{7,15}$/', $digits)) {
            return '<a href="tel:'.$e($digits).'">'.$e($c).'</a>';
        }

        return $e($c);
    }
}
