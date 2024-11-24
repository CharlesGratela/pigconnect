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
                    <a href="/"><img src="/images/pigconnectlogo_s.png" alt="Site Logo" class="h-10"></a>
                </div>
                
                <nav class="flex justify-end flex-col md:flex-row">
                    <!-- Menu Toggler -->
                    <button @click="toggleMobileNav()" type="button" class="flex md:hidden focus:outline-none">
                        <svg viewBox="0 0 24 24" class="h-6 w-6 fill-current">
                            <path fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"></path>
                        </svg>
                    </button>
                    <!-- Desktop Menu -->
                    <ul class="space-x-10 font-theme-heading font-medium items-center hidden md:flex flex-col space-y-7 md:space-y-0 md:flex-row">
                        <li class="uppercase transition duration-200">
                            <a href="/login" v-smooth-scroll class="text-white hover:text-theme-secondary text-xl font-bold">Login</a>
                        </li>
                        <li class="uppercase transition duration-200">
                            <a href="/register" v-smooth-scroll class="text-white hover:text-theme-secondary text-xl font-bold">Register</a>
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