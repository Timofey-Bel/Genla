@props(['embedded' => false])

<div class="chat {{ $embedded ? 'chat--embedded' : '' }}" x-data="genlaChat">
    <div class="chat__header">
        <span class="chat__orb" aria-hidden="true"></span>
        <span class="chat__id">
            <span class="chat__name">Genla</span>
            <span class="chat__status">{{ __('genla.chat.status') }}</span>
        </span>
        @unless ($embedded)
            <button class="chat__close" type="button" @click="$store.ui.closeChat()" aria-label="{{ __('genla.chat.close') }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" aria-hidden="true">
                    <path d="M18 6 6 18M6 6l12 12" />
                </svg>
            </button>
        @endunless
    </div>

    <div class="chat__messages" x-ref="messages">
        <template x-for="(m, i) in messages" :key="i">
            <div>
                <div class="msg" :class="m.role === 'user' ? 'msg--user' : 'msg--ai'" x-html="renderMessage(m)"></div>
                <template x-if="m.role === 'ai' && (m.action || m.lab)">
                    <div class="cta-group" style="margin-top: 0.6rem;">
                        <template x-if="m.lab">
                            <a class="chip" :href="m.labUrl">
                                <span x-text="t.openLab + ' ' + m.labName"></span> →
                            </a>
                        </template>
                        <template x-if="m.action">
                            <button class="chip" type="button"
                                @click="$store.ui.openModal(m.action, m.lab, m.labName)"
                                x-text="labelFor(m.action)"></button>
                        </template>
                    </div>
                </template>
            </div>
        </template>

        <template x-if="sending">
            <div class="typing"><span></span><span></span><span></span></div>
        </template>
    </div>

    <div class="chat__suggestions" x-show="suggestions.length" x-cloak>
        <template x-for="s in suggestions" :key="s">
            <button class="chip" type="button" @click="pick(s)" x-text="s"></button>
        </template>
    </div>

    <form class="chat__form" @submit.prevent="send()">
        <textarea class="chat__input" x-model="input" rows="1" placeholder="{{ __('genla.chat.input_placeholder') }}"
            @keydown.enter="if (!$event.shiftKey) { $event.preventDefault(); send() }"></textarea>
        <button class="chat__send" type="submit" :disabled="!input.trim() || sending" aria-label="{{ __('genla.chat.send') }}">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M22 2 11 13M22 2l-7 20-4-9-9-4 20-7z" />
            </svg>
        </button>
    </form>
</div>
