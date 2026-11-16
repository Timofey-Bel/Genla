@extends('layouts.base')

@section('title', __('genla.partner_consent.title').' — '.__('genla.company.full_name'))
@section('description', __('genla.partner_consent.intro'))

@section('content')
    <x-site-header variant="lab" />

    <main class="legal">
        <div class="container container--narrow">
            <a class="header-back legal__back" href="{{ url(\App\Support\Genla::prefix().'/become-partner') }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                {{ __('genla.ui.nav_partners') }}
            </a>

            <h1 class="legal__title">{{ __('genla.partner_consent.title') }}</h1>
            <p class="legal__intro">{{ __('genla.partner_consent.intro') }}</p>

            @foreach ((array) __('genla.partner_consent.sections') as $section)
                <section class="legal__section">
                    <h2 class="legal__heading">{{ $section['heading'] ?? '' }}</h2>
                    @foreach ((array) ($section['body'] ?? []) as $p)
                        <p class="legal__text">{{ $p }}</p>
                    @endforeach
                </section>
            @endforeach
        </div>
    </main>
@endsection
