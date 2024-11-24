<script setup></script>

<template>
    <!-- Hero Section Start -->
    <div class="container mx-auto px-5 overflow-x-hidden lg:overflow-x-visible">
        <section class="grid grid-cols-none lg:grid-cols-2 pb-16 pt-8 items-center">
            <div class="lg:w-5/6 order-2 lg:order-none">
                <h1 class="text-4xl xl:text-5xl font-bold font-theme-heading text-center lg:text-left">
                    <span class="text-[#AE445A]">PigConnect:</span> <span class="text-[#E8BCB9]">Intelligent Pig Farming Management System</span>
                </h1>
                <p class="lg:text-xl mt-10 font-theme-content text-theme-grayish-blue text-justify">
                    Pigconnect is a comprehensive web app designed for pig farmers, enabling seamless tracking of herd health, growth, and productivity. Optimize your operations and stay connected to your flock with ease.   
                </p>
                <div class="flex justify-center lg:justify-start mt-10 space-x-4">
                    <LinkButton btn-type="primary" link="#download-section">Get It On Chrome</LinkButton>
                    <LinkButton btn-type="muted" link="#download-section">Get It On Firefox</LinkButton>
                </div>
            </div>
            <div class="relative order-1 lg:order-none mb-20 lg:mt-0 lg:mb-0 lg:-mr-10">
                <img class="z-10 w-full" src="/images/farmerhero.png" />
                <div class="-z-10 bg-theme-primary h-52 w-full sm:h-80 sm:w-full rounded-l-full absolute -right-28 md:-right-48 -bottom-8"></div>
            </div>
        </section>
    </div>  
    <!-- Hero Section End -->
</template>

<style scoped>
.text-justify {
    text-align: justify;
}
</style>