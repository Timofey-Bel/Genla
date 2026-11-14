<?php

/*
|--------------------------------------------------------------------------
| GENLA Technologies — структура экосистемы
|--------------------------------------------------------------------------
| Здесь — только НЕсловесная структура (slug, сетка, картинки, настройки
| роутинга и AI). Весь текстовый контент (тексты лабораторий, UI, формы,
| ассистент) вынесен в lang/{locale}/genla.php и подмешивается по локали
| через App\Support\Genla. Добавить лабораторию = строка здесь + тексты
| в обоих lang-файлах.
*/

return [

    'company' => [
        // Тексты компании (name, full_name, tagline, mission, about…) — в lang/{locale}/genla.php.
        'domain' => env('GENLA_BASE_DOMAIN', 'genla.ru'),
    ],

    /*
    | Режим роутинга.
    | 'path'      — локально: лаборатории открываются по пути /genx, /ai ...
    | 'subdomain' — прод: genx.genla.ru (Route::domain()). Переключается одной
    |               переменной GENLA_ROUTING в .env — переписывать код не нужно.
    */
    'routing' => [
        'mode' => env('GENLA_ROUTING', 'path'),
        'base_domain' => env('GENLA_BASE_DOMAIN', 'genla.ru'),
    ],

    // Поддерживаемые локали. Первая — основная (без префикса в URL).
    'locales' => [
        'ru' => ['label' => 'RU', 'name' => 'Русский', 'hreflang' => 'ru-RU', 'og' => 'ru_RU'],
        'en' => ['label' => 'EN', 'name' => 'English', 'hreflang' => 'en', 'og' => 'en_US'],
    ],

    // Действия (CTA). Подписи (label) — в lang. Здесь только тип и приоритет.
    // type: lead — открывает форму-заявку; chat — открывает Genla.
    'actions' => [
        'consultation' => ['key' => 'consultation', 'type' => 'lead', 'primary' => true],
        'presentation' => ['key' => 'presentation', 'type' => 'lead'],
        'call' => ['key' => 'call', 'type' => 'lead'],
        'contact' => ['key' => 'contact', 'type' => 'lead'],
        'chat' => ['key' => 'chat', 'type' => 'chat'],
    ],

    'contacts' => [
        'telegram' => ['label' => 'Telegram', 'url' => '#'],
        'vk' => ['label' => 'VK', 'url' => '#'],
        'email' => ['label' => 'Email', 'value' => 'info@genla.tech', 'url' => 'mailto:info@genla.tech'],
        // Город (city) — в lang/{locale}/genla.php (company.city).
    ],

    'ai' => [
        'driver' => env('GENLA_AI_DRIVER', 'scripted'),
        'format' => env('GENLA_AI_FORMAT', 'timeweb'), // timeweb | openai
        'endpoint' => env('GENLA_AI_ENDPOINT'),
        'token' => env('GENLA_AI_TOKEN'),
        'model' => env('GENLA_AI_MODEL'),
        'timeout' => (int) env('GENLA_AI_TIMEOUT', 60),
        'system_prompt' => env('GENLA_AI_SYSTEM_PROMPT', 'Ты — Genla, интеллектуальное ядро экосистемы Genla Technologies.'),
        // Отдельный поддомен интерфейса Genla (прод): ai.genla.tech.
        // Пусто (локально) → интерфейс доступен по пути /ai.
        'host' => env('GENLA_AI_HOST'),
    ],

    'notify' => [
        'enabled' => (bool) env('GENLA_NOTIFY_ENABLED', false),
        'telegram_token' => env('GENLA_NOTIFY_TELEGRAM_TOKEN'),
        'telegram_chat' => env('GENLA_NOTIFY_TELEGRAM_CHAT'),
        // Пригласительная ссылка на группу «Заявки с наших сайтов» — для справки
        // в setup-командах. Реальная доставка идёт по telegram_chat (числовой id).
        'telegram_invite' => env('GENLA_NOTIFY_TELEGRAM_INVITE', 'https://t.me/+WNd4UxdcNKE3Y2Vi'),
        // Часовой пояс для отметок времени в уведомлениях (Москва по умолчанию).
        'timezone' => env('GENLA_NOTIFY_TZ', 'Europe/Moscow'),
        'email' => env('GENLA_NOTIFY_EMAIL'),
    ],

    // Опциональная интеграция с CRM. Если задан вебхук — лиды (в т.ч. собранные
    // AI-агентом из диалога) POST-ятся туда JSON-ом. Подходит для Bitrix24/amoCRM/своей CRM.
    'crm' => [
        'webhook_url' => env('GENLA_CRM_WEBHOOK_URL', ''),
    ],

    // Сетка главной 3×3 (порядок = приоритет услуг, читается слева-направо/сверху-вниз).
    // Позиции: [1 2 3] верхний ряд, [4 _ 5] вокруг ИИ, [6 7 8] нижний ряд.
    // Центр — ai (самый большой, пульсирует). GenClaw (роботы) — в нижнем углу.
    'grid' => ['genup', 'genreview', 'genetics', 'genbox', 'ai', 'genblock', 'genx', 'gensec', 'genclaw'],

    /*
    | Лаборатории — только структура. Текстовые поля (name, short, hero_title,
    | hero_subtitle, description, features, advantages, products, cases, faq)
    | живут в lang/{locale}/genla.php и подмешиваются в App\Support\Genla::lab().
    */
    'labs' => [

        'ai' => [
            'slug' => 'ai',
            'subdomain' => 'ai',
            'is_ai' => true,
            'glyph' => 0,
            'actions' => ['consultation', 'presentation', 'call'],
        ],

        'genx' => [
            'slug' => 'genx',
            'subdomain' => 'genx',
            'is_ai' => false,
            'glyph' => 1,
            'tile_image' => 'images/tiles/genx.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genx.webp?v=4', 'fallback' => '/images/tiles/genx.png?v=4'],
            'actions' => ['consultation', 'call', 'chat'],
        ],

        'genreview' => [
            'slug' => 'genreview',
            'subdomain' => 'genreview',
            'is_ai' => false,
            'glyph' => 2,
            'tile_image' => 'images/tiles/genreview.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genreview.webp?v=4', 'fallback' => '/images/tiles/genreview.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genetics' => [
            'slug' => 'genetics',
            'subdomain' => 'genetics',
            'is_ai' => false,
            'glyph' => 3,
            'tile_image' => 'images/tiles/genetics.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genetics.webp?v=4', 'fallback' => '/images/tiles/genetics.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genbox' => [
            'slug' => 'genbox',
            'subdomain' => 'genbox',
            'is_ai' => false,
            'glyph' => 5,
            'tile_image' => 'images/tiles/genbox.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genbox.webp?v=4', 'fallback' => '/images/tiles/genbox.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genblock' => [
            'slug' => 'genblock',
            'subdomain' => 'genblock',
            'is_ai' => false,
            'glyph' => 6,
            'tile_image' => 'images/tiles/genblock.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genblock.webp?v=4', 'fallback' => '/images/tiles/genblock.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genup' => [
            'slug' => 'genup',
            'subdomain' => 'genup',
            'is_ai' => false,
            'glyph' => 7,
            'tile_image' => 'images/tiles/genup.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genup.webp?v=4', 'fallback' => '/images/tiles/genup.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genclaw' => [
            'slug' => 'genclaw',
            'subdomain' => 'genclaw',
            'is_ai' => false,
            'glyph' => 8,
            'tile_image' => 'images/tiles/genclaw.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/genclaw.webp?v=4', 'fallback' => '/images/tiles/genclaw.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'gensec' => [
            'slug' => 'gensec',
            'subdomain' => 'gensec',
            'is_ai' => false,
            'glyph' => 9,
            'tile_image' => 'images/tiles/gensec.png?v=4',
            'hero_image' => ['webp' => '/images/tiles/gensec.webp?v=4', 'fallback' => '/images/tiles/gensec.png?v=4'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

    ],

];
