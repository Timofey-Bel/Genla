@props([
    'sections' => [],
    // Смещение чередования фонов (чтобы соседние блоки разных источников не сливались).
    'offset' => 0,
])

{{--
    Универсальный вывод разделов страницы из lang (см. storage схему блоков):
    title, eyebrow, lead, paragraphs, layout (cards|steps|list|faq|table|audiences),
    cols, items, table, after, footer. Строки поддерживают **жирный**.
--}}

@php
    $md = fn ($t) => \App\Support\Genla::md($t);
    $tones = ['section--tint', '', 'section--soft', ''];
@endphp

@foreach ((array) $sections as $i => $b)
    @php
        $layout = $b['layout'] ?? null;
        $cols = $b['cols'] ?? 2;
        $tone = $tones[($i + $offset) % count($tones)];
    @endphp
    <section class="section section--block {{ $tone }}">
        <div class="container">
            <div class="section__head reveal">
                @if (! empty($b['eyebrow']))
                    <span class="eyebrow">{{ $b['eyebrow'] }}</span>
                @endif
                <h2 class="section__title section__title--md">{{ $b['title'] }}</h2>
                @if (! empty($b['lead']))
                    <p class="section__lead">{{ $md($b['lead']) }}</p>
                @endif
            </div>

            @if (! empty($b['paragraphs']))
                <div class="prose reveal">
                    @foreach ($b['paragraphs'] as $p)
                        <p>{{ $md($p) }}</p>
                    @endforeach
                </div>
            @endif

            @if (in_array($layout, ['cards', 'steps', 'audiences'], true) && ! empty($b['items']))
                <div class="grid grid--{{ $cols }} blocks__grid">
                    @foreach ($b['items'] as $idx => $item)
                        <div class="card reveal {{ $layout === 'audiences' ? 'card--audience' : '' }}"
                            style="--reveal-delay: {{ ($idx % 4) * 0.05 }}s;">
                            @if (! empty($item['image']))
                                @php $webp = preg_replace('/\.png(\?|$)/', '.webp$1', $item['image']); @endphp
                                <div class="product-card__image product-card__image--contain">
                                    <picture>
                                        <source srcset="{{ $webp }}" type="image/webp">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['alt'] ?? '' }}" loading="lazy" decoding="async" style="object-fit:contain;width:100%;height:auto;max-height:none;">
                                    </picture>
                                </div>
                            @endif
                            @if ($layout === 'steps')
                                <div class="card__index">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</div>
                            @endif
                            @if (! empty($item['label']))
                                <span class="card__label">{{ $item['label'] }}</span>
                            @endif
                            <h3 class="card__title">{{ $item['title'] }}</h3>
                            @foreach ((array) ($item['paragraphs'] ?? []) as $p)
                                <p class="card__text">{{ $md($p) }}</p>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @elseif ($layout === 'list' && ! empty($b['items']))
                <ul class="dot-list blocks__list reveal">
                    @foreach ($b['items'] as $item)
                        @if (is_array($item))
                            <li>@if (! empty($item['title']))<strong>{{ $item['title'] }}.</strong> @endif{{ $md($item['text']) }}</li>
                        @else
                            <li>{{ $md($item) }}</li>
                        @endif
                    @endforeach
                </ul>
            @elseif ($layout === 'faq' && ! empty($b['items']))
                <div class="faq reveal">
                    @foreach ($b['items'] as $f)
                        <details class="faq__item">
                            <summary>{{ $f['q'] }}</summary>
                            <div class="faq__answer">{{ $md($f['a']) }}</div>
                        </details>
                    @endforeach
                </div>
            @elseif ($layout === 'table' && ! empty($b['table']))
                <div class="data-table reveal">
                    <table>
                        <thead>
                            <tr>
                                @foreach ($b['table']['head'] as $h)
                                    <th scope="col">{{ $h }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($b['table']['rows'] as $row)
                                <tr>
                                    @foreach ($row as $ci => $cell)
                                        <td data-label="{{ $b['table']['head'][$ci] ?? '' }}">{{ $md($cell) }}</td>
                                    @endforeach
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            @if (! empty($b['after']))
                <div class="prose prose--after reveal">
                    @foreach ($b['after'] as $p)
                        <p>{{ $md($p) }}</p>
                    @endforeach
                </div>
            @endif

            @if (! empty($b['footer']))
                <p class="hook-quote reveal">{{ $md($b['footer']) }}</p>
            @endif
        </div>
    </section>
@endforeach
