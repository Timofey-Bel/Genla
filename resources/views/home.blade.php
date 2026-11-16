@extends('layouts.base')

@section('title', __('genla.company.full_name').' — '.__('genla.company.tagline'))
@section('description', '')

@section('content')
    <x-site-header variant="os" />

    <main class="os">
        <div class="os__field" aria-hidden="true">
            <span class="blob blob--1"></span>
            <span class="blob blob--2"></span>
            <span class="blob blob--3"></span>
            <span class="blob blob--4"></span>
            <canvas id="fluid-cursor" class="os__fluid"></canvas>
        </div>

        <div class="container">
            {{-- Словесный логотип Genla над сеткой (бренд компании) --}}
            <div class="os__intro">
                <h1 class="visually-hidden">{{ __('genla.company.name') }} — {{ __('genla.company.tagline') }}</h1>
                <picture>
                    <source srcset="{{ asset('genla-icon-no-bg.webp') }}?v=5" type="image/webp">
                    <img src="{{ asset('genla-icon-no-bg.png') }}?v=5"
                         alt="Genla" class="os__logo os__logo--shimmer"
                         width="1200" height="800" fetchpriority="high" decoding="async">
                </picture>
            </div>

            <div class="os__grid">
                @foreach ($gridLabs as $lab)
                    @if ($lab['is_ai'] ?? false)
                        <a class="os-tile os-tile--core" href="{{ \App\Support\Genla::aiUrl() }}"
                            aria-label="{{ __('genla.ui.ai_open_aria') }}">
                            <span class="os-tile__border" aria-hidden="true"></span>
                            {{-- «Восьмёрка» (∞) вместо повторного логотипа Genla --}}
                            <span class="os-core__infinity" aria-hidden="true">
                                <svg class="os__infinity" viewBox="-10 -10 120 70" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="genlaInfinity" x1="0" y1="0" x2="100" y2="0"
                                                        gradientUnits="userSpaceOnUse">
                                            <stop offset="0%" stop-color="#ff8ac4" />
                                            <stop offset="50%" stop-color="#ff4d9e" />
                                            <stop offset="100%" stop-color="#ff77b9" />
                                        </linearGradient>
                                    </defs>
                                    <path class="os__infinity-track"
                                          d="M50,25 C50,11.2 38.8,0 25,0 C11.2,0 0,11.2 0,25 C0,38.8 11.2,50 25,50 C38.8,50 50,38.8 50,25 C50,11.2 61.2,0 75,0 C88.8,0 100,11.2 100,25 C100,38.8 88.8,50 75,50 C61.2,50 50,38.8 50,25 Z" />
                                    <path class="os__infinity-dash" pathLength="100"
                                          d="M50,25 C50,11.2 38.8,0 25,0 C11.2,0 0,11.2 0,25 C0,38.8 11.2,50 25,50 C38.8,50 50,38.8 50,25 C50,11.2 61.2,0 75,0 C88.8,0 100,11.2 100,25 C100,38.8 88.8,50 75,50 C61.2,50 50,38.8 50,25 Z" />
                                </svg>
                            </span>
                            <span class="os-core__cta">
                                {{ __('genla.ui.ai_start') }}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </span>
                        </a>
                    @else
                        <a class="os-tile" href="{{ \App\Support\Genla::url($lab['slug']) }}"
                            style="--tile-hue: {{ 230 + (($lab['glyph'] % 9) * 13) }};">
                            <span class="os-tile__border" aria-hidden="true"></span>
                            <span class="os-tile__art">
                                @if (! empty($lab['tile_image']))
                                    @php $tileWebp = preg_replace('/\.png(\?|$)/', '.webp$1', $lab['tile_image']); @endphp
                                    <picture>
                                        <source srcset="{{ asset($tileWebp) }}" type="image/webp">
                                        <img src="{{ asset($lab['tile_image']) }}" alt="{{ $lab['name'] }}" class="os-tile__img" loading="lazy" decoding="async">
                                    </picture>
                                @endif
                            </span>
                            <span class="os-tile__body">
                                <span class="os-tile__name">{{ $lab['name'] }}</span>
                                <span class="os-tile__desc">{{ $lab['short'] }}</span>
                            </span>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </main>
@endsection
