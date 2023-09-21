<template>
  <ChatMessages :user="user"/>

  <ChatForm/>
</template>

<script>
import ChatForm from './ChatForm.vue';
import ChatMessages from './ChatMessages.vue';

export default {
  name: 'Chat',
  components: {
    ChatForm,
    ChatMessages,
  },
  data() {
    return {
      user: JSON.parse(document.querySelector("meta[name='user']").getAttribute('content')),
    }
  },
}
</script>