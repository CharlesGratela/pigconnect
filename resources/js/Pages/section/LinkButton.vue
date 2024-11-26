<script setup>
const props = defineProps({
    btnType: String,
    link: String,
    customClass: {
        type: String,
        default: "text-sm sm:text-md md:text-base"
    }
});
</script>

<template>
    <a v-if="btnType === 'primary'" :href="link" v-smooth-scroll :class="customClass" class="font-theme-heading font-medium bg-[#c58a61] px-6 py-2 text-white rounded shadow-md hover:bg-white border-2 border-transparent hover:border-[#c58a61] hover:text-[#c58a61] cursor-pointer transition duration-200 mr-5">
        <slot></slot>
    </a>
    <a v-if="btnType === 'muted'" :href="link" v-smooth-scroll :class="customClass" class="font-theme-heading font-medium bg-gray-100 text-gray-500 px-6 py-2 rounded shadow-md hover:bg-white border-2 border-transparent hover:border-[#3C3D37] hover:text-[#3C3D37] cursor-pointer transition duration-200">
        <slot></slot>
    </a>
</template>