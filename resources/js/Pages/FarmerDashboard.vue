<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const showingSidebar = ref(false);

function toggleSidebar() {
  showingSidebar.value = !showingSidebar.value;
}
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>'    
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Farmer Dashboard</h2>
    </template>

    <div class="flex">
      <!-- Sidebar -->
   

      <!-- Main Content -->
      <main class="flex-grow p-4">
       

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template>
