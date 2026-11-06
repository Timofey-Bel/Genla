@php $current = app()->getLocale(); @endphp

<div {{ $attributes->merge(['class' => 'lang-switch']) }} role="group" aria-label="{{ __('genla.ui.lang_switch') }}">
    @foreach (\App\Support\Genla::locales() as $code => $meta)
        @if ($code === $current)
            <span class="lang-switch__item is-active" aria-current="true">{{ $meta['label'] }}</span>
        @else
            <a class="lang-switch__item" href="{{ \App\Support\Genla::switchUrl($code) }}"
                hreflang="{{ $meta['hreflang'] }}" rel="alternate"
                aria-label="{{ $meta['name'] }}">{{ $meta['label'] }}</a>
        @endif
    @endforeach
</div>
