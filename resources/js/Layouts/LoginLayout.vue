<template>
  <div class="font-[sans-serif] min-h-screen flex flex-col items-center justify-center bg-gray-100">
    <slot />
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