<template>
    <GuestLayout>
      <Head title="Register" />
      <div class="md:max-w-md w-full px-4 py-4">
        <form @submit.prevent="submit">
          <div class="mb-12">
            <h3 class="text-gray-800 dark:text-gray-200 text-3xl font-extrabold">Register</h3>
            <p class="text-sm mt-4 text-gray-800 dark:text-gray-200">Already have an account? 
              <a :href="route('login')" class="text-blue-600 dark:text-blue-400 font-semibold hover:underline ml-1 whitespace-nowrap">Log in here</a>
            </p>
          </div>
  
          <div>
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Name</label>
            <TextInput name="name" type="text" v-model="form.name" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter name" />
            <InputError :message="form.errors.name" class="mt-2" />
          </div>
  
          <div class="mt-8">
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Role</label>
            <select id="role" v-model="form.role" class="mt-1 block w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none">
              <option value="farmer">Farmer</option>
              <option value="buyer">Buyer</option>
            </select>
            <InputError :message="form.errors.role" class="mt-2" />
          </div>
  
          <div class="mt-8">
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Email</label>
            <TextInput name="email" type="email" v-model="form.email" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter email" />
            <InputError :message="form.errors.email" class="mt-2" />
          </div>
  
          <div class="mt-8">
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Password</label>
            <TextInput name="password" type="password" v-model="form.password" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Enter password" />
            <InputError :message="form.errors.password" class="mt-2" />
          </div>
  
          <div class="mt-8">
            <label class="text-gray-800 dark:text-gray-200 text-xs block mb-2">Confirm Password</label>
            <TextInput name="password_confirmation" type="password" v-model="form.password_confirmation" required class="w-full text-gray-800 dark:text-gray-200 text-sm border-b border-gray-300 dark:border-gray-600 focus:border-blue-600 px-2 py-3 outline-none" placeholder="Confirm password" />
            <InputError :message="form.errors.password_confirmation" class="mt-2" />
          </div>
  
          <div class="flex items-center mt-6">
            <button @click="toggleTheme" class="flex items-center bg-gray-600 dark:bg-gray-400 w-14 h-8 rounded-full focus:outline-none">
              <div :class="{'dot': true, 'translate-x-6': theme === 'dark'}" class="bg-white w-6 h-6 rounded-full transition"></div>
            </button>
            <label for="theme-toggle" class="ml-3 text-sm text-gray-800 dark:text-gray-200">
              {{ theme === 'light' ? 'Dark Mode' : 'Light Mode' }}
            </label>
          </div>
  
          <div class="mt-12">
            <PrimaryButton class="w-full shadow-xl py-2.5 px-4 text-sm tracking-wide rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none" :disabled="form.processing">
              Register
            </PrimaryButton>
          </div>
        </form>
      </div>
    </GuestLayout>
  </template>
  
  <script setup>
  import GuestLayout from '@/Layouts/GuestLayout.vue';
  import InputError from '@/Components/InputError.vue';
  import PrimaryButton from '@/Components/PrimaryButton.vue';
  import TextInput from '@/Components/TextInput.vue';
  import { Head, useForm } from '@inertiajs/vue3';
  import { ref, onMounted } from 'vue';
  
  const form = useForm({
    name: '',
    role: '',
    email: '',
    password: '',
    password_confirmation: '',
  });
  
  const theme = ref('light');
  
  const toggleTheme = () => {
    theme.value = theme.value === 'light' ? 'dark' : 'light';
    document.documentElement.classList.toggle('dark', theme.value === 'dark');
  };
  
  onMounted(() => {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
      theme.value = 'dark';
      document.documentElement.classList.add('dark');
    }
  });
  
  const submit = () => {
    form.post(route('register'), {
      onFinish: () => form.reset('password', 'password_confirmation'),
    });
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