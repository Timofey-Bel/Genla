@extends('layouts.base')

@php
    $data = (array) __('genla.become_partner');
    $f = (array) __('genla.partner_form');
    $p = \App\Support\Genla::prefix();
    // Фоновая серверная проверка «человек ли это»: подписанная метка времени показа формы.
    $formToken = \Illuminate\Support\Facades\Crypt::encryptString((string) now()->timestamp);
@endphp

@section('title', $data['seo_title'] ?? '')
@section('description', $data['seo_description'] ?? '')

@section('content')
    <x-site-header variant="page" />

    <main class="page">
        <x-page-hero :hero="$data['hero'] ?? []" />

        {{-- Четыре роли: выбор переводит к форме и подставляет роль --}}
        <section class="section section--tint">
            <div class="container">
                <div class="section__head reveal">
                    <h2 class="section__title section__title--md">{{ $data['roles_title'] ?? '' }}</h2>
                </div>
                <div class="grid grid--4 blocks__grid">
                    @foreach ((array) ($data['roles'] ?? []) as $idx => $role)
                        <button type="button" class="card role-card reveal" style="--reveal-delay: {{ $idx * 0.05 }}s;"
                            @click="window.dispatchEvent(new CustomEvent('partner-role', { detail: '{{ $role['key'] }}' })); document.getElementById('partner-form').scrollIntoView({ behavior: 'smooth' })">
                            <h3 class="card__title">{{ $role['title'] }}</h3>
                            <p class="card__text">{{ \App\Support\Genla::md($role['text']) }}</p>
                            <span class="role-card__cta">{{ $data['role_cta'] ?? '' }} →</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </section>

        <x-blocks :sections="$data['sections'] ?? []" :offset="1" />

        {{-- Единая короткая форма для всех ролей --}}
        <section class="section section--tint" id="partner-form">
            <div class="container">
                <div class="partner-form reveal" x-data="partnerForm('{{ $formToken }}')">
                    <div class="section__head section__head--center">
                        <h2 class="section__title section__title--md">{{ $f['title'] }}</h2>
                        <p class="section__lead">{{ $f['text'] }}</p>
                    </div>

                    <div class="form-success" x-show="sent" x-cloak>
                        <div class="form-success__icon">
                            <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5" /></svg>
                        </div>
                        <p class="form-success__text" role="status">{{ $f['success'] }}</p>
                    </div>

                    <form class="form" x-show="!sent" @submit.prevent="submit()" novalidate>
                        <div class="field" :class="{ 'field--invalid': errors.role }">
                            <label class="field__label" for="pf-role">{{ $f['role_label'] }} *</label>
                            <select class="field__input" id="pf-role" x-model="form.role" required>
                                @foreach ($f['roles'] as $key => $label)
                                    <option value="{{ $key }}">{{ $label }}</option>
                                @endforeach
                            </select>
                            <span class="field__error" x-show="errors.role" x-text="errors.role" x-cloak></span>
                        </div>

                        <div class="form__row">
                            <div class="field" :class="{ 'field--invalid': errors.last_name }">
                                <label class="field__label" for="pf-last">{{ $f['last_name_label'] }} *</label>
                                <input class="field__input" id="pf-last" type="text" x-model="form.last_name" autocomplete="family-name" maxlength="80" required>
                                <span class="field__error" x-show="errors.last_name" x-text="errors.last_name" x-cloak></span>
                            </div>
                            <div class="field" :class="{ 'field--invalid': errors.first_name }">
                                <label class="field__label" for="pf-first">{{ $f['first_name_label'] }} *</label>
                                <input class="field__input" id="pf-first" type="text" x-model="form.first_name" autocomplete="given-name" maxlength="80" required>
                                <span class="field__error" x-show="errors.first_name" x-text="errors.first_name" x-cloak></span>
                            </div>
                        </div>

                        <div class="form__row">
                            <div class="field">
                                <label class="field__label" for="pf-middle">{{ $f['middle_name_label'] }}</label>
                                <input class="field__input" id="pf-middle" type="text" x-model="form.middle_name" autocomplete="additional-name" maxlength="80" placeholder="{{ $f['middle_name_hint'] }}">
                            </div>
                            <div class="field" :class="{ 'field--invalid': errors.city }">
                                <label class="field__label" for="pf-city">{{ $f['city_label'] }} *</label>
                                <input class="field__input" id="pf-city" type="text" x-model="form.city" autocomplete="address-level2" maxlength="120" required>
                                <span class="field__hint">{{ $f['city_hint'] }}</span>
                                <span class="field__error" x-show="errors.city" x-text="errors.city" x-cloak></span>
                            </div>
                        </div>

                        <div class="field">
                            <label class="field__label" for="pf-org">{{ $f['org_label'] }}</label>
                            <input class="field__input" id="pf-org" type="text" x-model="form.organization" autocomplete="organization" maxlength="160">
                            <span class="field__hint">{{ $f['org_hint'] }}</span>
                        </div>

                        <div class="field" :class="{ 'field--invalid': errors.activity }">
                            <label class="field__label" for="pf-activity">{{ $f['activity_label'] }} *</label>
                            <input class="field__input" id="pf-activity" type="text" x-model="form.activity" maxlength="300" placeholder="{{ $f['activity_hint'] }}" required>
                            <span class="field__error" x-show="errors.activity" x-text="errors.activity" x-cloak></span>
                        </div>

                        <div class="form__row">
                            <div class="field" :class="{ 'field--invalid': errors.messenger }">
                                <label class="field__label" for="pf-messenger">{{ $f['messenger_label'] }} *</label>
                                <select class="field__input" id="pf-messenger" x-model="form.messenger" required>
                                    @foreach ($f['messengers'] as $key => $label)
                                        <option value="{{ $key }}">{{ $label }}</option>
                                    @endforeach
                                </select>
                                <span class="field__error" x-show="errors.messenger" x-text="errors.messenger" x-cloak></span>
                            </div>
                            <div class="field" x-show="form.messenger === 'other'" x-cloak :class="{ 'field--invalid': errors.messenger_other }">
                                <label class="field__label" for="pf-messenger-other">{{ $f['messenger_other_label'] }} *</label>
                                <input class="field__input" id="pf-messenger-other" type="text" x-model="form.messenger_other" maxlength="60">
                                <span class="field__error" x-show="errors.messenger_other" x-text="errors.messenger_other" x-cloak></span>
                            </div>
                        </div>

                        <div class="field" :class="{ 'field--invalid': errors.contact }">
                            <label class="field__label" for="pf-contact">{{ $f['contact_label'] }} *</label>
                            <input class="field__input" id="pf-contact" type="text" x-model="form.contact" autocomplete="tel" maxlength="160" required>
                            <span class="field__hint">{{ $f['contact_hint'] }}</span>
                            <span class="field__error" x-show="errors.contact" x-text="errors.contact" x-cloak></span>
                        </div>

                        <div class="field" :class="{ 'field--invalid': errors.contact_time }">
                            <label class="field__label" for="pf-time">{{ $f['time_label'] }} *</label>
                            <input class="field__input" id="pf-time" type="text" x-model="form.contact_time" maxlength="160" placeholder="{{ $f['time_placeholder'] }}" required>
                            <span class="field__hint">{{ $f['time_hint'] }}</span>
                            <span class="field__error" x-show="errors.contact_time" x-text="errors.contact_time" x-cloak></span>
                        </div>

                        {{-- Honeypot: скрытое поле-ловушка для ботов --}}
                        <div class="hp-field" aria-hidden="true">
                            <label for="pf-site">Не заполняйте это поле</label>
                            <input type="text" id="pf-site" x-model="form.company_site" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="field field--check" :class="{ 'field--invalid': errors.consent }">
                            <label class="check">
                                <input type="checkbox" x-model="form.consent">
                                <span>{{ $f['consent_before'] }}<a href="{{ url($p.'/become-partner/consent') }}" target="_blank" rel="noopener">{{ $f['consent_link'] }}</a>{{ $f['consent_after'] }}. <a href="{{ url($p.'/privacy') }}" target="_blank" rel="noopener">{{ $f['privacy_link'] }}</a></span>
                            </label>
                            <span class="field__error" x-show="errors.consent" x-text="errors.consent" x-cloak></span>
                        </div>

                        <p class="field__error" x-show="errors.form" x-text="errors.form" x-cloak role="alert"></p>

                        <button class="btn btn--primary btn--lg btn--block" type="submit" :disabled="sending">
                            <span x-show="!sending">{{ $f['submit'] }}</span>
                            <span x-show="sending" x-cloak>{{ $f['sending'] }}</span>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <x-footer-cta :title="$data['closing']['title'] ?? null" :lead="$data['closing']['text'] ?? null" />
    </main>
@endsection
