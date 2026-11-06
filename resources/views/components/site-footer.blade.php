@php
    $contacts = config('genla.contacts');
@endphp

<footer class="site-footer">
    <div class="container container--wide site-footer__row">
        <a class="brand" href="{{ \App\Support\Genla::homeUrl() }}" aria-label="GENLA">
            <img src="{{ asset('genla-icon-no-bg.png') }}?v=3" alt="GENLA" class="brand__logo-img">
        </a>

        <nav class="footer-nav">
            @foreach (\App\Support\Genla::gridLabs() as $footLab)
                <a href="{{ \App\Support\Genla::url($footLab['slug']) }}">{{ $footLab['name'] }}</a>
            @endforeach
        </nav>

        <div class="footer-contacts">
            <a href="{{ $contacts['telegram']['url'] }}">{{ $contacts['telegram']['label'] }}</a>
            <a href="{{ $contacts['vk']['url'] }}">{{ $contacts['vk']['label'] }}</a>
            <a href="{{ $contacts['email']['url'] }}">{{ $contacts['email']['value'] }}</a>
            <span>{{ __('genla.company.city') }}</span>
        </div>
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
