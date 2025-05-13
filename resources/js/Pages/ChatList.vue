<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Chat List</h2>
      </template>
  
      <div class="chat-list-container">
        <div v-for="user in users" :key="user.id" class="chat-list-item" @click="goToChat(user.id)">
          <p>{{ user.name }}</p>
          <p v-if="user.last_message">{{ user.last_message }}</p>
          <p v-if="user.last_message_time">{{ formatDate(user.last_message_time) }}</p>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import { usePage, router } from '@inertiajs/vue3';
  
  const { props: pageProps } = usePage();
  const users = ref(pageProps.users);
  
  const goToChat = (userId) => {
    router.visit(route('chat.index', { userId }));
  };
  
  const formatDate = (date) => {
    return new Date(date).toLocaleString();
  };
  </script>
  
  <style scoped>
  .chat-list-container {
    padding: 20px;
    background-color: #f0f4f8; /* Light background color */
  }
  
  .chat-list-item {
    padding: 10px;
    margin: 5px 0;
    border-radius: 8px;
    background-color: #ffffff; /* White background for list items */
    cursor: pointer;
    transition: background-color 0.3s;
  }
  
  .chat-list-item:hover {
    background-color: #e0e4e8; /* Light hover background color */
  }
  </style>