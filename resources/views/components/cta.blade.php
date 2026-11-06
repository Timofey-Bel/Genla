@props([
    'actions' => [],
    'lab' => null,
    'labName' => null,
    'size' => null,
    'block' => false,
])

@php
    $sizeClass = $size === 'lg' ? 'btn--lg' : '';
    $blockClass = $block ? 'btn--block' : '';
    $labArg = $lab ? "'".e($lab)."'" : 'null';
    $nameArg = $labName ? "'".str_replace("'", "\\'", $labName)."'" : 'null';
@endphp

<div class="cta-group">
    @foreach ($actions as $key)
        @php $a = config("genla.actions.$key"); @endphp
        @continue(! $a)

        @if (($a['type'] ?? 'lead') === 'chat')
            <button type="button" class="btn btn--chat {{ $sizeClass }} {{ $blockClass }}"
                @click="$store.ui.openChat()">
                {{ __('genla.actions.'.$key) }}
            </button>
        @else
            <button type="button"
                class="btn {{ ($a['primary'] ?? false) ? 'btn--primary' : 'btn--ghost' }} {{ $sizeClass }} {{ $blockClass }}"
                @click="$store.ui.openModal('{{ $key }}', {{ $labArg }}, {{ $nameArg }})">
                {{ __('genla.actions.'.$key) }}
            </button>
        @endif
    @endforeach
</div>
