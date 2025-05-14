<template>
  <LoginLayout>
    <Head title="Log in" />
    <div class="sm:mx-auto sm:w-full max-w-xl">
      <div class="flex justify-center">
        <div class="bg-emerald-600 h-14 w-14 rounded-xl flex items-center justify-center shadow-md transform transition-transform hover:scale-105">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
          </svg>
        </div>
      </div>
      <h2 class="mt-6 text-center text-3xl font-bold text-gray-800">Welcome back</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Don't have an account?
        <Link :href="route('register')" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
          Create one now
        </Link>
      </p>

      <div class="mt-10 w-full">
        <div class="bg-white py-12 px-8 shadow-2xl rounded-2xl border border-gray-100 w-full">
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
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
                  placeholder="Enter your email"
                />
              </div>
              <InputError :message="form.errors.email" class="mt-2" />
            </div>

            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block text-sm font-medium text-gray-700">
                  Password
                </label>
                <div class="text-sm" v-if="canResetPassword">
                  <Link :href="route('password.request')" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
                    Forgot password?
                  </Link>
                </div>
              </div>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                  </svg>
                </div>
                <input
                  id="password"
                  name="password"
                  :type="showPassword ? 'text' : 'password'"
                  autocomplete="current-password"
                  required
                  v-model="form.password"
                  :class="form.errors.password ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 text-gray-900 focus:ring-emerald-500 focus:border-emerald-500'"
                  class="block w-full pl-10 pr-10 py-3 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors sm:text-sm"
                  placeholder="Enter your password"
                />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                  <button 
                    type="button" 
                    @click="togglePasswordVisibility"
                    class="text-gray-400 hover:text-gray-500 focus:outline-none transition-colors"
                  >
                    <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                    <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                  </button>
                </div>
              </div>
              <InputError :message="form.errors.password" class="mt-2" />
            </div>

            <div class="flex items-center justify-between">
              <div class="flex items-center">
                <input
                  id="remember"
                  name="remember"
                  type="checkbox"
                  v-model="form.remember"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded transition-colors"
                />
                <label for="remember" class="ml-2 block text-sm text-gray-700">
                  Remember me
                </label>
              </div>
            </div>

            <div>
              <button
                type="submit"
                :disabled="form.processing"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all transform hover:translate-y-[-1px] disabled:opacity-50 disabled:cursor-not-allowed"
              >
                <span v-if="!form.processing">Sign in</span>
                <span v-else>Signing in...</span>
              </button>
            </div>
          </form>

          <div class="mt-6">
            <div class="relative">
              <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
              </div>
              <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                  Or continue with
                </span>
              </div>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-3">
              <div>
                <a
                  href="#"
                  class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-200 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors"
                >
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd" />
                  </svg>
                </a>
              </div>

              <div>
                <a
                  href="#"
                  class="w-full inline-flex justify-center py-2.5 px-4 border border-gray-200 rounded-lg shadow-sm bg-white text-sm font-medium text-gray-600 hover:bg-gray-50 transition-colors"
                >
                  <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                  </svg>
                </a>
              </div>
            </div>
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

<script setup>
import LoginLayout from '@/Layouts/LoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

defineProps({
    canResetPassword: {
        type: Boolean,
        default: true,
    },
    status: {
        type: String,
        default: null,
    },
});
</script>