@php $home = \App\Support\Genla::homeUrl(); $p = \App\Support\Genla::prefix(); @endphp

<nav class="tabbar" aria-label="{{ __('genla.ui.nav_quick') }}">
    <a class="tabbar__item" href="{{ $home }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true">
            <path d="M3 11l9-8 9 8" />
            <path d="M5 10v10h14V10" />
        </svg>
        <span>{{ __('genla.ui.tab_home') }}</span>
    </a>

    <a class="tabbar__item" href="{{ url($p.'/become-partner') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M23 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75" />
        </svg>
        <span>{{ __('genla.ui.nav_partners') }}</span>
    </a>

    <a class="tabbar__item tabbar__item--ai" href="{{ \App\Support\Genla::aiUrl() }}" aria-label="AI">
        <span class="tabbar__orb">
            <span class="tabbar__sphere" aria-hidden="true"></span>
        </span>
        <span class="tabbar__ai-label">AI</span>
    </a>

    <button type="button" class="tabbar__item" @click="$store.ui.openModal('contact', null, null)">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            stroke-linejoin="round" aria-hidden="true">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
        </svg>
        <span>{{ __('genla.ui.tab_contact') }}</span>
    </button>

    <button type="button" class="tabbar__item" @click="$store.ui.openNav()" aria-label="{{ __('genla.ui.menu') }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
            aria-hidden="true">
            <path d="M3 6h18M3 12h18M3 18h18" />
        </svg>
        <span>{{ __('genla.ui.menu') }}</span>
    </button>
</nav>
