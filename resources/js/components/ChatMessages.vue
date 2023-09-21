<template>
  <transition-group tag="ul" name="list" class="message-block" appear>
    <li v-for="message in messages.slice().reverse()" :key="message.id"
      :class="{ 'user': message.user.id === user.id, 'not-user': message.user.id !== user.id }">
      <div class="message-name" v-if="message.user.id !== user.id">{{ message.user.name }}</div>
      <div class="message-message">{{ message.message }}</div>
      <div class="message-date">{{ message.created_at }}</div>
    </li>
  </transition-group>
</template>

<script>
import { onMounted } from 'vue';
import useChat from '../composables/chat';


export default {
  name: 'ChatMessages',
  props: {
    user: {
      required: true,
      type: Object,
    },
  },
  setup() {
    const { messages, getMessages } = useChat();
    const chatid = JSON.parse(document.querySelector("meta[name='chat']").getAttribute('content'));
    onMounted(() => {
      getMessages(chatid);
    })

    Echo.private(`chat`)
      .listen('MessageSend', (e) => {
        if (e.chat === chatid) {
          messages.value.push({
            message: e.message.message,
            user: e.user,
            chat: chatid,
          })
        }

      });



    return {
      messages,
    }
  },

}

</script>

<style scoped>
.message-block {
  position: relative;
}

.list-leave-to,
.list-enter-from {
  opacity: 0;
  transform: scale(0.6);
}

.list-leave-from,
.list-enter-to {
  opacity: 1;
  transform: scale(1);
}

.list-enter-active,
.list-leave-active {
  transition: all .3s;
}

.list-leave-active {
  position: absolute;
}

.list-move {
  transition: all .3s;
}

.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.5s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
