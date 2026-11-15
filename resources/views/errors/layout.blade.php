{{-- Общий каркас страниц ошибок: хедер сайта для навигации + блок в стиле Genla.
     Расширяет базовый layout, поэтому Alpine, модалка и мобильное меню работают. --}}
@extends('layouts.base')

@push('head')
<style>
    .error-page { min-height: 60vh; min-height: 60dvh; display: flex; align-items: center; justify-content: center; text-align: center; padding: clamp(48px, 9vh, 96px) 20px; }
    .error-page__inner { max-width: 560px; margin: 0 auto; }
    .error-page__code { font-size: clamp(80px, 17vw, 168px); font-weight: 800; line-height: .92; letter-spacing: -.04em; margin: 0;
        background: linear-gradient(120deg, #ff4d9e 0%, #7a5cff 100%); -webkit-background-clip: text; background-clip: text;
        -webkit-text-fill-color: transparent; color: transparent; }
    .error-page__title { font-size: clamp(22px, 3.4vw, 30px); font-weight: 700; margin: .5rem 0 .4rem; }
    .error-page__text { font-size: 16px; line-height: 1.6; color: #5b6170; margin: 0 auto 1.9rem; max-width: 46ch; }
    .error-page__actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }
    @media (max-width: 540px) { .error-page__actions { flex-direction: column; } .error-page__actions .btn { width: 100%; } }
</style>
@endpush

@section('content')
    <x-site-header variant="page" />

    <main class="error-page">
        <div class="error-page__inner">
            <p class="error-page__code">@yield('code')</p>
            <h1 class="error-page__title">@yield('error_title')</h1>
            <p class="error-page__text">@yield('error_text')</p>
            <div class="error-page__actions">
                <a class="btn btn--primary btn--lg" href="{{ \App\Support\Genla::homeUrl() }}">{{ __('genla.errors.home') }}</a>
                <a class="btn btn--accent btn--lg" href="{{ \App\Support\Genla::aiUrl() }}">{{ __('genla.errors.ai') }}</a>
            </div>
        </div>
    </main>
@endsection
