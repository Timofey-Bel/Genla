<div class="chat-overlay" x-show="$store.ui.chatOpen" x-cloak style="display: none;"
    x-transition.opacity.duration.250ms>
    <div class="chat-overlay__backdrop" @click="$store.ui.closeChat()"></div>
    <x-chat :embedded="false" />
</div>
