<script setup>
import WelcomeHeader from '@/Pages/section/WelcomeHeader.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <WelcomeHeader></WelcomeHeader>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">

      
    

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
            <Link href="/">
                <img src="/images/pigconnectlogo_s.png" alt="Site Logo" class="h-10" />
            </Link>
            <slot />
        </div>
    </div>
</template>
