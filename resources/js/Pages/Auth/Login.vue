<template>
  <LoginLayout>
    <Head title="Log in" />
    <div class="md:max-w-md w-full px-4 py-4">
      <form @submit.prevent="submit">
        <div class="mb-12">
          <h3 class="text-[#543434] text-3xl font-extrabold">Sign in</h3>
          <p class="text-sm mt-4 text-[#543434]">Don't have an account 
            <a :href="route('register')" class="text-[#c58a61] font-semibold hover:underline ml-1 whitespace-nowrap">Register here</a>
          </p>
        </div>
   
        <div>
          <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
          {{ status }}
          </div>  
          <label class="text-[#543434] text-xs block mb-2">Email</label>
          <div class="relative flex items-center">
            <TextInput name="email" type="text" v-model="form.email" required class="w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none" placeholder="Enter email" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="#c59461" stroke="#c59461" class="w-[18px] h-[18px] absolute right-2" viewBox="0 0 682.667 682.667">
              <defs>
                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                  <path d="M0 512h512V0H0Z" data-original="#c59461"></path>
                </clipPath>
              </defs>
              <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                <path fill="none" stroke-miterlimit="10" stroke-width="40" d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z" data-original="#c59461"></path>
                <path d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z" data-original="#c59461"></path>
              </g>
            </svg>
          </div>
          <InputError :message="form.errors.email" class="mt-2" />
        </div>

        <div class="mt-8">
          <label class="text-[#543434] text-xs block mb-2">Password</label>
          <div class="relative flex items-center">
            <TextInput :type="showPassword ? 'text' : 'password'" name="password" v-model="form.password" required class="w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none" placeholder="Enter password" />
            <svg @click="togglePasswordVisibility" xmlns="http://www.w3.org/2000/svg" fill="#c59461" stroke="#c59461" class="w-[18px] h-[18px] absolute right-2 cursor-pointer" viewBox="0 0 128 128">
              <path d="M64 104C22.127 104 1.367 67.496.504 65.943a4 4 0 0 1 0-3.887C1.367 60.504 22.127 24 64 24s62.633 36.504 63.496 38.057a4 4 0 0 1 0 3.887C126.633 67.496 105.873 104 64 104zM8.707 63.994C13.465 71.205 32.146 96 64 96c31.955 0 50.553-24.775 55.293-31.994C114.535 56.795 95.854 32 64 32 32.045 32 13.447 56.775 8.707 63.994zM64 88c-13.234 0-24-10.766-24-24s10.766-24 24-24 24 10.766 24 24-10.766 24-24 24zm0-40c-8.822 0-16 7.178-16 16s7.178 16 16 16 16-7.178 16-16-7.178-16-16-16z" data-original="#c59461"></path>
            </svg>
          </div>
          <InputError :message="form.errors.password" class="mt-2" />
        </div>

        <div class="flex flex-wrap items-center justify-between gap-4 mt-6">
          <div class="flex items-center">
            <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 shrink-0 text-[#c58a61] focus:ring-[#c58a61] border-[#c59461] rounded" />
            <label for="remember-me" class="ml-3 block text-sm text-[#543434]">
              Remember me
            </label>
          </div>
          <div>
            <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-[#c59461] hover:text-[#a7674d] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c58a61]"
                >
                    Forgot your password?
                </Link>
          </div>
        </div>

        <div class="mt-12">
          <LinkButton btnType="primary" link="#" class="w-full text-center" :disabled="form.processing">Sign in</LinkButton>
        </div>
      </form>
    </div>
  </LoginLayout>
</template>

<script setup>
import LoginLayout from '@/Layouts/LoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import LinkButton from '@/Pages/section/LinkButton.vue';

import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
  email: '',
  password: '',
});
defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
    message: {
        type: String,
        default: null,
    },
    throttle: {
        type: Object,
        default: null,
    },
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
</script>