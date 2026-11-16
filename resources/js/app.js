import Alpine from 'alpinejs';
import { initNeuralField } from './neural-field.js';
import { initFluidCursor } from './fluid-cursor.js';
import { initReveal } from './reveal.js';

/* ── вспомогательное ──────────────────────────────────────── */
const csrf = () =>
    document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

/* Безопасное экранирование HTML (для пользовательских сообщений). */
const escapeHtml = (str) => {
    const div = document.createElement('div');
    div.textContent = str == null ? '' : String(str);
    return div.innerHTML;
};

/**
 * Markdown → безопасный HTML.
 * Сначала экранируем весь текст, затем разворачиваем разметку:
 * **жирный**, *курсив*, `код`, заголовки, списки, цитаты, ссылки.
 * Перенос строк превращаем в <br> до обработки markdown.
 */
const formatMarkdown = (text) => {
    if (!text) return '';

    let formatted = escapeHtml(text);

    // Переносы строк → <br> (до markdown).
    formatted = formatted.replace(/\n/g, '<br>');

    // Жирный: **текст** или __текст__
    formatted = formatted.replace(/\*\*([^*]+?)\*\*/g, '<strong>$1</strong>');
    formatted = formatted.replace(/__([^_]+?)__/g, '<strong>$1</strong>');

    // Курсив: *текст* или _текст_ (не часть ** или __)
    formatted = formatted.replace(/(?<!\*)\*(?!\*)([^*<]+?)(?<!\*)\*(?!\*)/g, '<em>$1</em>');
    formatted = formatted.replace(/(?<!_)_(?!_)([^_<]+?)(?<!_)_(?!_)/g, '<em>$1</em>');

    // Зачёркнутый: ~~текст~~
    formatted = formatted.replace(/~~([^~]+?)~~/g, '<del>$1</del>');

    // Inline-код: `код`
    formatted = formatted.replace(/`([^`]+)`/g, '<code>$1</code>');

    // Заголовки (после <br> или в начале)
    formatted = formatted.replace(/(^|<br>)### (.+?)(<br>|$)/g, '$1<h3>$2</h3>$3');
    formatted = formatted.replace(/(^|<br>)## (.+?)(<br>|$)/g, '$1<h2>$2</h2>$3');
    formatted = formatted.replace(/(^|<br>)# (.+?)(<br>|$)/g, '$1<h1>$2</h1>$3');

    // Списки: строки, начинающиеся с * или -
    formatted = formatted.replace(/(^|<br>)\* (.+?)(<br>|$)/g, '$1<li>$2</li>$3');
    formatted = formatted.replace(/(^|<br>)- (.+?)(<br>|$)/g, '$1<li>$2</li>$3');
    // Соседние <li> оборачиваем в <ul> (между пунктами может быть <br>)
    formatted = formatted.replace(/(<li>.*?<\/li>)(?:(?:<br>|\s)*<li>.*?<\/li>)*/g, (m) => '<ul>' + m.replace(/<br>/g, '') + '</ul>');

    // Цитаты: > в начале строки
    formatted = formatted.replace(/(^|<br>)>\s*(.+?)(<br>|$)/g, '$1<blockquote>$2</blockquote>$3');

    // Схлопываем лишние <br> и убираем по краям
    formatted = formatted.replace(/(<br>){2,}/g, '<br>');
    formatted = formatted.replace(/^<br>|<br>$/g, '');

    // Markdown-ссылки: [текст](url)
    formatted = formatted.replace(
        /\[([^\]]+)\]\((https?:\/\/[^)]+)\)/g,
        (match, label, url) => `<a href="${url}" target="_blank" rel="noopener noreferrer">${label}</a>`,
    );

    // Голые URL → ссылки (вне уже готовых <a>)
    formatted = formatted.replace(
        /(?<!href="|<a [^>]*)(https?:\/\/[^\s<"()[\]]+)(?![^<]*<\/a>)/g,
        (url) => `<a href="${url}" target="_blank" rel="noopener noreferrer">${url}</a>`,
    );

    return formatted;
};

/* ── переводы и локаль (из base.blade → window.__genla) ────── */
const I18N = window.__genla || {};
const PREFIX = I18N.prefix || '';
const T = {
    chat: I18N.chat || {},
    modalTitles: I18N.modalTitles || {},
    modalLeads: I18N.modalLeads || {},
    actionLabels: I18N.actionLabels || {},
    errors: I18N.errors || {},
};

/** URL с учётом языкового префикса (/en/…). */
const localeUrl = (path) => PREFIX + path;

async function postJson(url, payload) {
    const res = await fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            Accept: 'application/json',
            'X-CSRF-TOKEN': csrf(),
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify(payload),
    });
    return res;
}

/* ── глобальное состояние интерфейса ──────────────────────── */
Alpine.store('ui', {
    modalOpen: false,
    chatOpen: false,
    navOpen: false,
    action: 'consultation',
    lab: null,
    labName: null,

    openModal(action = 'consultation', lab = null, labName = null) {
        this.action = action;
        this.lab = lab;
        this.labName = labName;
        this.modalOpen = true;
        this.navOpen = false;
        this.lock();
    },
    closeModal() {
        this.modalOpen = false;
        this.unlock();
    },
    openChat() {
        this.chatOpen = true;
        this.navOpen = false;
        this.lock();
    },
    closeChat() {
        this.chatOpen = false;
        this.unlock();
    },
    openNav() {
        this.navOpen = true;
        this.lock();
    },
    closeNav() {
        this.navOpen = false;
        this.unlock();
    },
    lock() {
        document.body.style.overflow = 'hidden';
    },
    unlock() {
        if (!this.modalOpen && !this.chatOpen && !this.navOpen) document.body.style.overflow = '';
    },

    get modalTitle() {
        return T.modalTitles[this.action] || T.modalTitles.default || 'Оставить заявку';
    },
    get modalLead() {
        return T.modalLeads[this.action] || T.modalLeads.default || 'Оставьте контакты — свяжемся с вами.';
    },
});

/* ── форма-заявка ─────────────────────────────────────────── */
Alpine.data('leadModal', () => ({
    sending: false,
    sent: false,
    errors: {},
    form: { name: '', contact: '', email: '', message: '', company_site: '' },

    reset() {
        this.sending = false;
        this.sent = false;
        this.errors = {};
        this.form = { name: '', contact: '', email: '', message: '', company_site: '' };
    },

    async submit() {
        this.errors = {};
        if (!this.form.name.trim()) this.errors.name = T.errors.name || 'Укажите имя';
        if (!this.form.contact.trim()) this.errors.contact = T.errors.contact || 'Укажите телефон или email';
        if (Object.keys(this.errors).length) return;

        this.sending = true;
        try {
            const res = await postJson(localeUrl('/leads'), {
                ...this.form,
                action: this.$store.ui.action,
                lab: this.$store.ui.lab,
                source: (window.location.pathname + window.location.search).slice(0, 255),
            });
            if (res.status === 422) {
                const data = await res.json();
                const flat = {};
                Object.keys(data.errors || {}).forEach((k) => (flat[k] = data.errors[k][0]));
                this.errors = flat;
                return;
            }
            if (!res.ok) throw new Error('request failed');
            this.sent = true;
        } catch (e) {
            this.errors.contact = T.errors.send_failed || 'Не удалось отправить. Попробуйте позже.';
        } finally {
            this.sending = false;
        }
    },
}));

/* ── заявка «Стать партнёром» (одна форма для четырёх ролей) ── */
Alpine.data('partnerForm', (token = '') => ({
    sending: false,
    sent: false,
    errors: {},
    t: I18N.partner || {},
    form: {
        role: 'specialist',
        last_name: '',
        first_name: '',
        middle_name: '',
        city: '',
        organization: '',
        activity: '',
        messenger: 'telegram',
        messenger_other: '',
        contact: '',
        contact_time: '',
        consent: false,
        company_site: '',
    },

    init() {
        // Выбор карточки роли подставляет роль; введённые данные сохраняются.
        window.addEventListener('partner-role', (e) => {
            if (e.detail) this.form.role = e.detail;
        });
    },

    validate() {
        const req = this.t.required || 'Заполните это поле';
        const errors = {};
        ['last_name', 'first_name', 'city', 'activity', 'contact', 'contact_time'].forEach((k) => {
            if (!String(this.form[k] || '').trim()) errors[k] = req;
        });
        if (this.form.messenger === 'other' && !this.form.messenger_other.trim()) errors.messenger_other = req;
        if (!this.form.consent) errors.consent = this.t.consent_required || req;
        return errors;
    },

    async submit() {
        if (this.sending) return;
        this.errors = this.validate();
        if (Object.keys(this.errors).length) return;

        this.sending = true;
        try {
            const res = await postJson(localeUrl('/become-partner/apply'), {
                ...this.form,
                form_token: token,
                source: (window.location.pathname + window.location.search).slice(0, 255),
            });
            if (res.status === 422) {
                const data = await res.json();
                const flat = {};
                Object.keys(data.errors || {}).forEach((k) => (flat[k] = data.errors[k][0]));
                this.errors = flat;
                return;
            }
            const data = await res.json().catch(() => ({}));
            if (!res.ok || !data.ok) throw new Error('request failed');
            this.sent = true;
        } catch (e) {
            this.errors = { form: this.t.error || 'Не удалось отправить заявку. Ваши данные остались в форме. Попробуйте ещё раз.' };
        } finally {
            this.sending = false;
        }
    },
}));

/* ── диалог Genla ──────────────────────────────────────────── */
Alpine.data('genlaChat', () => ({
    messages: [],
    input: '',
    sending: false,
    suggestions: [],
    parentId: null,
    t: T.chat,

    init() {
        this.messages.push({
            role: 'ai',
            text: T.chat.greeting || 'Здравствуйте. Я Genla — интеллектуальное ядро экосистемы.',
        });
        this.suggestions = Array.isArray(T.chat.suggestions) ? T.chat.suggestions : [];
    },

    scrollDown() {
        this.$nextTick(() => {
            const box = this.$refs.messages;
            if (box) box.scrollTop = box.scrollHeight;
        });
    },

    /* Готовый HTML сообщения: ответы ассистента форматируем markdown'ом,
       пользовательский ввод просто экранируем. */
    renderMessage(m) {
        return m.role === 'user' ? escapeHtml(m.text) : formatMarkdown(m.text);
    },

    pick(text) {
        this.input = text;
        this.send();
    },

    history() {
        return this.messages
            .map((m) => ({ role: m.role === 'user' ? 'user' : 'assistant', content: m.text }))
            .slice(-10);
    },

    async send() {
        const text = this.input.trim();
        if (!text || this.sending) return;

        this.messages.push({ role: 'user', text });
        this.input = '';
        this.suggestions = [];
        this.sending = true;
        this.scrollDown();

        try {
            const res = await postJson(localeUrl('/ai/chat'), {
                message: text,
                history: this.history(),
                parent_message_id: this.parentId,
            });
            const data = await res.json();
            if (data.parent_id) this.parentId = data.parent_id;
            this.messages.push({
                role: 'ai',
                text: data.reply || T.chat.fallback || 'Готов помочь.',
                action: data.action || null,
                lab: data.lab || null,
                labName: data.lab_name || null,
                labUrl: data.lab_url || null,
            });
            // Обновляем chips только если агент вернул непустой список,
            // иначе оставляем начальные suggestions из window.__genla
            if (Array.isArray(data.suggestions) && data.suggestions.length > 0) {
                this.suggestions = data.suggestions;
            }
        } catch (e) {
            this.messages.push({ role: 'ai', text: T.chat.error || 'Связь на секунду прервалась. Повторите, пожалуйста.' });
        } finally {
            this.sending = false;
            this.scrollDown();
        }
    },

    openModalFor(action) {
        this.$store.ui.openModal(action, this.$store.ui.lab, this.$store.ui.labName);
    },

    labelFor(action) {
        return T.actionLabels[action] || T.actionLabels.default || 'Оставить заявку';
    },
}));

/* ── запуск ───────────────────────────────────────────────── */
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    // нейрополе (если присутствует canvas)
    const field = document.getElementById('neural-field');
    if (field) initNeuralField(field);

    // интерактивная жидкость за курсором
    const fluid = document.getElementById('fluid-cursor');
    if (fluid) initFluidCursor(fluid);

    // появление блоков
    initReveal();

    // состояние шапки при скролле
    const header = document.querySelector('.site-header');
    if (header) {
        const onScroll = () => header.classList.toggle('is-scrolled', window.scrollY > 10);
        onScroll();
        window.addEventListener('scroll', onScroll, { passive: true });
    }
});

// Esc закрывает оверлеи
window.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        Alpine.store('ui').closeModal();
        Alpine.store('ui').closeChat();
        Alpine.store('ui').closeNav();
    }
});
