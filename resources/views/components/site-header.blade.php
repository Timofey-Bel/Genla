@props([
    'variant' => 'os',
    'lab' => null,
])

@php
    $p = \App\Support\Genla::prefix();
    $home = \App\Support\Genla::homeUrl();
@endphp

<header class="site-header">

    @if ($variant === 'os' || $variant === 'page')
        {{-- ── Главная (os) и контент-страницы (page): язык + nav + действия ── --}}
        <div class="site-header__inner site-header__inner--os {{ $variant === 'page' ? 'site-header__inner--page' : '' }}">

            @if ($variant === 'page')
                {{-- Возврат на главную — доступен с любой внутренней страницы --}}
                <a class="header-back" href="{{ $home }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    {{ __('genla.ui.back_to_os') }}
                </a>
            @endif

            <div class="os-header-left">
                <a class="btn btn--accent" href="{{ \App\Support\Genla::aiUrl() }}">{{ __('genla.ui.cta_ai') }}</a>
            </div>

            <nav class="os-nav">
                <a class="os-nav__link" href="{{ url($p.'/about') }}">{{ __('genla.ui.nav_about') }}</a>
                <a class="os-nav__link" href="{{ url($p.'/mission') }}">{{ __('genla.ui.nav_mission') }}</a>
                <a class="os-nav__link" href="{{ url($p.'/capabilities') }}">{{ __('genla.ui.nav_capabilities') }}</a>
                <a class="os-nav__link" href="{{ url($p.'/cases') }}">{{ __('genla.ui.nav_cases') }}</a>
                <a class="os-nav__link" href="{{ url($p.'/become-partner') }}">{{ __('genla.ui.nav_partners') }}</a>
            </nav>

            <div class="os-header-cta">
                <button type="button" class="btn"
                    @click="$store.ui.openModal('consultation', null, null)">{{ __('genla.ui.cta_consultation') }}</button>
                <x-lang-switcher />
            </div>

            <button class="header-toggle" @click="$store.ui.openNav()" aria-label="{{ __('genla.ui.open_menu') }}">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M3 6h18M3 12h18M3 18h18" />
                </svg>
            </button>
        </div>
    @else
        {{-- ── Лаборатория ── --}}
        <div class="site-header__inner site-header__inner--lab">
            <div class="lab-header-left">
                <a class="header-back" href="{{ $home }}">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <path d="M19 12H5M12 19l-7-7 7-7" />
                    </svg>
                    {{ __('genla.ui.back') }}
                </a>
            </div>

            <div class="lab-header-right">
                <x-lang-switcher />
                <button type="button" class="btn btn--primary"
                    @click="$store.ui.openModal('consultation', '{{ $lab['slug'] ?? '' }}', '{{ $lab['name'] ?? '' }}')">
                    {{ __('genla.ui.cta_consultation') }}
                </button>
                <button type="button" class="btn btn--chat" @click="$store.ui.openChat()">{{ __('genla.ui.cta_chat') }}</button>
            </div>

            <button class="header-toggle" @click="$store.ui.openNav()" aria-label="{{ __('genla.ui.open_menu') }}">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M3 6h18M3 12h18M3 18h18" />
                </svg>
            </button>
        </div>
    @endif

</header>
