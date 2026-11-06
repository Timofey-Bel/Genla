<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#ffffff">

    <title>@yield('title', __('genla.company.full_name').' — '.__('genla.company.tagline'))</title>
    <meta name="description" content="@yield('description', __('genla.company.mission'))">
    <link rel="canonical" href="{{ url()->current() }}">

    {{-- hreflang — связываем языковые версии для поисковиков --}}
    @foreach (\App\Support\Genla::locales() as $localeCode => $localeMeta)
        <link rel="alternate" hreflang="{{ $localeMeta['hreflang'] ?? $localeCode }}" href="{{ \App\Support\Genla::switchUrl($localeCode) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ \App\Support\Genla::switchUrl(\App\Support\Genla::defaultLocale()) }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}?v=7" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32.png') }}?v=7">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16.png') }}?v=7">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon-180.png') }}?v=7">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ __('genla.company.full_name') }}">
    <meta property="og:locale" content="{{ \App\Support\Genla::locales()[app()->getLocale()]['og'] ?? 'ru_RU' }}">
    @foreach (\App\Support\Genla::locales() as $localeCode => $localeMeta)
        @if ($localeCode !== app()->getLocale())
            <meta property="og:locale:alternate" content="{{ $localeMeta['og'] ?? $localeCode }}">
        @endif
    @endforeach
    <meta property="og:title" content="@yield('title', __('genla.company.full_name'))">
    <meta property="og:description" content="@yield('description', __('genla.company.mission'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('og-cover.png').'?v=1')">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ __('genla.company.full_name') }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('title', __('genla.company.full_name'))">
    <meta name="twitter:description" content="@yield('description', __('genla.company.mission'))">
    <meta name="twitter:image" content="@yield('og_image', asset('og-cover.png').'?v=1')">

    @stack('head')

    {{-- Переводы и языковой префикс для фронта (Alpine/JS) --}}
    @php
        $genlaJs = [
            'prefix' => \App\Support\Genla::prefix(),
            'locale' => app()->getLocale(),
            'chat' => [
                'greeting' => __('genla.chat.greeting'),
                'fallback' => __('genla.chat.fallback_reply'),
                'error' => __('genla.chat.error'),
                'openLab' => __('genla.chat.open_lab'),
                'suggestions' => __('genla.chat.suggestions'),
            ],
            'modalTitles' => __('genla.modal_titles'),
            'modalLeads' => __('genla.modal_leads'),
            'actionLabels' => __('genla.action_labels'),
            'errors' => __('genla.form_errors'),
        ];
    @endphp
    <script>window.__genla = {!! json_encode($genlaJs, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!};</script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Organization (Schema.org) --}}
    @php
        $sameAs = collect(config('genla.contacts'))
            ->filter(fn ($c) => is_array($c) && ($c['url'] ?? '#') !== '#')
            ->pluck('url')->values()->all();
        $org = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => __('genla.company.full_name'),
            'url' => \App\Support\Genla::homeUrl(),
            'logo' => asset('favicon-512.png').'?v=7',
            'slogan' => __('genla.company.tagline'),
            'description' => __('genla.company.mission'),
            'address' => [
                '@type' => 'PostalAddress',
                'addressLocality' => __('genla.company.city'),
                'addressCountry' => 'RU',
            ],
            'sameAs' => $sameAs ?: null,
        ]);
    @endphp
    <script type="application/ld+json">{!! json_encode($org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @stack('jsonld')
</head>
<body x-data>
    @yield('content')

    {{-- Глобальные оверлеи (один раз на страницу) --}}
    @include('partials.modal')
    @include('partials.chat-overlay')
    @include('partials.mobile-nav')
    @include('partials.bottom-bar')
</body>
</html>
