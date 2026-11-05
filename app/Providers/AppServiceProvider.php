<?php

namespace App\Providers;

use App\Services\GenlaAi\Contracts\AssistantDriver;
use App\Services\GenlaAi\Drivers\HttpAgentDriver;
use App\Services\GenlaAi\Drivers\ScriptedDriver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Активный драйвер GENLA AI выбирается из конфига.
        // 'http' (внешний агент Timeweb и т.п.) с фолбэком на сценарный,
        // иначе — сценарный ассистент.
        $this->app->bind(AssistantDriver::class, function () {
            $scripted = new ScriptedDriver();

            return config('genla.ai.driver') === 'http'
                ? new HttpAgentDriver($scripted)
                : $scripted;
        });
    }

    public function boot(): void
    {
        //
    }
}
