@props(['index' => 0])

@php
    $i = ((int) $index) % 10;
    $inner = match ($i) {
        // Ядро — ассистент
        0 => '<circle cx="24" cy="24" r="5"/><circle cx="24" cy="8" r="2.4"/><circle cx="40" cy="32" r="2.4"/><circle cx="8" cy="32" r="2.4"/><path d="M24 19V10.4M27 27l11 4.5M21 27l-11 4.5"/>',
        // GenStart — вход
        1 => '<circle cx="11" cy="24" r="3"/><path d="M15 24h19"/><path d="M28 17l8 7-8 7"/>',
        // GenCheck — аудит
        2 => '<circle cx="21" cy="21" r="10"/><path d="M28.5 28.5 39 39"/><path d="M16.5 21l3.5 3.5 6-7"/>',
        // GenEtics — связанные узлы
        3 => '<circle cx="18" cy="18" r="6"/><circle cx="31" cy="31" r="6"/><path d="M22.2 22.2 26.8 26.8"/>',
        // GenOps — среда/окно
        4 => '<rect x="8" y="10" width="32" height="28" rx="3"/><path d="M8 18h32"/><circle cx="12.5" cy="14" r="1"/><circle cx="16.5" cy="14" r="1"/>',
        // GenBox — серверы
        5 => '<rect x="10" y="9" width="28" height="11" rx="2.5"/><rect x="10" y="24" width="28" height="11" rx="2.5"/><circle cx="15" cy="14.5" r="1.2"/><circle cx="15" cy="29.5" r="1.2"/>',
        // GenCluster — кластер
        6 => '<circle cx="14" cy="14" r="2.6"/><circle cx="34" cy="14" r="2.6"/><circle cx="14" cy="34" r="2.6"/><circle cx="34" cy="34" r="2.6"/><path d="M14 14h20M14 34h20M14 14v20M34 14v20M14 14l20 20M34 14L14 34"/>',
        // GenCopilot — диалог
        7 => '<rect x="8" y="12" width="32" height="20" rx="4"/><path d="M16 32v7l8-7"/><path d="M16 19h16M16 25h10"/>',
        // GenClaw — автономный агент
        8 => '<circle cx="24" cy="24" r="6"/><path d="M24 8v6M24 34v6M8 24h6M34 24h6M13 13l4 4M31 31l4 4M35 13l-4 4M17 31l-4 4"/>',
        // GenDev — код
        9 => '<path d="M18 14 8 24l10 10"/><path d="M30 14l10 10-10 10"/><path d="M26 12l-4 24"/>',
    };
@endphp

<svg {{ $attributes->merge(['class' => 'glyph']) }} viewBox="0 0 48 48" fill="none" stroke="currentColor"
    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    {!! $inner !!}
</svg>
