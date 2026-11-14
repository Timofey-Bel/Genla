<?php

use App\Http\Controllers\AiAgentController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LeadController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Роутинг GENLA
|--------------------------------------------------------------------------
| Режим задаётся в config/genla.php (genla.routing.mode):
|   'path'      — локально: /, /genx, /ai ...
|   'subdomain' — прод: genla.ru + genx.genla.ru ...
|
| Локали: основная (ru) — без префикса; остальные (en) — с префиксом /en.
| Локаль определяется middleware SetLocale по первому сегменту URL.
*/

$labSlugs = implode('|', array_keys(config('genla.labs', [])));

/*
| Интерфейс Genla AI на отдельном поддомене (ai.<base_domain>, напр. ai.genla.tech).
| Регистрируется всегда — срабатывает только при заходе на этот хост.
*/
$aiHost = \App\Support\Genla::aiHost();
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

if (config('genla.routing.mode') === 'subdomain') {
    $base = config('genla.routing.base_domain');

    // Главная (GENLA) на корневом домене
    $home = function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::view('/privacy', 'privacy')->name('privacy');
        Route::view('/about', 'pages.about')->name('about');
        Route::view('/mission', 'pages.mission')->name('mission');
        Route::view('/cases', 'pages.cases')->name('cases');
        Route::view('/expertise', 'pages.blog')->name('blog');
        Route::view('/partners', 'pages.partners')->name('partners');
        Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');
        Route::post('/ai/chat', [ChatController::class, 'reply'])->middleware('throttle:20,1')->name('ai.chat');
    };

    Route::domain($base)->group(function () use ($home) {
        $home();                                            // ru
        Route::prefix('en')->name('en.')->group($home);     // en
    });

    // Каждая лаборатория — самостоятельный поддомен {lab}.genla.ru
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
    // Path-режим (по умолчанию, локально)
    $register = function () use ($labSlugs) {
        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::view('/privacy', 'privacy')->name('privacy');
        Route::view('/about', 'pages.about')->name('about');
        Route::view('/mission', 'pages.mission')->name('mission');
        Route::view('/cases', 'pages.cases')->name('cases');
        Route::view('/expertise', 'pages.blog')->name('blog');
        Route::view('/partners', 'pages.partners')->name('partners');
        Route::post('/leads', [LeadController::class, 'store'])->middleware('throttle:8,1')->name('leads.store');
        Route::post('/ai/chat', [ChatController::class, 'reply'])->middleware('throttle:20,1')->name('ai.chat');
        Route::post('/api/chat', [AiAgentController::class, 'sendMessage']);
        Route::get('/ai', fn () => view('ai'))->name('ai');
        Route::get('/{lab}', [LabController::class, 'show'])
            ->where('lab', $labSlugs)
            ->name('lab');
    };

    $register();                                            // ru — без префикса
    Route::prefix('en')->name('en.')->group($register);     // en — /en
}
