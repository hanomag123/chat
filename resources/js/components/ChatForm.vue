<template>
  <form method="post" action="#" @submit.prevent="sendMessage"
    class="flex flex-col gap-4 sm:px-6 lg:px-8 w-full mt-auto">

    <div v-if="errors" class="text-red-600">
      <div v-for="(message, key) in errors.message" :key="key">
        {{ message }}
      </div>
    </div>
    <div class="main-wrapper"> 
      <input
        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
        id="message" name="message" type="text" required v-model="form.message">
      <button type="submit"
        class="main-submit inline-flex items-center px-4 py-4 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        Отправить
      </button>
    </div>
  </form>
</template>

<script>
import { reactive } from 'vue';
import useChat from '../composables/chat.js'

export default {
  name: 'ChatForm',
  setup() {
    const form = reactive({
      message: '',
      chat_id: JSON.parse(document.querySelector("meta[name='chat']").getAttribute('content'))
    })
    const { errors, addMessage } = useChat();

    const sendMessage = async () => {
      await addMessage(form)

      form.message = '';
    }

    return {
      errors,
      form,
      sendMessage,
    }
  },
}
</script>