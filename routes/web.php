<?php

use App\Http\Controllers\AiAgentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\PartnerApplicationController;
use App\Support\Genla;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Роутинг GENLA
|--------------------------------------------------------------------------
| Режим задаётся в config/genla.php (genla.routing.mode):
|   'path'      — /, /genx, /ai ... (страницы лабораторий внутри основного сайта)
|   'subdomain' — прод: genla.ru + genx.genla.ru ...
|
| Локали: основная (ru) — без префикса; остальные (en) — с префиксом /en.
| Локаль определяется middleware SetLocale по первому сегменту URL.
*/

$labSlugs = implode('|', array_keys(config('genla.labs', [])));
$movedLabs = config('genla.moved_labs', []);

/*
| Контент-страницы основного сайта — одинаковые в обоих режимах.
| /expertise и /partners — постоянные 301 на новые адреса (ТЗ).
*/
$pages = function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::view('/privacy', 'privacy')->name('privacy');
    Route::view('/about', 'pages.content', ['page' => 'about'])->name('about');
    Route::view('/mission', 'pages.content', ['page' => 'mission_page'])->name('mission');
    Route::view('/capabilities', 'pages.content', ['page' => 'capabilities'])->name('capabilities');
    Route::get('/expertise', fn () => redirect(url(Genla::prefix().'/capabilities'), 301));
    Route::view('/cases', 'pages.cases')->name('cases');
    Route::view('/become-partner', 'pages.become_partner')->name('become_partner');
    Route::view('/become-partner/consent', 'partner-consent')->name('become_partner.consent');
    Route::post('/become-partner/apply', [PartnerApplicationController::class, 'store'])
        ->middleware('throttle:5,1')->name('become_partner.apply');
    Route::get('/partners', fn () => redirect(url(Genla::prefix().'/become-partner'), 301));
    Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');
    Route::post('/ai/chat', [ChatController::class, 'reply'])->middleware('throttle:20,1')->name('ai.chat');
};

/*
| Интерфейс Genla AI на отдельном поддомене (ai.<base_domain>, напр. ai.genla.tech).
| Регистрируется всегда — срабатывает только при заходе на этот хост.
*/
$aiHost = Genla::aiHost();
if (! empty($aiHost) && str_contains($aiHost, '.')) {
    $aiInterface = function () {
        Route::get('/', fn () => view('ai'));
        Route::post('/api/chat', [AiAgentController::class, 'sendMessage']);
        Route::post('/ai/chat', [ChatController::class, 'reply'])->middleware('throttle:20,1');
        Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1');
    };

    Route::domain($aiHost)->group(function () use ($aiInterface) {
        $aiInterface();                                     // ru
        Route::prefix('en')->group($aiInterface);           // en
    });
}

// Карта сайта (все локали в одном файле).
Route::get('/sitemap.xml', function () {
    $paths = ['', '/about', '/mission', '/capabilities', '/cases', '/become-partner', '/privacy'];
    $urls = [];
    foreach (array_keys(Genla::locales()) as $locale) {
        $prefix = Genla::prefix($locale);
        foreach ($paths as $path) {
            $urls[] = url($prefix.$path ?: '/');
        }
        foreach (Genla::gridLabs() as $lab) {
            if (! ($lab['is_ai'] ?? false)) {
                $urls[] = config('genla.routing.mode') === 'subdomain'
                    ? 'https://'.$lab['slug'].'.'.config('genla.routing.base_domain').($prefix ?: '')
                    : url($prefix.'/'.$lab['slug']);
            }
        }
    }

    return response()->view('sitemap', ['urls' => array_unique($urls)])
        ->header('Content-Type', 'application/xml; charset=UTF-8');
})->name('sitemap');

if (config('genla.routing.mode') === 'subdomain') {
    $base = config('genla.routing.base_domain');

    Route::domain($base)->group(function () use ($pages) {
        $pages();                                           // ru
        Route::prefix('en')->name('en.')->group($pages);    // en
    });

    // Каждая лаборатория — поддомен {lab}.genla.ru
    $sub = function () {
        Route::get('/', [LabController::class, 'showSub'])->name('lab');
        Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');
        Route::post('/ai/chat', [ChatController::class, 'reply'])->middleware('throttle:20,1')->name('ai.chat');
    };

    Route::domain('{lab}.'.$base)->group(function () use ($sub) {
        $sub();                                             // ru
        Route::prefix('en')->name('en.')->group($sub);      // en
    });
} else {
    // Path-режим (по умолчанию)
    $register = function () use ($pages, $labSlugs, $movedLabs) {
        // 301 со старых адресов направлений (сохраняя языковой префикс).
        foreach ($movedLabs as $from => $to) {
            Route::get('/'.$from, fn () => redirect(Genla::url($to), 301));
        }

        $pages();
        Route::post('/api/chat', [AiAgentController::class, 'sendMessage']);
        Route::get('/ai', fn () => view('ai'))->name('ai');
        Route::get('/{lab}', [LabController::class, 'show'])
            ->where('lab', $labSlugs)
            ->name('lab');
    };

    $register();                                            // ru — без префикса
    Route::prefix('en')->name('en.')->group($register);     // en — /en
}
