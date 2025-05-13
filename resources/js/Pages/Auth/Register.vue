<template>
  <GuestLayout>
    <Head title="Register" />
    <div class="md:max-w-lg w-full px-4 py-4">
      <form @submit.prevent="submit">
        <div class="mb-12">
          <h3 class="text-[#543434] text-3xl font-extrabold">Register</h3>
          <p class="text-sm mt-4 text-[#543434]">Already have an account? 
            <a :href="route('login')" class="text-[#c58a61] font-semibold hover:underline ml-1 whitespace-nowrap">Log in here</a>
          </p>
        </div>

        <div>
          <label class="text-[#543434] text-xs block mb-2">Name</label>
          <TextInput name="name" type="text" v-model="form.name" required class="w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none" placeholder="Enter name" />
          <InputError :message="form.errors.name" class="mt-2" />
        </div>

        <div class="mt-8">
          <label class="text-[#543434] text-xs block mb-2">Role</label>
          <select id="role" v-model="form.role" class="mt-1 block w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none bg-white">
            <option value="farmer">Farmer</option>
            <option value="buyer">Buyer</option>
          </select>
          <InputError :message="form.errors.role" class="mt-2" />
        </div>

        <div class="mt-8">
          <label class="text-[#543434] text-xs block mb-2">Email</label>
          <TextInput name="email" type="email" v-model="form.email" required class="w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none" placeholder="Enter email" />
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

        <div class="mt-8">
          <label class="text-[#543434] text-xs block mb-2">Confirm Password</label>
          <TextInput name="password_confirmation" type="password" v-model="form.password_confirmation" required class="w-full text-[#543434] text-sm border-b border-[#c59461] focus:border-[#c58a61] px-2 py-3 outline-none" placeholder="Confirm password" />
          <InputError :message="form.errors.password_confirmation" class="mt-2" />
        </div>

        <!-- Terms and Conditions Checkbox -->
        <div class="mt-8">
          <label class="flex items-center">
            <input type="checkbox" v-model="form.acceptedTerms" class="form-checkbox text-[#c58a61]" :disabled="!acceptedTerms">
            <span class="ml-2 text-sm text-[#543434]">
              I agree to the
              <button type="button" @click="showTermsModal = true" class="text-[#c58a61] font-semibold hover:underline">Terms and Conditions</button>
              and
              <button type="button" @click="showPrivacyModal = true" class="text-[#c58a61] font-semibold hover:underline">Privacy Policy</button>.
            </span>
          </label>
          <InputError :message="form.errors.acceptedTerms" class="mt-2" />
        </div>

        <!-- Register Button -->
        <div class="mt-12">
          <LinkButton btnType="primary" link="#" class="w-full text-center">Register</LinkButton>
        </div>
      </form>
    </div>

    <!-- Terms and Conditions Modal -->
    <Modal v-if="showTermsModal" @close="showTermsModal = false" title="Terms and Conditions">
      <p class="text-[#543434]">Terms and Conditions
1. Acceptance of Terms
By registering and using PigConnect, you agree to comply with these Terms and Conditions. If you do not agree to these terms, you are prohibited from using the platform.

2. Eligibility
You must be at least 18 years old to use PigConnect. Users are responsible for ensuring that they comply with all applicable laws in the Philippines.

3. User Responsibilities

Provide accurate and up-to-date information during registration.
Maintain the confidentiality of your account details.
Misuse, including providing false data or engaging in prohibited activities, may result in account termination.
4. Services Provided
PigConnect provides tools for farm management, buyer-seller connections, and analytics. The platform serves as a facilitator and does not guarantee transaction outcomes.

5. Prohibited Activities

Uploading offensive, illegal, or harmful content.
Engaging in fraudulent activities or impersonation.
Attempting to disrupt the platform or breach its security measures.
6. Intellectual Property
All content, designs, and features of PigConnect are owned by PigConnect and are protected under intellectual property laws in the Philippines.

7. Limitation of Liability
PigConnect is not responsible for losses, disputes, or damages arising from user activities or system errors. Users assume responsibility for interactions facilitated by the platform.

8. Amendments
PigConnect reserves the right to modify these terms. Significant changes will be communicated via email or in-platform notifications.

9. Governing Law
These Terms and Conditions are governed by the laws of the Philippines.

10. Contact Us
For questions, email us at pigconnect.main@gmail.com.</p>
      <div class="flex justify-end mt-4">
        <button @click="acceptTerms" class="bg-[#281c11] text-white px-4 py-2 rounded hover:bg-[#c59461]">Accept</button>
      </div>
    </Modal>

    <!-- Privacy Policy Modal -->
    <Modal v-if="showPrivacyModal" @close="showPrivacyModal = false" title="Privacy Policy">
      <p class="text-[#543434]">Privacy Policy
1. Information We Collect

Personal Data: Includes name, email, phone number, and farm/business details.
Usage Data: Interaction patterns, device details, and IP address.
Transaction Data: Purchase history and preferences.
2. How We Use Your Information

To provide and enhance PigConnect services.
To deliver personalized recommendations and improve user experience.
To notify you of updates, promotions, and system changes.
3. Data Sharing
Your data will not be sold or shared with third parties unless required for:

Legal compliance.
Service facilitation (e.g., payment processors).
System improvement in anonymized and aggregated forms.
4. Data Security
We implement security measures to protect your data but cannot guarantee complete security due to risks associated with online data transmission.

5. User Rights

Request access, correction, or deletion of your data by contacting pigconnect.main@gmail.com.
Opt out of receiving promotional messages.
6. Cookies
Cookies are used to enhance functionality and analyze platform performance. You can manage cookie preferences through your browser.

7. Third-Party Links
PigConnect may link to external websites. We are not responsible for their content or privacy policies.

8. Amendments
This policy is subject to updates. Changes will be notified via email or system announcements.

9. Contact Us
For privacy-related inquiries, email us at pigconnect.main@gmail.com.</p>
      <div class="flex justify-end mt-4">
        <button @click="acceptPrivacy" class="bg-[#281c11] text-white px-4 py-2 rounded hover:bg-[#c59461]">Accept</button>
      </div>
    </Modal>
  </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import LinkButton from '@/Pages/section/LinkButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Modal from '@/Components/Modal.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const form = useForm({
  name: '',
  role: '',
  email: '',
  password: '',
  password_confirmation: '',
  acceptedTerms: false,
});

const showPassword = ref(false);
const showTermsModal = ref(false);
const showPrivacyModal = ref(false);
const acceptedTerms = ref(false);

const togglePasswordVisibility = () => {
  showPassword.value = !showPassword.value;
};

const acceptTerms = () => {
  acceptedTerms.value = true;
  showTermsModal.value = false;
};

const acceptPrivacy = () => {
  acceptedTerms.value = true;
  showPrivacyModal.value = false;
};

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  });
};
</script>