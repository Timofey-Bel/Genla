<?php

namespace App\Console\Commands;

use App\Services\TelegramNotifier;
use Illuminate\Console\Command;

class TelegramTest extends Command
{
    protected $signature = 'genla:telegram:test';

    protected $description = 'Отправить тестовое сообщение в Telegram-группу заявок';

    public function handle(TelegramNotifier $telegram): int
    {
        if (! $telegram->configured()) {
            $this->error('Не заданы GENLA_NOTIFY_TELEGRAM_TOKEN и/или GENLA_NOTIFY_TELEGRAM_CHAT в .env.');
            $this->line('Найти chat_id: php artisan genla:telegram:chats');

            return self::FAILURE;
        }

        if (! config('genla.notify.enabled')) {
            $this->warn('GENLA_NOTIFY_ENABLED=false — в проде заявки слаться не будут. Тест всё равно отправлю.');
        }

        $text = "✅ <b>Тест Genla</b>\n"
            ."Интеграция с Telegram работает — заявки с сайта будут приходить сюда.\n"
            .'<i>'.now()->timezone((string) config('genla.notify.timezone', 'Europe/Moscow'))->format('d.m.Y H:i').'</i>';

        $response = $telegram->send($text);

        if (! $response) {
            $this->error('Сообщение не отправлено (пустой токен или chat_id).');

            return self::FAILURE;
        }

        if ($response->json('ok')) {
            $this->info('Отправлено в chat_id '.$telegram->chat().'. Проверьте группу «Заявки с наших сайтов».');

            return self::SUCCESS;
        }

        $this->error('Telegram отклонил запрос: '.$response->body());
        $this->line('Проверьте: бот добавлен в группу (для канала — администратором);');
        $this->line('chat_id указан верно (для супергрупп/каналов вида -100xxxxxxxxxx).');

        return self::FAILURE;
    }
}
