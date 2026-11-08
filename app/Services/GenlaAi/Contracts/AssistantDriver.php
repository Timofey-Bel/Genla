<?php

namespace App\Services\GenlaAi\Contracts;

use App\Services\GenlaAi\AssistantReply;

interface AssistantDriver
{
    /**
     * Сформировать ответ на сообщение пользователя.
     *
     * @param  array<int,array{role:string,content:string}>  $history
     * @param  string|null  $parentMessageId  ID предыдущего сообщения (для продолжения диалога).
     */
    public function reply(string $message, array $history = [], ?string $parentMessageId = null): AssistantReply;
}
