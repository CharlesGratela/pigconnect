<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
});

const classes = computed(() =>
    props.active
        ? 'inline-flex items-center px-1 pt-1 border-b-2 border-[#c58a61] text-sm font-medium leading-5 text-[#543434] focus:outline-none focus:border-[#c58a61] transition duration-150 ease-in-out'
        : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-[#543434] hover:text-[#a7674d] hover:border-[#c59461] focus:outline-none focus:text-[#a7674d] focus:border-[#c59461] transition duration-150 ease-in-out'
);

const handleClick = () => {
    window.location.href = props.href;
};
</script>

<template>
    <Link :href="href" :class="classes" @click="handleClick">
        <slot />
    </Link>
</template>