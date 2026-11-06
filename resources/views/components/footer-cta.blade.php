@props([
    'lab' => null,
    'labName' => null,
    'title' => null,
    'lead' => null,
    'eyebrow' => null,
])

{{--
    Единый CTA-подвал для всех разделов и направлений.
    Ровно три кнопки (стандарт genla.tech):
      1. «Заказать консультацию» → модальное окно с формой заявки
      2. «Получить презентацию»  → модальное окно с формой заявки
      3. «Обсудить сейчас»       → переход на ai.genla.tech (ссылка, не оверлей)
--}}

@php
    $labArg = $lab ? "'".e($lab)."'" : 'null';
    $nameArg = $labName ? "'".str_replace("'", "\\'", $labName)."'" : 'null';
@endphp

<section class="section section--tint lab-cta">
    <div class="container">
        <div class="lab-cta__inner reveal">
            <span class="eyebrow lab-cta__eyebrow">{{ $eyebrow ?? 'Genla' }}</span>
            <h2 class="lab-cta__title">{{ $title ?? __('genla.ui.lab_cta_title') }}</h2>
            <p class="lab-cta__lead">{{ $lead ?? __('genla.ui.footer_cta_lead') }}</p>

            <div class="lab-cta__actions">
                <div class="cta-group">
                    <button type="button" class="btn btn--primary btn--lg"
                        @click="$store.ui.openModal('consultation', {{ $labArg }}, {{ $nameArg }})">
                        {{ __('genla.actions.consultation') }}
                    </button>
                    <button type="button" class="btn btn--ghost btn--lg"
                        @click="$store.ui.openModal('presentation', {{ $labArg }}, {{ $nameArg }})">
                        {{ __('genla.actions.presentation') }}
                    </button>
                    <a class="btn btn--chat btn--lg" href="{{ \App\Support\Genla::aiUrl() }}">
                        {{ __('genla.ui.lab_cta_chat') }}
                    </a>
                </div>
            </div>
        </div>

        <p class="fineprint" style="max-width: 680px; margin: 1.75rem auto 0; text-align: center;">{{ __('genla.ui.legal_disclaimer') }}</p>
    </div>
</section>
