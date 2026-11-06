@php
    $home = \App\Support\Genla::homeUrl();
    $p = \App\Support\Genla::prefix();
    $contacts = config('genla.contacts');
@endphp

<div class="mobile-nav" :class="{ 'is-open': $store.ui.navOpen }" x-cloak>
    <div class="mobile-nav__backdrop" @click="$store.ui.closeNav()"></div>
    <aside class="mobile-nav__panel">
        <div class="mobile-nav__head">
            <img src="{{ asset('genla-icon-no-bg.png') }}?v=3" alt="Genla" class="mobile-nav__logo">
            <button class="mobile-nav__close" @click="$store.ui.closeNav()" aria-label="{{ __('genla.ui.close_menu') }}">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" aria-hidden="true">
                    <path d="M18 6 6 18M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="mobile-nav__links">
            <a href="{{ $home }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.tab_home') }}</span><x-nav-arrow /></a>
            <a href="{{ url($p.'/about') }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.nav_about') }}</span><x-nav-arrow /></a>
            <a href="{{ url($p.'/mission') }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.nav_mission') }}</span><x-nav-arrow /></a>
            <a href="{{ url($p.'/cases') }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.nav_cases') }}</span><x-nav-arrow /></a>
            <a href="{{ url($p.'/expertise') }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.nav_blog') }}</span><x-nav-arrow /></a>
            <a href="{{ url($p.'/partners') }}" @click="$store.ui.closeNav()"><span>{{ __('genla.ui.nav_partners') }}</span><x-nav-arrow /></a>
        </nav>

        <div class="mobile-nav__section">{{ __('genla.ui.menu_directions') }}</div>
        <nav class="mobile-nav__links mobile-nav__links--compact">
            {{-- Ассистент (AI) — первым в списке, с подписью «AI» --}}
            <a href="{{ \App\Support\Genla::aiUrl() }}" @click="$store.ui.closeNav()">
                <span>AI</span><x-nav-arrow />
            </a>
            @foreach (\App\Support\Genla::gridLabs() as $navLab)
                @continue($navLab['is_ai'] ?? false)
                <a href="{{ \App\Support\Genla::url($navLab['slug']) }}" @click="$store.ui.closeNav()">
                    <span>{{ $navLab['name'] }}</span><x-nav-arrow />
                </a>
            @endforeach
        </nav>

        <div class="mobile-nav__cta">
            <button type="button" class="btn btn--primary btn--block"
                @click="$store.ui.openModal('consultation',null,null)">{{ __('genla.actions.consultation') }}</button>
            <a class="btn btn--ghost btn--block" href="{{ \App\Support\Genla::aiUrl() }}">{{ __('genla.ui.cta_ai') }}</a>
        </div>

        <div class="mobile-nav__lang">
            <x-lang-switcher />
        </div>

        <div class="mobile-nav__footer">
            <a href="{{ $contacts['telegram']['url'] }}">{{ $contacts['telegram']['label'] }}</a>
            <a href="{{ $contacts['vk']['url'] }}">{{ $contacts['vk']['label'] }}</a>
            <a href="{{ $contacts['email']['url'] }}">{{ $contacts['email']['value'] }}</a>
            <a href="{{ url($p.'/privacy') }}">{{ __('genla.ui.privacy') }}</a>
        </div>
    </aside>
</div>
