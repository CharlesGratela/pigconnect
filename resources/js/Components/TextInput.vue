<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="border-[#c59461] bg-white text-[#543434] focus:border-[#c58a61] focus:ring-[#c58a61] rounded-md shadow-sm"
        v-model="model"
        ref="input"
    />
</template>