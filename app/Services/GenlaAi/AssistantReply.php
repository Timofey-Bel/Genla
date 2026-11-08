<?php

namespace App\Services\GenlaAi;

/**
 * Ответ ассистента GENLA AI (единый формат для любого драйвера).
 */
class AssistantReply
{
    /**
     * @param  string       $text         Текст ответа.
     * @param  array<int,string> $suggestions Быстрые подсказки (чипы).
     * @param  string|null  $action       Предлагаемое действие: consultation|presentation|call.
     * @param  string|null  $lab          Slug лаборатории, на которую стоит перейти.
     */
    public function __construct(
        public string $text,
        public array $suggestions = [],
        public ?string $action = null,
        public ?string $lab = null,
        public ?string $id = null,
    ) {
    }
}
