<template>
  <div class="font-[sans-serif] min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <div class="md:max-w-md w-full px-4 py-4">
        <a href="/">
          <img src="/images/favicon.png" alt="Site Logo" class="h-10" />
        </a>
        <slot />
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';

onMounted(() => {
  // Any necessary setup can be done here
});
</script>

<style>
/* Add any necessary styles here */
</style>