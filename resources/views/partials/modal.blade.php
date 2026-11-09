<div class="modal" x-data="leadModal" x-show="$store.ui.modalOpen" x-cloak style="display: none;"
    x-effect="if (!$store.ui.modalOpen) reset()" x-transition.opacity.duration.250ms>
    <div class="modal__backdrop" @click="$store.ui.closeModal()"></div>

    <div class="modal__panel">
        <button class="modal__close" type="button" @click="$store.ui.closeModal()" aria-label="{{ __('genla.form.close') }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" aria-hidden="true">
                <path d="M18 6 6 18M6 6l12 12" />
            </svg>
        </button>

        <div class="modal__scroll">
        {{-- Форма --}}
        <div x-show="!sent">
            <span class="eyebrow modal__eyebrow">{{ __('genla.form.eyebrow') }}</span>
            <h2 class="modal__title" x-text="$store.ui.modalTitle"></h2>
            <p class="modal__lead" x-text="$store.ui.modalLead"></p>

            <form class="form" @submit.prevent="submit()" novalidate>
                <div class="field" :class="{ 'field--invalid': errors.name }">
                    <label class="field__label" for="lead-name">{{ __('genla.form.name_label') }}</label>
                    <input class="field__input" id="lead-name" type="text" x-model="form.name"
                        placeholder="{{ __('genla.form.name_placeholder') }}" autocomplete="name">
                    <span class="field__error" x-show="errors.name" x-text="errors.name" x-cloak></span>
                </div>

                <div class="field" :class="{ 'field--invalid': errors.contact }">
                    <label class="field__label" for="lead-contact">{{ __('genla.form.contact_label') }}</label>
                    <input class="field__input" id="lead-contact" type="text" x-model="form.contact"
                        placeholder="{{ __('genla.form.contact_placeholder') }}" autocomplete="tel">
                    <span class="field__error" x-show="errors.contact" x-text="errors.contact" x-cloak></span>
                </div>

                <div class="field" :class="{ 'field--invalid': errors.email }">
                    <label class="field__label" for="lead-email">{{ __('genla.form.email_label') }} <span
                            style="color: var(--c-muted-2); font-weight: 400;">{{ __('genla.form.email_optional') }}</span></label>
                    <input class="field__input" id="lead-email" type="email" x-model="form.email"
                        placeholder="{{ __('genla.form.email_placeholder') }}" autocomplete="email">
                    <span class="field__error" x-show="errors.email" x-text="errors.email" x-cloak></span>
                </div>

                {{-- Honeypot: скрытое поле-ловушка для ботов (люди его не видят) --}}
                <div class="hp-field" aria-hidden="true">
                    <label for="company_site">Не заполняйте это поле</label>
                    <input type="text" id="company_site" name="company_site" x-model="form.company_site"
                        tabindex="-1" autocomplete="off">
                </div>

                <div class="field">
                    <label class="field__label" for="lead-message">{{ __('genla.form.message_label') }} <span
                            style="color: var(--c-muted-2); font-weight: 400;">{{ __('genla.form.message_optional') }}</span></label>
                    <textarea class="field__textarea" id="lead-message" x-model="form.message"
                        placeholder="{{ __('genla.form.message_placeholder') }}"></textarea>
                </div>

                <button class="btn btn--primary btn--lg btn--block" type="submit" :disabled="sending">
                    <span x-show="!sending">{{ __('genla.form.submit') }}</span>
                    <span x-show="sending" x-cloak>{{ __('genla.form.submitting') }}</span>
                </button>

                <p class="form__note">
                    {{ __('genla.form.note') }}
                    <a href="{{ url(\App\Support\Genla::prefix().'/privacy') }}" target="_blank" rel="noopener">{{ __('genla.ui.privacy') }}</a>.
                </p>
            </form>
        </div>

        {{-- Принято --}}
        <div class="form-success" x-show="sent" x-cloak>
            <div class="form-success__icon">
                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M20 6 9 17l-5-5" />
                </svg>
            </div>
            <h3 class="form-success__title">{{ __('genla.form.success_title') }}</h3>
            <p class="form-success__text">{{ __('genla.form.success_text') }}</p>
            <button class="btn btn--ghost btn--lg" type="button" @click="$store.ui.closeModal()"
                style="margin-top: 1.5rem;">{{ __('genla.form.done') }}</button>
        </div>
        </div>
    </div>
</div>
