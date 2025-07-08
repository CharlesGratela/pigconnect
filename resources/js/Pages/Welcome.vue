<script setup>

import WelcomeHeader from './section/WelcomeHeader.vue';
import WelcomeHero from './section/WelcomeHero.vue';
import WelcomeFooter from './section/WelcomeFooter.vue';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById('screenshot-container')?.classList.add('!hidden');
    document.getElementById('docs-card')?.classList.add('!row-span-1');
    document.getElementById('docs-card-content')?.classList.add('!flex-row');
    document.getElementById('background')?.classList.add('!hidden');
}
</script>

<template>
  <WelcomeHeader/>

  <WelcomeHero/>

  <WelcomeFooter/>
</template>

<style scoped></style>

<script>
export default {};
</script>

