<script setup>
import { computed } from 'vue';
import LoginLayout from '@/Layouts/LoginLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    status: {
        type: String,
    },
    success: {
        type: String,
    },
    message: {
        type: String,
    },
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.resend'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <LoginLayout>
        <Head title="Verify Your Email - PigConnect" />
        
        <div class="sm:mx-auto sm:w-full max-w-xl">
            <div class="flex justify-center">
                <div class="bg-yellow-500 h-14 w-14 rounded-xl flex items-center justify-center shadow-md transform transition-transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-800">Check Your Email! 📧</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                We've sent you a verification link to get started with PigConnect
            </p>

            <div class="mt-10 w-full">
                <div class="bg-white py-12 px-8 shadow-2xl rounded-2xl border border-gray-100 w-full">
                    
                    <!-- Success Messages -->
                    <div v-if="success" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-emerald-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-emerald-800 font-medium">Welcome to PigConnect!</p>
                        </div>
                        <p class="text-sm text-emerald-700 mt-1">{{ success }}</p>
                    </div>

                    <div v-if="verificationLinkSent" class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-green-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-green-800 font-medium">Email sent successfully!</p>
                        </div>
                        <p class="text-sm text-green-700 mt-1">
                            A fresh verification link has been sent to your email address.
                        </p>
                    </div>

                    <div v-if="message" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-blue-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-blue-800 font-medium">Information</p>
                        </div>
                        <p class="text-sm text-blue-700 mt-1">{{ message }}</p>
                    </div>

                    <!-- Main Content -->
                    <div class="text-center mb-8">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-emerald-100 rounded-full mb-4">
                            <span class="text-2xl">🐷</span>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Welcome to PigConnect!</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Thanks for joining our farming community! Before you can start managing your pig farm and connecting with buyers, we need to verify your email address.
                        </p>
                    </div>

                    <!-- Email Verification Steps -->
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="font-medium text-gray-800 mb-4 flex items-center">
                            <svg class="h-5 w-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Quick verification steps:
                        </h4>
                        <ol class="space-y-2 text-sm text-gray-600">
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-5 h-5 bg-emerald-600 text-white text-xs rounded-full mr-3 mt-0.5">1</span>
                                Check your email inbox (and spam folder)
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-5 h-5 bg-emerald-600 text-white text-xs rounded-full mr-3 mt-0.5">2</span>
                                Click the "Verify My Email Address" button
                            </li>
                            <li class="flex items-start">
                                <span class="inline-flex items-center justify-center w-5 h-5 bg-emerald-600 text-white text-xs rounded-full mr-3 mt-0.5">3</span>
                                Start managing your pig farm!
                            </li>
                        </ol>
                    </div>

                    <!-- Features Preview -->
                    <div class="grid grid-cols-2 gap-4 mb-8">
                        <div class="text-center p-4 bg-gradient-to-br from-emerald-50 to-green-50 rounded-lg">
                            <div class="text-2xl mb-2">📊</div>
                            <p class="text-xs text-gray-600">Farm Analytics</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg">
                            <div class="text-2xl mb-2">🌱</div>
                            <p class="text-xs text-gray-600">Feed Management</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-yellow-50 to-orange-50 rounded-lg">
                            <div class="text-2xl mb-2">💰</div>
                            <p class="text-xs text-gray-600">Market Connect</p>
                        </div>
                        <div class="text-center p-4 bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg">
                            <div class="text-2xl mb-2">🏥</div>
                            <p class="text-xs text-gray-600">Health Tracking</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <form @submit.prevent="submit" class="space-y-4">
                        <button 
                            type="submit"
                            :disabled="form.processing"
                            :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
                            class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg font-medium hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            <span v-if="form.processing" class="flex items-center justify-center">
                                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Sending...
                            </span>
                            <span v-else class="flex items-center justify-center">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Resend Verification Email
                            </span>
                        </button>

                        <div class="flex justify-center">
                            <Link
                                :href="route('logout')"
                                method="post"
                                as="button"
                                class="text-sm text-gray-500 hover:text-gray-700 underline focus:outline-none focus:ring-2 focus:ring-emerald-500 rounded-md"
                            >
                                Not your account? Log out
                            </Link>
                        </div>
                    </form>

                    <!-- Help Text -->
                    <div class="mt-8 pt-6 border-t border-gray-200 text-center">
                        <p class="text-xs text-gray-500">
                            Still having trouble? Contact our support team at 
                            <a href="mailto:support@pigconnect.com" class="text-emerald-600 hover:text-emerald-700">support@pigconnect.com</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </LoginLayout>
</template>