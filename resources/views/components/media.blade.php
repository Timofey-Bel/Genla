@props([
    'lab' => null,
    'alt' => '',
    'src' => null, // ['avif'=>..,'webp'=>..,'fallback'=>..] — когда появятся реальные изображения
])

<div class="media reveal">
    <div class="media-frame {{ $src && ! empty($src['fallback']) ? 'media-frame--photo' : '' }}">
        @if ($src && ! empty($src['fallback']))
            <picture>
                @if (! empty($src['avif']))
                    <source srcset="{{ $src['avif'] }}" type="image/avif">
                @endif
                @if (! empty($src['webp']))
                    <source srcset="{{ $src['webp'] }}" type="image/webp">
                @endif
                <img src="{{ $src['fallback'] }}" alt="{{ $alt }}" loading="lazy" decoding="async">
            </picture>
        @else
            <div class="media-placeholder">
                <x-glyph :index="$lab['glyph'] ?? 0" class="media-placeholder__mark" />
                <span class="media-placeholder__label">Изображение</span>
            </div>
        @endif
    </div>
</div>
