<?php

namespace App\Console\Commands;

use App\Services\TelegramNotifier;
use Illuminate\Console\Command;

class TelegramChats extends Command
{
    protected $signature = 'genla:telegram:chats';

    protected $description = 'Показать чаты/группы, куда добавлен бот, и их chat_id (для настройки выгрузки заявок)';

    public function handle(TelegramNotifier $telegram): int
    {
        if ($telegram->token() === '') {
            $this->error('GENLA_NOTIFY_TELEGRAM_TOKEN не задан в .env.');
            $this->line('1) Создайте бота через @BotFather, скопируйте токен.');
            $this->line('2) Вставьте его: GENLA_NOTIFY_TELEGRAM_TOKEN=...');
            $this->line('3) php artisan config:clear, затем повторите команду.');

            return self::FAILURE;
        }

        $me = $telegram->getMe();
        if (! $me || ! $me->json('ok')) {
            $this->error('Токен недействителен. Ответ Telegram: '.($me ? $me->body() : 'нет ответа'));

            return self::FAILURE;
        }

        $bot = (string) $me->json('result.username');
        $this->info('Бот: @'.$bot);

        $invite = (string) config('genla.notify.telegram_invite');
        if ($invite !== '') {
            $this->line('Группа заявок: '.$invite);
            $this->line('Добавьте @'.$bot.' в группу, напишите там любое сообщение и повторите команду.');
        }
        $this->newLine();

        $updates = $telegram->getUpdates();
        if (! $updates || ! $updates->json('ok')) {
            $this->error('Не удалось получить апдейты: '.($updates ? $updates->body() : 'нет ответа'));

            return self::FAILURE;
        }

        $chats = [];
        foreach ((array) $updates->json('result', []) as $update) {
            foreach (['message', 'channel_post', 'my_chat_member'] as $key) {
                $chat = data_get($update, $key.'.chat');
                if (is_array($chat) && isset($chat['id'])) {
                    $title = $chat['title']
                        ?? trim(($chat['first_name'] ?? '').' '.($chat['last_name'] ?? ''));
                    $chats[$chat['id']] = [
                        $chat['id'],
                        $chat['type'] ?? '—',
                        $title !== '' ? $title : ($chat['username'] ?? '—'),
                    ];
                }
            }
        }

        if (empty($chats)) {
            $this->warn('Чаты не найдены.');
            $this->line('• Добавьте бота в группу и напишите там сообщение, затем повторите команду.');
            $this->line('• В @BotFather отключите Privacy Mode (Bot Settings → Group Privacy → Turn off),');
            $this->line('  иначе бот не «видит» сообщения в группе.');

            return self::SUCCESS;
        }

        $this->table(['chat_id', 'тип', 'название'], array_values($chats));
        $this->newLine();
        $this->line('Скопируйте chat_id нужной группы в .env:');
        $this->line('  GENLA_NOTIFY_TELEGRAM_CHAT=<chat_id>');
        $this->line('  GENLA_NOTIFY_ENABLED=true');
        $this->line('Затем: php artisan config:clear && php artisan genla:telegram:test');

        return self::SUCCESS;
    }
}
