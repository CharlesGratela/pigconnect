<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-b from-emerald-50 to-emerald-100">
        <div class="w-full sm:max-w-xl px-8 py-10 bg-white shadow-2xl overflow-hidden rounded-2xl border border-gray-100">
            <div class="flex flex-col items-center mb-8">
                <Link href="/" class="mb-4">
                    <div class="bg-emerald-600 h-16 w-16 rounded-xl flex items-center justify-center shadow-md transform transition-transform hover:scale-105">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                    </div>
                </Link>
                <h1 class="text-2xl font-bold text-gray-800">PigConnect</h1>
                <p class="text-sm text-gray-500 mt-1">Connect with the pig farming community</p>
            </div>
            <slot />
            
            <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                <p class="text-sm text-gray-500">
                    {{ $page.url.startsWith('/login') ? "Don't have an account?" : 'Already have an account?' }}
                    <Link 
                        :href="$page.url.startsWith('/login') ? route('register') : route('login')" 
                        class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors"
                    >
                        {{ $page.url.startsWith('/login') ? 'Register' : 'Login' }}
                    </Link>
                </p>
            </div>
        </div>
        
        <div class="mt-8 text-center text-sm text-gray-500">
            <p>© {{ new Date().getFullYear() }} PigConnect. All rights reserved.</p>
            <div class="mt-2 space-x-4">
                <Link :href="route('terms')" class="hover:text-emerald-600 transition-colors">Terms</Link>
                <Link :href="route('privacy')" class="hover:text-emerald-600 transition-colors">Privacy</Link>
            </div>
        </div>
    </div>
</template>