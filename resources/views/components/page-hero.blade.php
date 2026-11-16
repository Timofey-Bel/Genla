@props([
    'hero' => [],
])

{{-- Первый экран контент-страницы: H1, подзаголовок, абзацы, карточки с цифрами, основные кнопки. --}}
<section class="section page-hero">
    <div class="container">
        <div class="section__head section__head--center reveal">
            <h1 class="section__title">{{ $hero['title'] ?? '' }}</h1>
            @if (! empty($hero['subtitle']))
                <p class="page-hero__subtitle">{{ $hero['subtitle'] }}</p>
            @endif
        </div>

        @if (! empty($hero['paragraphs']))
            <div class="prose prose--center reveal">
                @foreach ($hero['paragraphs'] as $p)
                    <p>{{ \App\Support\Genla::md($p) }}</p>
                @endforeach
            </div>
        @endif

        @if (! empty($hero['stats']))
            <div class="grid grid--{{ count($hero['stats']) }} stats">
                @foreach ($hero['stats'] as $idx => $s)
                    <div class="card stat-card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;">
                        <span class="stat-card__value">{{ $s['value'] }}</span>
                        <span class="stat-card__text">{{ $s['text'] }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="page-hero__actions reveal">
            <x-cta :actions="['consultation', 'presentation']" size="lg" />
            <a class="btn btn--chat btn--lg" href="{{ \App\Support\Genla::aiUrl() }}">{{ __('genla.ui.cta_chat') }}</a>
        </div>

        {{ $slot }}
    </div>
</section>
