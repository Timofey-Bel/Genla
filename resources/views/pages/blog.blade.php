@extends('layouts.base')

@section('title', __('genla.expertise.title').' — '.__('genla.company.full_name'))
@section('description', __('genla.expertise.lead'))

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        {{-- Философия эволюции --}}
        <section class="section">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.expertise.eyebrow') }}</span>
                    <h1 class="section__title">{{ __('genla.expertise.title') }}</h1>
                    <p class="section__lead">{{ __('genla.expertise.lead') }}</p>
                    <p class="section__lead">{{ __('genla.expertise.lead2') }}</p>
                </div>
                <div class="grid grid--2">
                    @foreach ((array) __('genla.expertise.stages') as $idx => $s)
                        <article class="stage-card reveal" style="--reveal-delay: {{ $idx * 0.06 }}s;">
                            <div class="stage-card__index">0{{ $idx + 1 }}</div>
                            <h3 class="stage-card__name">{{ $s['name'] }}</h3>
                            <span class="stage-card__tag">{{ $s['tag'] }}</span>
                            <p class="stage-card__sub">{{ $s['sub'] }}</p>
                            <p class="stage-card__text">{{ $s['text'] }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Технологическое ядро / хаб --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <p class="mission-statement">{{ __('genla.expertise.hub_lead') }}</p>
                </div>
            </div>
        </section>

        {{-- Технологический стек --}}
        <section class="section">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.expertise.stack_title') }}</span>
                </div>
                <div class="grid grid--2">
                    @foreach ((array) __('genla.expertise.stack') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Сообщества --}}
        <section class="section section--soft">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.expertise.community_title') }}</span>
                </div>
                <div class="grid grid--2">
                    @foreach ((array) __('genla.expertise.community') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Научно-методологический фундамент --}}
        <section class="section">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.expertise.foundation_title') }}</span>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.expertise.foundation') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Резюме для корпоративного клиента --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <p class="mission-statement">{{ __('genla.expertise.summary') }}</p>
                </div>
            </div>
        </section>

        {{-- Единый CTA-подвал (3 кнопки) --}}
        <x-footer-cta />
    </main>
@endsection
