@extends('layouts.base')

@section('title', __('genla.cases_page.title').' — '.__('genla.company.full_name'))
@section('description', __('genla.cases_page.lead'))

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        <section class="section">
            <div class="container">
                <div class="section__head section__head--center reveal">
                    <span class="eyebrow">{{ __('genla.cases_page.eyebrow') }}</span>
                    <h1 class="section__title">{{ __('genla.cases_page.title') }}</h1>
                    <p class="section__lead">{{ __('genla.cases_page.lead') }}</p>
                </div>

                <div class="grid grid--2">
                    @foreach ((array) __('genla.cases_page.items') as $idx => $c)
                        <article class="case-card case-card--full reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                            <span class="case-card__lab">{{ $c['industry'] }}</span>
                            <h3 class="case-card__title">{{ $c['title'] }}</h3>
                            <p class="case-card__scale"><strong>{{ __('genla.cases_page.l_scale') }}:</strong> {{ $c['scale'] }}</p>

                            <div class="case-block">
                                <h4 class="case-block__head">{{ __('genla.cases_page.l_before') }}</h4>
                                <p>{{ $c['before'] }}</p>
                            </div>
                            <div class="case-block">
                                <h4 class="case-block__head">{{ __('genla.cases_page.l_solution') }}</h4>
                                <p>{{ $c['solution'] }}</p>
                            </div>
                            <div class="case-block">
                                <h4 class="case-block__head">{{ __('genla.cases_page.l_result') }}</h4>
                                <ul class="case-result">
                                    @foreach ((array) $c['result'] as $r)
                                        <li>{!! preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', e($r)) !!}</li>
                                    @endforeach
                                </ul>
                            </div>

                            <button type="button" class="case-card__cta"
                                @click="$store.ui.openModal('consultation', null, null)">
                                {{ __('genla.cases_page.cta') }}
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <path d="M5 12h14M13 6l6 6-6 6" />
                                </svg>
                            </button>
                        </article>
                    @endforeach
                </div>

                <p class="fineprint" style="margin-top: 1.75rem;">{{ __('genla.cases_page.footnote') }}</p>
            </div>
        </section>

        {{-- Единый CTA-подвал (3 кнопки) --}}
        <x-footer-cta />
    </main>
@endsection
