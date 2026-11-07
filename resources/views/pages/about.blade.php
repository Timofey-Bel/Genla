@extends('layouts.base')

@section('title', __('genla.about.eyebrow').' — '.__('genla.company.full_name'))
@section('description', __('genla.about.title'))

@section('content')
    <x-site-header variant="page" />

    @php $contacts = config('genla.contacts'); @endphp

    <main class="page">
        {{-- Интро --}}
        <section class="section">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.about.eyebrow') }}</span>
                    <h1 class="section__title">{{ __('genla.about.title') }}</h1>
                    @foreach ((array) __('genla.about.intro') as $p)
                        <p class="section__lead">{{ $p }}</p>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Три компании в одной --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.about.pillars_title') }}</span>
                    <p class="section__lead">{{ __('genla.about.pillars_lead') }}</p>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.about.pillars') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <div class="card__index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
                <p class="section__lead reveal" style="margin-top: 1.6rem;">{{ __('genla.about.pillars_footer') }}</p>
            </div>
        </section>

        {{-- Больше, чем искусственный --}}
        <section class="section">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.about.qualities_title') }}</span>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.about.qualities') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Что мы делаем --}}
        <section class="section section--soft">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.about.do_title') }}</span>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.about.do') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Как мы работаем --}}
        <section class="section">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.about.how_title') }}</span>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.about.how') as $idx => $a)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <div class="card__index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h3 class="card__title">{{ $a['title'] }}</h3>
                            <p class="card__text">{{ $a['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Заключение --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <p class="mission-statement">{{ __('genla.about.closing') }}</p>
                </div>
            </div>
        </section>

        {{-- Контакты --}}
        <section class="section">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.ui.tab_contact') }}</span>
                    <div class="page__contacts">
                        <a href="{{ $contacts['telegram']['url'] }}">{{ $contacts['telegram']['label'] }}</a>
                        <a href="{{ $contacts['vk']['url'] }}">{{ $contacts['vk']['label'] }}</a>
                        <a href="{{ $contacts['email']['url'] }}">{{ $contacts['email']['value'] }}</a>
                        <span>{{ __('genla.company.city') }}</span>
                        <a href="{{ url(\App\Support\Genla::prefix().'/privacy') }}">{{ __('genla.ui.privacy') }}</a>
                    </div>
                </div>
            </div>
        </section>

        {{-- Единый CTA-подвал (3 кнопки) --}}
        <x-footer-cta />
    </main>
@endsection
