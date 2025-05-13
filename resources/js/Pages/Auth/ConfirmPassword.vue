<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import LinkButton from '@/Pages/section/LinkButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'));
};
</script>

<template>
    <GuestLayout>
        <Head title="Confirm Password" />

        <div class="mb-4 text-sm text-[#543434]">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="password" value="Password" class="text-[#543434]" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full text-[#543434] border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <LinkButton btnType="primary" link="#" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Confirm Password
                </LinkButton>
            </div>
        </form>
    </GuestLayout>
</template>