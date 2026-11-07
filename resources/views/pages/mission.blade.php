@extends('layouts.base')

@section('title', __('genla.home.mission_eyebrow').' — '.__('genla.company.full_name'))
@section('description', __('genla.company.mission_short'))

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        <section class="section section--tint">
            <div class="container">
                <div class="section__head section__head--center reveal" style="max-width: 920px;">
                    <span class="eyebrow">{{ __('genla.home.mission_eyebrow') }}</span>
                    <p class="mission-statement">{{ __('genla.company.mission') }}</p>
                </div>
            </div>
        </section>

        {{-- Единый CTA-подвал (3 кнопки) --}}
        <x-footer-cta />
    </main>
@endsection
