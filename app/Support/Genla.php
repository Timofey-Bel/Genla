<?php

namespace App\Support;

/**
 * Навигация по экосистеме GENLA + локализация контента.
 *
 * Единая точка построения URL (path ↔ subdomain) и подмешивания текстов
 * по текущей локали: структура лабораторий берётся из config/genla.php,
 * а тексты — из lang/{locale}/genla.php.
 */
class Genla
{
    /** @return array<string,array<string,mixed>> */
    public static function labs(): array
    {
        $result = [];
        foreach (array_keys(config('genla.labs', [])) as $slug) {
            $lab = self::lab($slug);
            if ($lab !== null) {
                $result[$slug] = $lab;
            }
        }

        return $result;
    }

    /**
     * Лаборатория: структура из config + тексты из lang (по текущей локали).
     *
     * @return array<string,mixed>|null
     */
    public static function lab(string $slug): ?array
    {
        $structure = config("genla.labs.$slug");

        if ($structure === null) {
            return null;
        }

        $texts = trans("genla.labs.$slug");

        return is_array($texts) ? array_merge($structure, $texts) : $structure;
    }

    /**
     * Лаборатории для сетки главной (в порядке из конфига).
     *
     * @return array<int,array<string,mixed>>
     */
    public static function gridLabs(): array
    {
        $result = [];
        foreach (config('genla.grid', []) as $slug) {
            $lab = self::lab($slug);
            if ($lab !== null) {
                $result[] = $lab;
            }
        }

        return $result;
    }

    /**
     * Прочие лаборатории (для перелинковки), исключая текущую и AI-ядро.
     *
     * @return array<int,array<string,mixed>>
     */
    public static function otherLabs(string $exclude, int $limit = 4): array
    {
        $result = [];
        foreach (self::labs() as $slug => $lab) {
            if ($slug === $exclude || ($lab['is_ai'] ?? false)) {
                continue;
            }
            $result[] = $lab;
            if (count($result) >= $limit) {
                break;
            }
        }

        return $result;
    }

    /** Абсолютный/относительный URL лаборатории с учётом режима и локали. */
    public static function url(string $slug): string
    {
        if (config('genla.routing.mode') === 'subdomain') {
            $host = 'https://'.$slug.'.'.config('genla.routing.base_domain');

            return self::isDefaultLocale() ? $host : $host.'/'.app()->getLocale();
        }

        return url(self::prefix().'/'.$slug);
    }

    /** URL главной (GENLA) с учётом локали. */
    public static function homeUrl(): string
    {
        if (config('genla.routing.mode') === 'subdomain') {
            $host = 'https://'.config('genla.routing.base_domain');

            return self::isDefaultLocale() ? $host : $host.'/'.app()->getLocale();
        }

        $prefix = self::prefix();

        return url($prefix !== '' ? $prefix : '/');
    }

    /**
     * Текст из lang с разметкой **жирный** → безопасный HTML.
     * Всё экранируется, разворачивается только <strong>.
     */
    public static function md(?string $text): \Illuminate\Support\HtmlString
    {
        $html = preg_replace('/\*\*(.+?)\*\*/u', '<strong>$1</strong>', e((string) $text));

        return new \Illuminate\Support\HtmlString($html);
    }

    /** Текст без разметки ** (для title, meta, alt, JSON-LD). */
    public static function plain(?string $text): string
    {
        return str_replace('**', '', (string) $text);
    }

    /** @return array<string,mixed>|null */
    public static function action(string $key): ?array
    {
        return config("genla.actions.$key");
    }

    public static function actionLabel(string $key): string
    {
        return trans("genla.actions.$key");
    }

    /**
     * Хост интерфейса ИИ для регистрации роутов и ссылок.
     * Явный GENLA_AI_HOST или производный ai.<base_domain>.
     */
    public static function aiHost(): string
    {
        return config('genla.ai.host') ?: ('ai.'.config('genla.routing.base_domain'));
    }

    /**
     * URL интерфейса Genla AI.
     * На реальном домене (genla.tech) — поддомен ai.genla.tech (без /ai).
     * Локально / на ином хосте — путь /ai.
     */
    public static function aiUrl(): string
    {
        $base = config('genla.routing.base_domain');
        $host = request()?->getHost() ?? '';

        if (! empty($base) && ($host === $base || str_ends_with($host, '.'.$base))) {
            $url = 'https://'.self::aiHost();

            return self::isDefaultLocale() ? $url : $url.'/'.app()->getLocale();
        }

        return url(self::prefix().'/ai');
    }

    /**
     * URL основного сайта (для ссылки «на сайт» с поддомена ИИ).
     */
    public static function siteUrl(): string
    {
        $base = config('genla.routing.base_domain');
        $host = request()?->getHost() ?? '';

        if (! empty($base) && str_ends_with($host, $base)) {
            $url = 'https://'.$base;

            return self::isDefaultLocale() ? $url : $url.'/'.app()->getLocale();
        }

        return self::homeUrl();
    }

    /*
    |----------------------------------------------------------------------
    | Локализация
    |----------------------------------------------------------------------
    */

    /** @return array<string,array<string,string>> */
    public static function locales(): array
    {
        return config('genla.locales', ['ru' => ['label' => 'RU']]);
    }

    /** Основная локаль (без префикса в URL) — первая в списке. */
    public static function defaultLocale(): string
    {
        return (string) array_key_first(self::locales());
    }

    public static function isDefaultLocale(?string $locale = null): bool
    {
        return ($locale ?? app()->getLocale()) === self::defaultLocale();
    }

    /** Префикс пути для локали: '' для основной, '/en' для остальных. */
    public static function prefix(?string $locale = null): string
    {
        $locale = $locale ?? app()->getLocale();

        return self::isDefaultLocale($locale) ? '' : '/'.$locale;
    }

    /**
     * URL текущей страницы в другой локали (для переключателя).
     * Сохраняет путь, меняет только языковой префикс.
     */
    public static function switchUrl(string $target): string
    {
        $path = request()->path(); // без ведущего слэша; '/' для корня
        $segments = ($path === '' || $path === '/') ? [] : explode('/', $path);

        // Убираем ведущий сегмент локали, если он есть (например 'en').
        if (isset($segments[0]) && array_key_exists($segments[0], self::locales()) && $segments[0] !== self::defaultLocale()) {
            array_shift($segments);
        }

        $rest = implode('/', $segments);
        $built = trim(self::prefix($target).'/'.$rest, '/');

        return url($built !== '' ? $built : '/');
    }
}
