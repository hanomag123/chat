import axios from "axios";
import { ref } from "vue";

export default function useChat() {
  const messages = ref([]);
  const errors = ref([]);

  const getMessages = async (chatid) => {
    const response = await axios.get('/messages', { params: { chat: chatid } })
    messages.value = response.data
  }

  const addMessage = async (form) => {
    errors.value = [];
    try {
      const response = await axios.post('/send', form)
      messages.value.push(response.data)
    } catch (error) {
      if (error.response.status === 422) {
        errors.value = error.response.data.errors
      }
    }
  }

  return {
    messages,
    errors,
    getMessages,
    addMessage,
  }
}