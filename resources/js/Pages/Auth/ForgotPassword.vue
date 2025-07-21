<script setup>
import LoginLayout from '@/Layouts/LoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'), {
        onFinish: () => {
            // Keep email in form for retry if needed
            if (!form.hasErrors) {
                form.reset('email');
            }
        },
    });
};
</script>

<template>
    <LoginLayout>
        <Head title="Forgot Password" />
        <div class="sm:mx-auto sm:w-full max-w-xl">
            <div class="flex justify-center">
                <div class="bg-emerald-600 h-14 w-14 rounded-xl flex items-center justify-center shadow-md transform transition-transform hover:scale-105">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold text-gray-800">Forgot your password?</h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Remember your password?
                <Link :href="route('login')" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                    Sign in
                </Link>
            </p>

            <div class="mt-10 w-full">
                <div class="bg-white py-12 px-8 shadow-2xl rounded-2xl border border-gray-100 w-full">
                    <div class="mb-6 text-center">
                        <p class="text-sm text-gray-600">
                            No problem! Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                        </p>
                    </div>

                    <!-- Success Message -->
                    <div v-if="status" class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-emerald-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-emerald-800 font-medium">Email sent successfully!</p>
                        </div>
                        <p class="text-sm text-emerald-700 mt-1">{{ status }}</p>
                    </div>

                    <!-- Error Messages -->
                    <div v-if="form.errors.email" class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 text-red-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            <p class="text-sm text-red-800 font-medium">Unable to send reset link</p>
                        </div>
                        <p class="text-sm text-red-700 mt-1">{{ form.errors.email }}</p>
                    </div>

                    <form class="space-y-6" @submit.prevent="submit">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">
                                Email address
                            </label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                    </svg>
                                </div>
                                <input
                                    id="email"
                                    name="email"
                                    type="email"
                                    autocomplete="email"
                                    required
                                    v-model="form.email"
                                    :class="form.errors.email ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 text-gray-900 focus:ring-emerald-500 focus:border-emerald-500'"
                                    class="block w-full pl-10 pr-3 py-3 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors sm:text-sm"
                                    placeholder="Enter your email address"
                                />
                            </div>
                            <InputError :message="form.errors.email" class="mt-2" />
                        </div>

                        <div>
                            <button
                                type="submit"
                                :disabled="form.processing"
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:translate-y-[-1px] disabled:opacity-50 disabled:cursor-not-allowed"
                            >
                                <svg v-if="form.processing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                <span v-if="!form.processing">Send Password Reset Link</span>
                                <span v-else>Sending...</span>
                            </button>
                        </div>
                    </form>

                    <!-- Additional helpful links -->
                    <div class="mt-6 text-center border-t border-gray-100 pt-6">
                        <p class="text-xs text-gray-500">
                            Need help? 
                            <Link :href="route('register')" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                                Create a new account
                            </Link>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Security notice at bottom -->
            <div class="mt-8 text-center">
                <div class="inline-flex items-center px-4 py-2 bg-emerald-50 border border-emerald-200 rounded-lg">
                    <svg class="h-4 w-4 text-emerald-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="text-xs text-emerald-700 font-medium">
                        Reset links expire in 60 minutes for your security
                    </p>
                </div>
            </div>
        </div>
    </LoginLayout>
</template>