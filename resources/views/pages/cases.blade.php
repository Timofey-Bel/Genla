@extends('layouts.base')

@php
    $data = (array) __('genla.cases');
    $l = $data['labels'] ?? [];
    $md = fn ($t) => \App\Support\Genla::md($t);
@endphp

@section('title', $data['seo_title'] ?? '')
@section('description', $data['seo_description'] ?? '')

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        <x-page-hero :hero="$data['hero'] ?? []" />

        {{-- 18 кейсов: компактная карточка + полное описание в раскрывающемся блоке --}}
        <section class="section section--tint">
            <div class="container">
                <div class="grid grid--2 cases-grid">
                    @foreach ((array) ($data['items'] ?? []) as $idx => $c)
                        <article class="case-card case-card--full reveal" style="--reveal-delay: {{ ($idx % 2) * 0.05 }}s;">
                            <span class="case-card__lab">{{ $c['num'] }} · {{ $c['industry'] }}</span>
                            <h2 class="case-card__title">{{ $c['title'] }}</h2>
                            <p class="case-card__scale"><strong>{{ $l['labs'] ?? '' }}:</strong> {{ $c['labs'] }}</p>

                            <ul class="case-result case-metrics">
                                @foreach ((array) $c['metrics'] as $m)
                                    <li>{{ $md($m) }}</li>
                                @endforeach
                            </ul>

                            <details class="case-details">
                                <summary>
                                    <span class="case-details__more">{{ $l['more'] ?? '' }}</span>
                                    <span class="case-details__less">{{ $l['less'] ?? '' }}</span>
                                </summary>

                                <p class="case-card__scale"><strong>{{ $l['industry'] ?? '' }}:</strong> {{ $c['industry'] }}</p>
                                @if (! empty($c['role']))
                                    <p class="case-card__scale"><strong>{{ $l['role'] ?? '' }}:</strong> {{ $c['role'] }}</p>
                                @endif

                                <div class="case-block">
                                    <h3 class="case-block__head">{{ $l['task'] ?? '' }}</h3>
                                    <p>{{ $md($c['task']) }}</p>
                                </div>
                                <div class="case-block">
                                    <h3 class="case-block__head">{{ $l['solution'] ?? '' }}</h3>
                                    <p>{{ $md($c['solution']) }}</p>
                                </div>
                                <div class="case-block">
                                    <h3 class="case-block__head">{{ $l['result'] ?? '' }}</h3>
                                    @foreach ((array) $c['result'] as $r)
                                        <p>{{ $md($r) }}</p>
                                    @endforeach
                                </div>

                                {{-- Расчётный пример — отдельно от достигнутых результатов --}}
                                @if (! empty($c['estimate']))
                                    <div class="case-block case-estimate">
                                        <h3 class="case-block__head">{{ $l['estimate'] ?? '' }}</h3>
                                        <p>{{ $md($c['estimate']) }}</p>
                                    </div>
                                @endif
                            </details>

                            <button type="button" class="case-card__cta"
                                @click="$store.ui.openModal('consultation', null, null)">
                                {{ $l['cta'] ?? '' }}
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </button>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <x-blocks :sections="$data['sections'] ?? []" :offset="1" />

        <x-footer-cta :title="$data['closing']['title'] ?? null" :lead="$data['closing']['text'] ?? null" />
    </main>
@endsection
