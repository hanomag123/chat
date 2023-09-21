<template>
  <div class="flex flex-col gap-4 sm:px-6 lg:px-8 max-w-[32rem] w-full my-[2rem]">

    <label class="block font-medium text-sm text-gray-700 dark:text-gray-300" for="messagesInp">
      Поиск
    </label>
    <input
      class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full"
      id="messagesInp" name="messagesInp" type="text" required @input="callDebounce" v-model="message" @focus="this.focus = true" @blur = "this.focus = false">
  </div>

  <div v-if="this.messages.length > 0">
    <transition-group tag="ul" name="list" class="flex flex-col gap-4 sm:px-6 lg:px-8 max-w-[32rem] w-full my-[2rem]" appear>

      <li v-for="message of messages" :key="message.id" class="block font-medium text-sm text-gray-700 dark:text-gray-300">
        <a :href="'/dashboard/' + message.chat_id">
          <div class="message-title h4">{{ message.message }}</div>
        </a>
      </li>

    </transition-group>
  </div>
  <Transition name="fade">
    <div v-if="this.messages.length === 0 && this.focus === true" class="flex flex-col gap-4 sm:px-6 lg:px-8 max-w-[32rem] w-full my-[2rem] font-medium text-sm text-gray-700 dark:text-gray-300">
      Ничего не найдено
    </div>
  </Transition>
</template>

<script>
import axios from 'axios';
import debounce from 'lodash.debounce'

export default {
  name: "customFilter",
  data: function () {
    return {
      messages: [],
      message: '',
      focus: false,
    }
  },
  methods: {
    callDebounce: debounce(function () {
      this.deb();
    }, 500),
    deb() {
      this.filter();
    },
    async filter() {
      try {
        if (this.message.trim().length < 1) {
          this.messages = [];
          return
        }
        const data = await axios({
          method: 'get',
          url: '/api/messages',
          params: {
            message: encodeURIComponent(this.message),
          }
        })
        console.log(data)
        this.messages = data.data.messages;
      } catch (error) {
        console.log(error)
      }
    },

  },

}
</script>

<style scoped>
.message-list {
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
