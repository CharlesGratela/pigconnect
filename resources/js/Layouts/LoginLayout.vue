<template>
    <div :class="theme">
      <div class="font-[sans-serif] min-h-screen flex flex-col items-center justify-center dark:bg-gray-900 bg-gray-100">
        <div class="grid md:grid-cols-2 items-center gap-4 max-md:gap-8 max-w-6xl max-md:max-w-lg w-full p-4 m-4 shadow-[0_2px_10px_-3px_rgba(6,81,237,0.3)] rounded-md dark:bg-gray-800 bg-white">
          <div class="md:max-w-md w-full px-4 py-4">
            <slot />
          </div>
         
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref, onMounted, defineProps } from 'vue';
  
  const props = defineProps({
    theme: String,
    toggleTheme: Function,
  });
  
  onMounted(() => {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      props.theme.value = 'dark';
      document.documentElement.classList.add('dark');
    }
  });
  </script>
  
  <style>
  /* Add any necessary styles here */
  </style>