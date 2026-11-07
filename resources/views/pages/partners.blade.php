@extends('layouts.base')

@section('title', __('genla.partners.title').' — '.__('genla.company.full_name'))
@section('description', __('genla.partners.lead'))

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        {{-- Интро --}}
        <section class="section">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.partners.eyebrow') }}</span>
                    <h1 class="section__title">{{ __('genla.partners.title') }}</h1>
                    <p class="section__lead">{{ __('genla.partners.lead') }}</p>
                </div>
                <p class="mission-statement reveal" style="text-align:center;">{{ __('genla.partners.share') }}</p>
            </div>
        </section>

        {{-- Аудитории: физлица / бизнес / НКО и госсектор --}}
        @foreach ((array) __('genla.partners.audiences') as $ai => $aud)
            <section class="section {{ $ai % 2 ? 'section--tint' : 'section--soft' }}">
                <div class="container">
                    <div class="section__head reveal">
                        <span class="eyebrow">{{ $aud['tag'] }}</span>
                        <h2 class="section__title">{{ $aud['title'] }}</h2>
                        <p class="section__lead">{{ $aud['lead'] }}</p>
                    </div>
                    <div class="grid grid--3">
                        @foreach ((array) $aud['points'] as $idx => $p)
                            <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                                <h3 class="card__title">{{ $p['title'] }}</h3>
                                <p class="card__text">{{ $p['text'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endforeach

        {{-- Как начать сотрудничество --}}
        <section class="section">
            <div class="container">
                <div class="section__head reveal">
                    <span class="eyebrow">{{ __('genla.partners.start_title') }}</span>
                </div>
                <div class="grid grid--3">
                    @foreach ((array) __('genla.partners.start') as $idx => $step)
                        <div class="card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <div class="card__index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            <p class="card__text">{{ $step }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Контакты партнёров + CTA --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.partners.contacts_title') }}</span>
                    @php $pc = __('genla.partners.contacts'); @endphp
                    <div class="page__contacts">
                        <a href="{{ $pc['telegram'] }}" target="_blank" rel="noopener">{{ $pc['telegram_label'] }}</a>
                        <a href="tel:{{ $pc['phone_href'] }}">{{ $pc['phone'] }}</a>
                        <a href="mailto:{{ $pc['email'] }}">{{ $pc['email'] }}</a>
                    </div>
                </div>
                <p class="fineprint" style="max-width: 760px; margin: 1.75rem auto 0; text-align: center;">{{ __('genla.partners.footnote') }}</p>
            </div>
        </section>

        {{-- Единый CTA-подвал (3 кнопки) --}}
        <x-footer-cta />
    </main>
@endsection
