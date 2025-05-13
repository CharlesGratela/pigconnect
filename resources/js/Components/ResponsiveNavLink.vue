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
        ? 'block pl-3 pr-4 py-2 border-l-4 border-[#c58a61] text-base font-medium text-[#543434] bg-[#c58a61] focus:outline-none focus:text-[#a7674d] focus:bg-[#c58a61] focus:border-[#c58a61] transition duration-150 ease-in-out'
        : 'block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-[#543434] hover:text-[#a7674d] hover:bg-[#c59461] hover:border-[#c59461] focus:outline-none focus:text-[#a7674d] focus:bg-[#c59461] focus:border-[#c59461] transition duration-150 ease-in-out'
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