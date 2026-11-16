@extends('layouts.base')

@php
    $md = fn ($t) => \App\Support\Genla::md($t);
    $plain = fn ($t) => \App\Support\Genla::plain($t);
    $audienceTitles = (array) __('genla.audiences');
@endphp

@section('title', $lab['seo_title'] ?? ($lab['name'].' · Genla'))
@section('description', $plain($lab['seo_description'] ?? ''))
{{-- og:image берётся из единого брендового превью og-cover.png (layouts.base) --}}

@push('jsonld')
    @php
        $service = array_filter([
            '@context' => 'https://schema.org',
            '@type' => 'Service',
            'name' => $lab['name'],
            'serviceType' => $lab['subtitle'] ?? null,
            'description' => $plain($lab['seo_description'] ?? ''),
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
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $plain($f['a'])],
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
        {{-- Первый экран: название (H1), подзаголовок, вводный абзац, изображение --}}
        <section class="hero">
            <div class="container hero__inner">
                <div class="hero__content reveal">
                    <span class="eyebrow">{{ __('genla.company.name') }} · {{ __('genla.ui.lab_eyebrow') }}</span>
                    <h1 class="hero__title">{{ $lab['name'] }}</h1>
                    <p class="hero__subtitle">{{ $lab['subtitle'] ?? '' }}</p>
                    @if (! empty($lab['intro']))
                        <p class="hero__intro">{{ $md($lab['intro']) }}</p>
                    @endif
                    @if (! empty($lab['status']))
                        <p class="hero__status">{{ $lab['status'] }}</p>
                    @endif
                    <div class="hero__actions">
                        <x-cta :actions="$lab['actions']" :lab="$lab['slug']" :labName="$lab['name']" size="lg" />
                    </div>
                </div>

                <x-media :lab="$lab" :alt="$lab['name']" :src="$lab['hero_image'] ?? null" />
            </div>
        </section>

        {{-- Миссия --}}
        @if (! empty($lab['mission']))
            <section class="section section--block section--tint">
                <div class="container">
                    <div class="section__head section__head--center reveal">
                        <h2 class="section__title section__title--md">{{ __('genla.ui.mission') }}</h2>
                        <p class="mission-statement">{{ $md($lab['mission']) }}</p>
                    </div>
                </div>
            </section>
        @endif

        {{-- О лаборатории --}}
        @if (! empty($lab['about']))
            <section class="section section--block">
                <div class="container">
                    <div class="section__head reveal">
                        <h2 class="section__title section__title--md">{{ __('genla.ui.about_lab') }}</h2>
                    </div>
                    <div class="prose reveal">
                        @foreach ($lab['about'] as $p)
                            <p>{{ $md($p) }}</p>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Что предлагаем и дополнительные смысловые блоки --}}
        <x-blocks :sections="$lab['sections'] ?? []" :offset="2" />

        {{-- Что вы получите — четыре аудитории --}}
        @if (! empty($lab['audiences']))
            <section class="section section--block section--tint">
                <div class="container">
                    <div class="section__head reveal">
                        <h2 class="section__title section__title--md">{{ __('genla.ui.audiences_title') }}</h2>
                    </div>
                    <div class="grid grid--2 blocks__grid">
                        @foreach ($lab['audiences'] as $idx => $paragraphs)
                            <div class="card card--audience reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                                <h3 class="card__title">{{ $audienceTitles[$idx] ?? '' }}</h3>
                                @foreach ((array) $paragraphs as $p)
                                    <p class="card__text">{{ $md($p) }}</p>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Частые вопросы --}}
        @if (! empty($lab['faq']))
            <section class="section section--block">
                <div class="container">
                    <div class="section__head section__head--center reveal">
                        <h2 class="section__title section__title--md">{{ __('genla.ui.faq_title') }}</h2>
                    </div>
                    <div class="faq reveal">
                        @foreach ($lab['faq'] as $f)
                            <details class="faq__item">
                                <summary>{{ $f['q'] }}</summary>
                                <div class="faq__answer">{{ $md($f['a']) }}</div>
                            </details>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        {{-- Обсудим вашу задачу — единый подвал с существующими кнопками --}}
        <x-footer-cta :lab="$lab['slug']" :labName="$lab['name']"
            :eyebrow="'Genla · '.$lab['name']" :lead="$lab['closing'] ?? null" />
    </main>
@endsection
