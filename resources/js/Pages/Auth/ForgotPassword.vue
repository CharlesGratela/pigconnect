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
    form.post(route('password.email'));
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

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 bg-green-50 border border-green-200 rounded-lg p-3">
                        {{ status }}
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

            <!-- Farm illustration at bottom -->
            <div class="fixed bottom-0 left-0 w-full h-32 pointer-events-none overflow-hidden opacity-80">
                <div class="absolute bottom-0 left-0 w-full h-16 bg-emerald-800 opacity-5 rounded-t-full transform scale-150"></div>
                <div class="absolute bottom-0 left-1/4 w-8 h-16 bg-emerald-700 opacity-10 rounded-t-full"></div>
                <div class="absolute bottom-0 left-1/3 w-12 h-24 bg-emerald-600 opacity-10 rounded-t-full"></div>
                <div class="absolute bottom-0 left-1/2 w-10 h-20 bg-emerald-500 opacity-10 rounded-t-full"></div>
                <div class="absolute bottom-0 left-2/3 w-14 h-28 bg-emerald-600 opacity-10 rounded-t-full"></div>
                <div class="absolute bottom-0 left-3/4 w-8 h-16 bg-emerald-700 opacity-10 rounded-t-full"></div>
            </div>
        </div>
    </LoginLayout>
</template>