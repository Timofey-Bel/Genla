<?php

namespace App\Services;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

/**
 * Захват лида прямо из диалога с AI-агентом — на случай, когда клиент
 * не дошёл до формы «Заказать консультацию».
 *
 * Агент в КОНЦЕ ответа может вернуть скрытый служебный блок:
 *
 *   <!--GENLA_LEAD
 *   { "name": "...", "contact": "...", "message": "...",
 *     "direction": "GenReview", "confidence": 0.85 }
 *   GENLA_LEAD-->
 *
 * Сервис: извлекает блок → создаёт Lead → уведомляет Telegram →
 * (опционально) пушит в CRM-вебхук. Пользователю возвращается текст без блока.
 */
class AiLeadCapture
{
    public function __construct(private TelegramNotifier $telegram) {}

    /**
     * @return array{0: string, 1: \App\Models\Lead|null}
     *         [текст ответа без служебного блока, созданный лид или null]
     */
    public function handle(string $message, Request $request): array
    {
        if (! preg_match('/<!--\s*GENLA_LEAD\s*(\{.*?\})\s*GENLA_LEAD\s*-->/s', $message, $m)) {
            return [$message, null];
        }

        $clean = trim(str_replace($m[0], '', $message));

        try {
            $payload = json_decode($m[1], true, 64, JSON_THROW_ON_ERROR);
        } catch (\JsonException $e) {
            Log::warning('GENLA_LEAD: невалидный JSON от агента', ['raw' => mb_substr($m[1], 0, 500)]);

            return [$clean, null];
        }

        $name = trim((string) ($payload['name'] ?? ''));
        $contact = trim((string) ($payload['contact'] ?? ''));

        // Сводка без контактов — это ещё не лид, ничего не создаём.
        if ($name === '' || $contact === '') {
            return [$clean, null];
        }

        // Дедуп: агент мог повторить блок в следующем сообщении того же диалога.
        if ($this->recentlyCaptured($contact)) {
            return [$clean !== '' ? $clean : $this->ack(), null];
        }

        $lead = $this->createLead($payload, $name, $contact, $request);
        if (! $lead) {
            return [$clean, null];
        }

        // Доставка после ответа клиенту: чат не ждёт сеть, сбой не ломает ответ.
        dispatch(function () use ($lead, $payload) {
            $this->telegram->sendLead($lead);
            $this->pushToCrm($lead, $payload);
        })->afterResponse();

        Log::info('GENLA_LEAD: лид создан из AI-чата', ['lead' => $lead->id]);

        return [$clean !== '' ? $clean : $this->ack(), $lead];
    }

    private function ack(): string
    {
        return 'Спасибо! Передал ваши данные команде Genla — мы свяжемся с вами в ближайшее время.';
    }

    private function createLead(array $p, string $name, string $contact, Request $request): ?Lead
    {
        $direction = $p['direction'] ?? $p['recommended_direction'] ?? $p['next_step'] ?? null;

        $attributes = [
            'name' => mb_substr($name, 0, 120),
            'contact' => mb_substr($contact, 0, 160),
            'email' => $this->extractEmail($contact, $p),
            'message' => $this->buildMessage($p, $direction),
            'action' => 'chat',
            'lab' => $this->resolveLab($direction),
            'source' => 'ai-chat',
            'ip' => $request->ip(),
            'user_agent' => mb_substr((string) $request->userAgent(), 0, 255),
        ];

        try {
            return Lead::create($this->keepExistingColumns($attributes));

        } catch (\Throwable $e) {
            Log::error('GENLA_LEAD: не удалось сохранить лид', ['error' => $e->getMessage()]);

            return null;
        }
    }

    /** "GenReview" → "genreview", если такое направление существует; иначе null. */
    private function resolveLab(?string $direction): ?string
    {
        $slug = strtolower(trim((string) $direction));

        return $slug !== '' && array_key_exists($slug, config('genla.labs', [])) ? $slug : null;
    }

    /** Собираем сводку агента в текст заявки (поддержка расширённой схемы). */
    private function buildMessage(array $p, ?string $direction): string
    {
        $parts = [];

        if (! empty($p['message'])) {
            $parts[] = (string) $p['message'];
        }

        $labels = [
            'client_goal' => 'Цель',
            'problem' => 'Задача',
            'constraints' => 'Ограничения',
            'business_context' => 'Контекст',
            'desired_result' => 'Желаемый результат',
        ];
        foreach ($labels as $key => $label) {
            if (! empty($p[$key])) {
                $value = is_array($p[$key]) ? implode(', ', $p[$key]) : $p[$key];
                $parts[] = $label.': '.$value;
            }
        }

        // Направление, которое не сопоставилось с реальным лабом — сохраняем текстом.
        if ($direction && $this->resolveLab($direction) === null) {
            $parts[] = 'Направление: '.$direction;
        }
        if (isset($p['confidence'])) {
            $parts[] = 'Уверенность: '.$p['confidence'];
        }

        return mb_substr(trim(implode("\n", $parts)), 0, 2000);
    }

    private function extractEmail(string $contact, array $p): ?string

    {
        if (! empty($p['email']) && filter_var($p['email'], FILTER_VALIDATE_EMAIL)) {
            return mb_substr((string) $p['email'], 0, 160);
        }

        return filter_var($contact, FILTER_VALIDATE_EMAIL) ? mb_substr($contact, 0, 160) : null;
    }

    /** Не плодим дубли: тот же контакт из чата за последние 30 минут — пропускаем. */
    private function recentlyCaptured(string $contact): bool
    {
        try {
            return Lead::where('contact', mb_substr($contact, 0, 160))
                ->where('source', 'ai-chat')
                ->where('created_at', '>=', now()->subMinutes(30))
                ->exists();
        } catch (\Throwable $e) {
            return false; // БД недоступна на чтение — лучше создать, чем потерять
        }
    }

    /** Опциональный пуш в CRM-вебхук (Bitrix24/amoCRM/своя CRM). Молчит, пока URL не задан. */
    private function pushToCrm(Lead $lead, array $payload): void
    {
        $url = trim((string) config('genla.crm.webhook_url'));
        if ($url === '') {
            return;
        }

        try {
            $response = Http::timeout(8)->asJson()->post($url, [
                'name' => $lead->name,
                'contact' => $lead->contact,
                'email' => $lead->email,
                'message' => $lead->message,
                'direction' => $lead->lab,
                'source' => 'ai-chat',
                'lead_id' => $lead->id,
                'raw' => $payload,
            ]);

            if (! $response->successful()) {
                Log::warning('GENLA_LEAD: CRM-вебхук отклонил запрос', [
                    'lead' => $lead->id,
                    'status' => $response->status(),
                ]);
            }
        } catch (\Throwable $e) {
            Log::warning('GENLA_LEAD: CRM-вебхук недоступен: '.$e->getMessage(), ['lead' => $lead->id]);
        }
    }


    private function keepExistingColumns(array $attributes): array
    {
        try {
            $columns = Schema::getColumnListing((new Lead)->getTable());
        } catch (\Throwable $e) {
            return $attributes;
        }

        return $columns ? array_intersect_key($attributes, array_flip($columns)) : $attributes;
    }
}