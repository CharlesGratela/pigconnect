<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 -mx-6 -mt-6 px-6 pt-6 pb-8 rounded-b-2xl shadow-lg">
                <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                    <svg class="w-8 h-8 mr-3 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Messages
                </h2>
                <p class="text-emerald-100 mt-2">Connect with farmers and buyers in your network</p>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Enhanced Chat List Container -->
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Header Section -->
                    <div class="border-b border-gray-200 bg-gradient-to-r from-gray-50 to-emerald-50 px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="bg-emerald-100 p-2 rounded-lg">
                                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a2 2 0 01-2-2v-6a2 2 0 012-2h2m-2-2v2m0 0h4v0m0 0v2m0 0h2v0" />
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Your Conversations</h3>
                                    <p class="text-sm text-gray-600">{{ users.length }} active conversations</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                                    {{ users.length }} contacts
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Chat List Items -->
                    <div class="divide-y divide-gray-100">
                        <div v-if="users.length === 0" class="text-center py-16">
                            <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-medium text-gray-800 mb-2">No conversations yet</h3>
                            <p class="text-gray-600">Start connecting with farmers and buyers to begin conversations.</p>
                        </div>

                        <div v-for="user in users" :key="user.id" 
                             @click="goToChat(user.id)" 
                             class="group relative p-6 hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition-all duration-200 cursor-pointer">
                            
                            <!-- Chat Item Content -->
                            <div class="flex items-center space-x-4">
                                <!-- User Avatar -->
                                <div class="relative">
                                    <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 h-12 w-12 rounded-xl flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-200">
                                        <span class="text-white font-semibold text-lg">
                                            {{ user.name.charAt(0).toUpperCase() }}
                                        </span>
                                    </div>
                                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 border-2 border-white rounded-full"></div>
                                </div>

                                <!-- Chat Details -->
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between mb-1">
                                        <h4 class="text-lg font-semibold text-gray-800 group-hover:text-emerald-700 transition-colors duration-200">
                                            {{ user.name }}
                                        </h4>
                                        <span v-if="user.last_message_time" class="text-sm text-gray-500 group-hover:text-emerald-600 transition-colors duration-200">
                                            {{ formatDate(user.last_message_time) }}
                                        </span>
                                    </div>
                                    
                                    <p v-if="user.last_message" class="text-gray-600 group-hover:text-gray-700 transition-colors duration-200 truncate">
                                        {{ user.last_message }}
                                    </p>
                                    <p v-else class="text-gray-400 italic">No messages yet</p>
                                </div>

                                <!-- Action Arrow -->
                                <div class="flex-shrink-0">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-emerald-600 transition-all duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>

                            <!-- Hover Effect Border -->
                            <div class="absolute left-0 top-0 h-full w-1 bg-emerald-500 transform scale-y-0 group-hover:scale-y-100 transition-transform duration-200 origin-top"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage, router } from '@inertiajs/vue3';

const { props: pageProps } = usePage();
const users = ref(pageProps.users);

const goToChat = (userId) => {
    router.visit(route('chat.index', { userId }));
};

const formatDate = (date) => {
    const now = new Date();
    const messageDate = new Date(date);
    const diffTime = Math.abs(now - messageDate);
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 1) {
        return 'Today';
    } else if (diffDays === 2) {
        return 'Yesterday';
    } else if (diffDays <= 7) {
        return `${diffDays - 1} days ago`;
    } else {
        return messageDate.toLocaleDateString();
    }
};
</script>

<style scoped>
</style>