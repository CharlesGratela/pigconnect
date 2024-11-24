<script setup>
import { ref } from 'vue';

let mobileNav = ref(false);

let toggleMobileNav = () => {
    mobileNav.value = !mobileNav.value;
};
</script>

<template>
    <!-- Navbar Start -->
    <div style="background-color: #F7B5CA; padding: 25px 0;">
        <div class="container mx-auto px-5">
            <header class="flex justify-between items-center">
                <div>
                    <a href="/"><img src="/images/pigconnectlogo_s.png" alt="Site Logo" class="h-10 md:h-12 lg:h-16"></a>
                </div>
                
                <nav class="flex justify-end items-center flex-row">
                    <!-- Mobile and Desktop Menu -->
                    <ul class="flex space-x-4 md:space-x-7 font-theme-heading font-medium items-center">
                        <li class="uppercase transition duration-200">
                            <a href="/login" v-smooth-scroll class="text-white hover:text-theme-secondary text-sm md:text-lg lg:text-xl font-bold">Login</a>
                        </li>
                        <li class="uppercase transition duration-200">
                            <a href="/register" v-smooth-scroll class="text-white hover:text-theme-secondary text-sm md:text-lg lg:text-xl font-bold">Register</a>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>
    </div>
    <!-- Navbar End -->
</template>

<style scoped>
/* Add any necessary styles here */
</style>