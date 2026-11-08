<?php

namespace App\Services\GenlaAi\Drivers;

use App\Services\GenlaAi\AssistantReply;
use App\Services\GenlaAi\Contracts\AssistantDriver;
use App\Support\Genla;

/**
 * Сценарный ассистент: маршрутизирует пользователя по лабораториям и
 * предлагает целевое действие (консультация / презентация / звонок).
 * Работает без внешних ключей и интернета. Тексты — из lang по локали,
 * ключевые слова — RU + EN для распознавания обоих языков.
 */
class ScriptedDriver implements AssistantDriver
{
    /** Ключевые слова (RU+EN) → лаборатория. */
    private const LAB_KEYWORDS = [
        'genbox' => ['сервер', 'gpu', 'видеокарт', 'оборудован', 'станци', 'суперкомпьютер', 'железо', 'dgx', 'nvidia', 'dell', 'asus', 'мощност', 'server', 'graphics', 'hardware', 'workstation', 'supercomputer', 'compute power'],
        'genblock' => ['кластер', 'инфраструктур', 'вычислит', 'платформ', 'дата-центр', 'цод', 'cluster', 'infrastructure', 'compute', 'platform', 'data center', 'datacenter'],
        'genetics' => ['обучени', 'llm', 'дообуч', 'fine', 'нейросет', 'своя модель', 'корпоративн', 'training', 'fine-tun', 'neural', 'own model', 'corporate'],
        'genup' => ['ассистент', 'копилот', 'crm', 'мессенджер', 'чат-бот', 'база знаний', 'поддержк клиент', 'assistant', 'copilot', 'messenger', 'chatbot', 'knowledge base', 'customer support'],
        'genclaw' => ['агент', 'автономн', 'автоматиз', 'цифров сотрудник', 'рутин', 'agent', 'autonomous', 'automat', 'digital employee', 'routine'],
        'gensec' => ['разработ', 'приложен', 'сайт', 'erp', 'код', 'веб-серв', 'софт', 'программ', 'mvp', 'develop', 'application', 'app', 'website', 'web service', 'software'],
        'genreview' => ['аудит', 'стратеги', 'дорожн', 'эффект', 'окупаем', 'анализ процесс', 'roi', 'оценк', 'audit', 'strateg', 'roadmap', 'payback', 'assessment'],
        'genx' => ['с чего начать', 'начать', 'старт', 'познаком', 'бесплатн', 'с нуля', 'не знаю', 'where to start', 'getting started', 'start', 'free', 'from scratch'],
    ];

    /** Ключевые слова (RU+EN) → действие. */
    private const ACTION_KEYWORDS = [
        'presentation' => ['презентац', 'материал', 'pdf', 'presentation', 'deck', 'materials'],
        'call' => ['звон', 'перезвон', 'позвон', 'телефон', 'call', 'phone', 'ring'],
        'consultation' => ['консультац', 'обсуд', 'цена', 'стоимост', 'сколько стоит', 'связаться', 'менеджер', 'поговорить', 'consult', 'discuss', 'price', 'cost', 'how much', 'contact', 'manager', 'talk'],
    ];

    private const GREETINGS = ['привет', 'здравств', 'добрый день', 'добрый вечер', 'доброе утро', 'hello', 'хай', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'];

    private const OVERVIEW = ['лаборатор', 'направлен', 'что умеет', 'что вы дела', 'чем занима', 'genla os', 'экосистем', 'весь список', 'lab', 'direction', 'what can you', 'what do you do', 'ecosystem', 'full list'];

    public function reply(string $message, array $history = [], ?string $parentMessageId = null): AssistantReply
    {
        $m = mb_strtolower(trim($message));

        $action = $this->detectAction($m);
        $lab = $this->detectLab($m);

        // Приветствие (если ничего конкретного не запрошено)
        if (! $lab && ! $action && $this->matchesAny($m, self::GREETINGS)) {
            return new AssistantReply(
                __('genla.scripted.greeting'),
                (array) __('genla.scripted.greeting_suggestions'),
            );
        }

        // Обзор экосистемы
        if (! $lab && $this->matchesAny($m, self::OVERVIEW)) {
            return new AssistantReply(
                __('genla.scripted.overview'),
                (array) __('genla.scripted.overview_suggestions'),
            );
        }

        // Нашли лабораторию
        if ($lab && ($labData = Genla::lab($lab)) !== null) {
            return new AssistantReply(
                __('genla.scripted.lab_match', [
                    'name' => $labData['name'] ?? $lab,
                    'sub' => $labData['hero_subtitle'] ?? '',
                ]),
                (array) __('genla.scripted.lab_match_suggestions'),
                $action,
                $lab,
            );
        }

        // Действие без привязки к лаборатории
        if ($action) {
            return new AssistantReply(
                __('genla.scripted.action_'.$action),
                (array) __('genla.scripted.action_suggestions'),
                $action,
            );
        }

        // Не поняли — мягко уточняем
        return new AssistantReply(
            __('genla.scripted.fallback'),
            (array) __('genla.scripted.fallback_suggestions'),
        );
    }

    private function detectLab(string $m): ?string
    {
        $best = null;
        $bestScore = 0;

        foreach (self::LAB_KEYWORDS as $slug => $words) {
            $score = 0;
            foreach ($words as $w) {
                if (str_contains($m, $w)) {
                    $score++;
                }
            }
            if ($score > $bestScore) {
                $bestScore = $score;
                $best = $slug;
            }
        }

        return $best;
    }

    private function detectAction(string $m): ?string
    {
        foreach (self::ACTION_KEYWORDS as $action => $words) {
            if ($this->matchesAny($m, $words)) {
                return $action;
            }
        }

        return null;
    }

    /** @param array<int,string> $needles */
    private function matchesAny(string $haystack, array $needles): bool
    {
        foreach ($needles as $n) {
            if (str_contains($haystack, $n)) {
                return true;
            }
        }

        return false;
    }
}
