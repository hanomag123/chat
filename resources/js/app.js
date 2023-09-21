import './bootstrap';

import { createApp } from 'vue';
import Chat from './components/Chat.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatMessages.vue';

import customFilter from './components/customFilter.vue';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

if (document.getElementById('chat')) {
  const app = createApp(Chat);
  app.component('ChatMessages', ChatMessages);
  app.component('ChatForm', ChatForm);
  app.mount('#chat');
}


if (document.getElementById('vueFilter')) {
  const filter = createApp(customFilter)
  filter.mount('#vueFilter')
}

