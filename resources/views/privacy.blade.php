@extends('layouts.base')

@section('title', __('genla.legal.title').' — '.__('genla.company.full_name'))
@section('description', __('genla.legal.intro'))

@section('content')
    <x-site-header variant="lab" />

    <main class="legal">
        <div class="container container--narrow">
            <a class="header-back legal__back" href="{{ \App\Support\Genla::homeUrl() }}">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M19 12H5M12 19l-7-7 7-7" />
                </svg>
                {{ __('genla.ui.footer_back') }}
            </a>

            <h1 class="legal__title">{{ __('genla.legal.title') }}</h1>
            <p class="legal__intro">{{ __('genla.legal.intro') }}</p>

            @php $sections = __('genla.legal.sections'); @endphp
            @if (is_array($sections))
                @foreach ($sections as $section)
                    <section class="legal__section">
                        <h2 class="legal__heading">{{ $section['heading'] ?? '' }}</h2>
                        @foreach ((array) ($section['body'] ?? []) as $p)
                            <p class="legal__text">{{ $p }}</p>
                        @endforeach
                    </section>
                @endforeach
            @endif
        </div>
    </main>
@endsection
