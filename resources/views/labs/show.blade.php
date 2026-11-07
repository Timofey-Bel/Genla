@extends('layouts.base')

@section('title', $lab['name'].' — '.$lab['hero_subtitle'].' · Genla')
@section('description', $lab['description'])
{{-- og:image берётся из единого брендового превью og-cover.png (layouts.base) --}}

@push('jsonld')
    @php
        $service = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $lab['name'],
            'serviceType' => $lab['hero_subtitle'],
            'description' => $lab['description'],
            'url' => url()->current(),
            'areaServed' => 'RU',
            'provider' => [
                '@type' => 'Organization',
                'name' => __('genla.company.full_name'),
                'url' => \App\Support\Genla::homeUrl(),
            ],
        ]);

        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => collect($lab['faq'] ?? [])->map(fn ($f) => [
                '@type' => 'Question',
                'name' => $f['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f['a']],
            ])->all(),
        ];
    @endphp
    <script type="application/ld+json">{!! json_encode($service, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @if (! empty($lab['faq']))
        <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @endif
@endpush

@section('content')
    <x-site-header variant="lab" :lab="$lab" />

    <main class="lab">
        {{-- Hero --}}
        <section class="hero">
            <div class="container hero__inner">
                <div class="hero__content reveal">
                    <span class="eyebrow">{{ __('genla.company.name') }} · {{ __('genla.ui.lab_eyebrow') }}</span>
                    <h1 class="hero__title">{{ $lab['hero_title'] }}</h1>
                    <p class="hero__subtitle">{{ $lab['hero_subtitle'] }}</p>
                    <div class="hero__actions">
                        <x-cta :actions="$lab['actions']" :lab="$lab['slug']" :labName="$lab['name']" size="lg" />
                    </div>
                </div>

                @if ($lab['is_ai'] ?? false)
                    <div class="reveal">
                        <x-chat :embedded="true" />
                    </div>
                @else
                    <x-media :lab="$lab" :alt="$lab['name']" :src="$lab['hero_image'] ?? null" />
                @endif
            </div>
        </section>

        {{-- Описание --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.ui.about_lab') }}</span>
                    <h2 class="section__title">{{ $lab['name'] }}</h2>
                    <p class="section__lead">{{ $lab['description'] }}</p>
                </div>
            </div>
        </section>

        {{-- Возможности --}}
        @if (! empty($lab['features']))
            <section class="section">
                <div class="container">
                    <div class="section__head reveal">
                        <span class="eyebrow">{{ __('genla.ui.features_eyebrow') }}</span>
                        <h2 class="section__title">{{ __('genla.ui.features_title') }}</h2>
                    </div>
                    <div class="grid grid--4">
                        @foreach ($lab['features'] as $idx => $f)
                            <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                                <div class="card__index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                                <h3 class="card__title">{{ $f['title'] }}</h3>
                                <p class="card__text">{{ $f['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Преимущества --}}
        @if (! empty($lab['advantages']))
            <section class="section section--soft">
                <div class="container">
                    <div class="section__head reveal">
                        <span class="eyebrow">{{ __('genla.ui.advantages_eyebrow') }}</span>
                        <h2 class="section__title">{{ __('genla.ui.advantages_title') }}</h2>
                    </div>
                    <div class="grid grid--3">
                        @foreach ($lab['advantages'] as $idx => $a)
                            <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                                <x-glyph :index="($lab['glyph'] + $idx) % 10" class="card__glyph" />
                                <h3 class="card__title">{{ $a['title'] }}</h3>
                                <p class="card__text">{{ $a['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Продукты / услуги --}}
        @if (! empty($lab['products']))
            <section class="section">
                <div class="container">
                    <div class="section__head reveal">
                        <span class="eyebrow">{{ __('genla.ui.products_eyebrow') }}</span>
                        <h2 class="section__title">{{ __('genla.ui.products_title') }}</h2>
                    </div>
                    <div class="grid grid--3">
                        @foreach ($lab['products'] as $idx => $p)
                            <div class="product-card reveal" style="--reveal-delay: {{ $idx * 0.04 }}s;">
                                @if (! empty($p['image']))
                                    <div class="product-card__image">
                                        <img src="{{ $p['image'] }}" alt="{{ $p['name'] }}" loading="lazy" decoding="async">
                                    </div>
                                @endif
                                <span class="product-card__name">{{ $p['name'] }}</span>
                                <span class="product-card__text">{{ $p['text'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Кейсы --}}
        @if (! empty($lab['cases']))
            <section class="section section--soft">
                <div class="container">
                    <div class="section__head reveal">
                        <span class="eyebrow">{{ __('genla.ui.cases_eyebrow') }}</span>
                        <h2 class="section__title">{{ __('genla.ui.cases_title') }}</h2>
                    </div>
                    <div class="grid grid--2">
                        @foreach ($lab['cases'] as $idx => $c)
                            <div class="case-card reveal" style="--reveal-delay: {{ $idx * 0.06 }}s;">
                                <h3 class="case-card__title">{{ $c['title'] }}</h3>
                                <p class="case-card__text">{{ $c['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- FAQ --}}
        @if (! empty($lab['faq']))
            <section class="section">
                <div class="container">
                    <div class="section__head section__head--center reveal">
                        <span class="eyebrow">{{ __('genla.ui.faq_eyebrow') }}</span>
                        <h2 class="section__title">{{ __('genla.ui.faq_title') }}</h2>
                    </div>
                    <div class="faq reveal">
                        @foreach ($lab['faq'] as $f)
                            <details class="faq__item">
                                <summary>{{ $f['q'] }}</summary>
                                <div class="faq__answer">{{ $f['a'] }}</div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Дисклеймер лаборатории (мелкий серый шрифт, чтобы не бросался в глаза) --}}
        @if (! empty($lab['footnote']))
            <section class="section" style="padding-top: 0;">
                <div class="container">
                    <p class="fineprint" style="max-width: 760px; margin: 0 auto; text-align: center;">{{ $lab['footnote'] }}</p>
                </div>
            </section>
        @endif

        {{-- Финальный CTA — единый подвал из 3 кнопок --}}
        <x-footer-cta :lab="$lab['slug']" :labName="$lab['name']"
            :eyebrow="'Genla · '.$lab['name']" :lead="$lab['hero_subtitle'].'.'" />
    </main>
@endsection
