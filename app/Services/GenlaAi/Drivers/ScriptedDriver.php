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
    /**
     * Ключевые слова (RU+EN) → направление.
     * Порядок важен только при равном числе совпадений (побеждает первое).
     */
    private const LAB_KEYWORDS = [
        'genfleet' => ['сервер', 'gpu', 'видеокарт', 'оборудован', 'станци', 'суперкомпьютер', 'железо', 'ноутбук', 'мощност', 'локальн модел', 'машинн зрен', 'видеонаблюден', 'камер', 'стойк', 'colocation', 'колокейшн', 'genbox', 'gencube', 'genbook', 'genview', 'genblock', 'unicorn', 'server', 'graphics', 'hardware', 'workstation', 'supercomputer', 'laptop', 'rack', 'compute power', 'local model', 'machine vision'],
        'gencloud' => ['облак', 'vps', 'vds', 'виртуальн', 'хранилищ', 'бэкап', 'резервное копир', 'гибридн', 'рабочее место', 'genspace', 'genrouter', 'gencloud', 'cloud', 'virtual server', 'storage', 'backup', 'hybrid', 'workspace'],
        'genclaw' => ['агент', 'автономн', 'цифров сотрудник', 'ассистент', 'копилот', 'чат-бот', 'помощник', 'рутин', 'автоматиз', 'genclaw', 'agent', 'autonomous', 'digital employee', 'assistant', 'copilot', 'chatbot', 'automat'],
        'gentype' => ['llm', 'дообуч', 'нейросет', 'своя модель', 'языков модел', 'база знаний', 'цифров генетик', 'gentype', 'fine-tun', 'neural', 'own model', 'language model', 'knowledge base'],
        'genpromo' => ['маркетинг', 'продвижен', 'реклам', 'позиционирован', 'бренд', 'seo', 'geo', 'контент', 'лид', 'продаж', 'вывод на рынок', 'сайт', 'marketing', 'promotion', 'advertis', 'positioning', 'brand', 'content', 'lead', 'sales', 'go-to-market', 'website'],
        'genx' => ['робот', 'роботиз', 'манипулятор', 'кобот', 'автономн систем', 'robot', 'cobot', 'robotics'],
        'gensec' => ['безопасн', 'кибербез', 'защит', 'уязвим', 'пентест', 'фишинг', 'дипфейк', 'утечк', 'gensec', 'security', 'cyber', 'protect', 'vulnerab', 'pentest', 'phishing', 'deepfake', 'leak'],
        'genreview' => ['аудит', 'диагностик', 'стратеги', 'консалт', 'консультац', 'разработ', 'обучени', 'окупаем', 'с чего начать', 'не знаю', 'audit', 'diagnost', 'strateg', 'consult', 'develop', 'training', 'where to start', 'getting started'],
    ];

    /** Ключевые слова (RU+EN) → действие. */
    private const ACTION_KEYWORDS = [
        'presentation' => ['презентац', 'материал', 'pdf', 'presentation', 'deck', 'materials'],
        'call' => ['звон', 'перезвон', 'позвон', 'телефон', 'call', 'phone', 'ring'],
        'consultation' => ['консультац', 'обсуд', 'цена', 'стоимост', 'сколько стоит', 'связаться', 'менеджер', 'поговорить', 'consult', 'discuss', 'price', 'cost', 'how much', 'contact', 'manager', 'talk'],
    ];

    private const GREETINGS = ['привет', 'здравств', 'добрый день', 'добрый вечер', 'доброе утро', 'hello', 'хай', 'hi', 'hey', 'good morning', 'good afternoon', 'good evening'];

    private const OVERVIEW = ['лаборатор', 'направлен', 'что умеет', 'что вы дела', 'чем занима', 'genla', 'экосистем', 'весь список', 'lab', 'direction', 'what can you', 'what do you do', 'ecosystem', 'full list'];

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
                    'sub' => mb_strtolower(mb_substr($labData['short'] ?? '', 0, 1)).mb_substr($labData['short'] ?? '', 1),
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
