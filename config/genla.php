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
        // Заявка со страницы «Стать партнёром» (своя форма, в CTA не выводится).
        'partner' => ['key' => 'partner', 'type' => 'lead'],
    ],

    'contacts' => [
        'telegram' => ['label' => 'Telegram', 'url' => '#'],
        'vk' => ['label' => 'VK', 'url' => '#'],
        'email' => ['label' => 'Email', 'value' => 'info@genla.tech', 'url' => 'mailto:info@genla.tech'],
        'phone' => ['label' => '+7 (495) 045-65-55', 'url' => 'tel:+74950456555'],
        // Город (city) и адрес (address) — в lang/{locale}/genla.php (company.city, company.address).
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

    /*
    | Сетка главной 3×3 — восемь направлений системной интеграции вокруг ядра AI.
    | Читается слева-направо / сверху-вниз:
    |   [GenReview  GenClaw   GenPromo ]  верхний ряд
    |   [GenFleet     AI      GenCloud ]  средний ряд (центр — ядро, пульсирует)
    |   [GenType    GenSec     GenX    ]  нижний ряд
    |
    | GenReview — точка входа (исследования, аудит и консалтинг)
    | GenClaw — автономные цифровые сотрудники
    | GenPromo — коммуникации и продвижение
    | GenFleet — оборудование и готовые ИИ-комплексы
    | GenCloud — облачные сервисы и рабочая среда (был GenSpace)
    | GenType — цифровая генетика и развитие моделей (главная лаборатория, был GenEtics)
    | GenSec — безопасность человека, данных и ИИ
    | GenX — данные и исследования для робототехники
    */
    'grid' => ['genreview', 'genclaw', 'genpromo', 'genfleet', 'ai', 'gencloud', 'gentype', 'gensec', 'genx'],

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

        // ── Верхний ряд сетки ──────────────────────────────────────────
        'genreview' => [
            'slug' => 'genreview',
            'subdomain' => 'genreview',
            'is_ai' => false,
            'glyph' => 2,
            'tile_image' => 'images/tiles/genreview.png?v=5',
            'hero_image' => ['webp' => '/images/heroes/gendev.webp?v=10', 'fallback' => '/images/heroes/gendev.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genclaw' => [
            'slug' => 'genclaw',
            'subdomain' => 'genclaw',
            'is_ai' => false,
            'glyph' => 7,
            // Плитка — тот же образ «цифрового сотрудника», что и на первом экране (ТЗ: genup.png).
            'tile_image' => 'images/tiles/genup.png?v=10',
            'hero_image' => ['webp' => '/images/heroes/genup.webp?v=10', 'fallback' => '/images/heroes/genup.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genpromo' => [
            'slug' => 'genpromo',
            'subdomain' => 'genpromo',
            'is_ai' => false,
            'glyph' => 1,
            // Плитка на главной временно — прежний арт GenClaw (нового под GenPromo не было).
            'tile_image' => 'images/tiles/genpromo.png?v=8',
            'hero_image' => ['webp' => '/images/heroes/genpromo.webp?v=11', 'fallback' => '/images/heroes/genpromo.png?v=11'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        // ── Средний ряд: GenFleet · AI · GenSpace ──────────────────────
        'genfleet' => [
            'slug' => 'genfleet',
            'subdomain' => 'genfleet',
            'is_ai' => false,
            'glyph' => 5,
            // Плитка на главной временно — прежний арт GenBox (нового под GenFleet не было).
            'tile_image' => 'images/tiles/genfleet.png?v=8',
            'hero_image' => ['webp' => '/images/heroes/genfleet.webp?v=10', 'fallback' => '/images/heroes/genfleet.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        // GenCloud — облачная лаборатория (GenSpace переименован в GenCloud).
        'gencloud' => [
            'slug' => 'gencloud',
            'subdomain' => 'gencloud',
            'is_ai' => false,
            'glyph' => 6,
            // Плитка и hero — иконка-облако GenSpace (GenSpace-icon.jpg из корня).
            'tile_image' => 'images/tiles/genspace.png?v=2',
            'hero_image' => ['webp' => '/images/heroes/genspace.webp?v=2', 'fallback' => '/images/heroes/genspace.png?v=2'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        // ── Нижний ряд сетки ───────────────────────────────────────────
        // GenType — главная лаборатория, цифровая генетика (GenEtics переименован).
        'gentype' => [
            'slug' => 'gentype',
            'subdomain' => 'gentype',
            'is_ai' => false,
            'glyph' => 3,
            // Плитка на главной — старая иконка GenEtics (папка "Иконки" в корне сайта).
            'tile_image' => 'images/tiles/genetics.png?v=9',
            'hero_image' => ['webp' => '/images/heroes/genetics.webp?v=10', 'fallback' => '/images/heroes/genetics.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'gensec' => [
            'slug' => 'gensec',
            'subdomain' => 'gensec',
            'is_ai' => false,
            'glyph' => 4,
            // Плитка на главной — старая иконка GenSec (папка "Иконки" в корне сайта).
            'tile_image' => 'images/tiles/gensec.png?v=9',
            'hero_image' => ['webp' => '/images/heroes/gensec.webp?v=10', 'fallback' => '/images/heroes/gensec.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

        'genx' => [
            'slug' => 'genx',
            'subdomain' => 'genx',
            'is_ai' => false,
            'glyph' => 8,
            // Плитка на главной — старая иконка GenX (папка "Иконки" в корне сайта).
            'tile_image' => 'images/tiles/genx.png?v=9',
            'hero_image' => ['webp' => '/images/heroes/genx.webp?v=10', 'fallback' => '/images/heroes/genx.png?v=10'],
            'actions' => ['consultation', 'presentation', 'call', 'chat'],
        ],

    ],

    /*
    | Переехавшие направления. Состав экосистемы пересобран:
    | GenSpace → GenCloud (облачные сервисы)
    | GenEtics → GenType (цифровая генетика)
    | GenUp/GenDev → убраны из сетки (контент переработан)
    | GenBox/GenCube/GenBook/GenView/GenBlock → все внутри GenFleet
    | GenClaw → продукт, но остаётся в сетке как направление
    |
    | Держим 301 со старых адресов, чтобы не терять внешние ссылки.
    */
    'moved_labs' => [
        'genbox' => 'genfleet',
        'gencube' => 'genfleet',
        'genbook' => 'genfleet',
        'genview' => 'genfleet',
        'genblock' => 'genfleet',
        'genspace' => 'gencloud',
        'genetics' => 'gentype',
        'genup' => 'genreview',
        'gendev' => 'genreview',
    ],

];
