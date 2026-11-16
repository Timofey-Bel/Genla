@php
    $contacts = config('genla.contacts');
@endphp

<footer class="site-footer">
    <div class="container container--wide site-footer__top">
        <a class="brand" href="{{ \App\Support\Genla::homeUrl() }}" aria-label="GENLA">
            <img src="{{ asset('genla-icon-no-bg.png') }}?v=5" alt="GENLA" class="brand__logo-img" decoding="async">
        </a>

        <nav class="footer-nav">
            @foreach (\App\Support\Genla::gridLabs() as $footLab)
                @continue($footLab['is_ai'] ?? false)
                <a href="{{ \App\Support\Genla::url($footLab['slug']) }}">{{ $footLab['name'] }}</a>
            @endforeach
        </nav>
    </div>

    <div class="container container--wide site-footer__contacts">
        <div class="footer-contacts">
            <a href="{{ $contacts['phone']['url'] }}">{{ $contacts['phone']['label'] }}</a>
            <a href="{{ $contacts['telegram']['url'] }}">{{ $contacts['telegram']['label'] }}</a>
            <a href="{{ $contacts['vk']['url'] }}">{{ $contacts['vk']['label'] }}</a>
            <a href="{{ $contacts['email']['url'] }}">{{ $contacts['email']['value'] }}</a>
        </div>
        <span class="footer-address">{{ __('genla.company.address') }}</span>
    </div>

    <div class="container container--wide site-footer__bottom">
        <span>© {{ date('Y') }} {{ __('genla.company.full_name') }}</span>
        <span class="site-footer__links">
            <a href="{{ url(\App\Support\Genla::prefix().'/privacy') }}">{{ __('genla.ui.privacy') }}</a>
            <a href="{{ \App\Support\Genla::homeUrl() }}">{{ __('genla.ui.footer_back') }}</a>
        </span>
    </div>

    <div class="container container--wide site-footer__legal">
        <p class="fineprint">{{ __('genla.ui.legal_disclaimer') }}</p>
    </div>
</footer>
