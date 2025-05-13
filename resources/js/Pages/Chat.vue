<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-dark leading-tight">Chat with {{ senderName }}</h2>
    </template>

    <div class="chat-container bg-highlight">
      <div class="chat-messages bg-white">
        <div v-for="message in messages" :key="message.id" class="chat-message">
          <div :class="{'chat-message-sent bg-primary text-secondary': message.sender_id === loggedInUserId, 'chat-message-received bg-accent text-dark': message.sender_id !== loggedInUserId}">
            <p>{{ message.message }}</p>
            <p class="timestamp">{{ formatDate(message.created_at) }}</p>
          </div>
        </div>
      </div>
      <div class="chat-input bg-highlight">
        <input v-model="newMessage" @keyup.enter="sendMessage" placeholder="Type a message..." class="bg-white border border-gray-300 rounded-lg p-2" />
        <button @click="sendMessage" class="bg-secondary text-white p-2.5 rounded-lg">Send</button>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';
import axios from 'axios';

const { props: pageProps } = usePage();
const loggedInUserId = ref(pageProps.auth.user.id);
const newMessage = ref('');
const messages = ref(pageProps.messages);
const userId = ref(pageProps.userId);
const senderName = ref(pageProps.senderName);

const fetchMessages = async () => {
  try {
    const response = await axios.get(`/api/chat/messages/${userId.value}`);
    messages.value = response.data;
  } catch (error) {
    console.error('Error fetching messages:', error);
  }
};

const sendMessage = async () => {
  if (newMessage.value.trim() === '') return;

  try {
    const response = await axios.post('/api/chat/', {
      receiver_id: userId.value,
      message: newMessage.value,
    });
    messages.value.push(response.data);
    newMessage.value = '';
  } catch (error) {
    console.error('Error sending message:', error);
  }
};

const formatDate = (date) => {
  return new Date(date).toLocaleString();
};

onMounted(() => {
  const interval = setInterval(fetchMessages, 3000); // Refresh messages every 3 seconds
  onUnmounted(() => clearInterval(interval));
});
</script>

<style scoped>
.chat-container {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.chat-messages {
  flex: 1;
  overflow-y: auto;
  padding: 10px;
}

.chat-message {
  padding: 10px;
  margin: 5px 0;
  border-radius: 8px;
}

.chat-message-sent {
  text-align: right;
}

.chat-message-received {
  text-align: left;
}

.timestamp {
  font-size: 0.8em;
  color: #281C11;
}

.chat-input {
  display: flex;
  padding: 10px;
}

.chat-input input {
  flex: 1;
  padding: 10px;
}

.chat-input button {
  margin-left: 10px;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
}
</style>