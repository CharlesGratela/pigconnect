<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#c58a61]">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <Link href="/">
                <img src="/images/favicon.png" alt="Site Logo" class="h-10" />
            </Link>
            <slot />
        </div>
    </div>
</template>