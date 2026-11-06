<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Определяет локаль по первому сегменту URL.
 * '/en/...' → en; всё остальное → основная локаль (ru, без префикса).
 */
class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locales = array_keys(config('genla.locales', ['ru' => []]));
        $default = $locales[0] ?? 'ru';

        $segment = $request->segment(1);
        $locale = in_array($segment, $locales, true) ? $segment : $default;

        app()->setLocale($locale);

        return $next($request);
    }
}
