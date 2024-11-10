<template>
    <div :class="theme">
      <div class="font-[sans-serif] min-h-screen flex flex-col items-center justify-center dark:bg-gray-900 bg-gray-100">
                <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
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