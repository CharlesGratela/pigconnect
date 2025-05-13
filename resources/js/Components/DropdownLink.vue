<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    href: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="block w-full px-4 py-2 text-start text-sm leading-5 text-[#543434] hover:bg-[#c58a61] focus:outline-none focus:bg-[#c58a61] transition duration-150 ease-in-out"
    >
        <slot />
    </Link>
</template>