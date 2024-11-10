<template>
    <LoginLayout>
      <Head title="Log in" />
      <div class="md:max-w-md w-full px-4 py-4">
        <form @submit.prevent="submit">
          <div class="mb-12">
            <h3 class="text-gray-800 dark:text-gray-200 text-3xl font-extrabold">Sign in</h3>
            <p class="text-sm mt-4 text-gray-800 dark:text-gray-200">Don't have an account 
              <a :href="route('register')" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a>
            </p>
          </div>
  
          <div>
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Email</label>
            <div class="relative flex items-center">
              <TextInput name="email" type="text" v-model="form.email" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter email" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
                <defs>
                  <clipPath id="a" clipPathUnits="userSpaceOnUse">
                    <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                  </clipPath>
                </defs>
                <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                  <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#000000"></path>
                  <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#000000"></path>
                </g>
              </svg>
            </div>
            <InputError :message="form.errors.email" class="mt-2" />
          </div>
  
          <div class="mt-8">
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Password</label>
            <div class="relative flex items-center">
              <TextInput :type="showPassword ? 'text' : 'password'" name="password" v-model="form.password" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter password" />
              <svg @click="togglePasswordVisibility" xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
                <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#000000"></path>
              </svg>
            </div>
            <InputError :message="form.errors.password" class="mt-2" />
          </div>
  
          <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
            <div class="flex items-center">
              <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded" />
              <label for="remember-me" class="ml-3 block text-sm text-gray-800 dark:text-gray-200">
                Remember me
              </label>
            </div>
            <div>
              <a href="javascript:void(0);" class="text-blue-600 dark:text-blue-400 font-semibold text-sm hover:underline">
                Forgot Password?
              </a>
            </div>
          </div>
  
          <div class="mt-12">
            <PrimaryButton class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none" :disabled="form.processing">
              Sign in
            </PrimaryButton>
          </div>
  
          <div class="flex items-center mt-6">
            <button @click="toggleTheme" class="flex items-center bg-gray-600 dark:bg-gray-400 w-14 h-8 rounded-full focus:outline-none">
              <div class="dot bg-white w-6 h-6 rounded-full transition"></div>
            </button>
            <label for="theme-toggle" class="ml-3 text-sm text-gray-800 dark:text-gray-200">
              {{ theme === 'light' ? 'Dark Mode' : 'Light Mode' }}
            </label>
          </div>
        </form>
      </div>
    </LoginLayout>
  </template>
  
  <script setup>
  import LoginLayout from '@/Layouts/LoginLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import { ref, onMounted } from 'vue';
  
  const form = useForm({
    email: '',
    password: '',
  });
  
  const theme = ref('light');
  const showPassword = ref(false);
  
  const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    document.documentElement.classList.toggle('dark', theme.value === 'dark');
  };
  
  const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
  };
  
  onMounted(() => {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      theme.value = 'dark';
      document.documentElement.classList.add('dark');
    }
  });
  
  const submit = () => {
    form.post(route('login'));
  };
  </script>
  
  <style>
  .dot {
    transition: transform 0.2s;
  }
  button:active .dot {
    transform: translateX(6px);
  }
  </style>