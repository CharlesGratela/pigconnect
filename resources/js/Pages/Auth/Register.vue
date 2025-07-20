<template>
  <LoginLayout>
    <Head title="Register" />
    <div class="sm:mx-auto sm:w-full max-w-xl">
      <div class="flex justify-center">
        <div class="bg-emerald-600 h-14 w-14 rounded-xl flex items-center justify-center shadow-md transform transition-transform hover:scale-105">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </div>
      </div>
      <h2 class="mt-6 text-center text-3xl font-bold text-gray-800">Create your account</h2>
      <p class="mt-2 text-center text-sm text-gray-600">
        Already have an account?
        <Link :href="route('login')" class="font-medium text-emerald-600 hover:text-emerald-500 transition-colors">
          Sign in
        </Link>
      </p>

      <div class="mt-10 w-full">
        <div class="bg-white py-12 px-8 shadow-2xl rounded-2xl border border-gray-100 w-full">
          <form class="space-y-6" @submit.prevent="submit">
            <!-- Name Field -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">
                Full Name
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <input
                  id="name"
                  name="name"
                  type="text"
                  autocomplete="name"
                  required
                  v-model="form.name"
                  :class="form.errors.name ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 text-gray-900 focus:ring-emerald-500 focus:border-emerald-500'"
                  class="block w-full pl-10 pr-3 py-3 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors sm:text-sm"
                  placeholder="Enter your full name"
                />
              </div>
              <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Role Field -->
            <div>
              <label for="role" class="block text-sm font-medium text-gray-700">
                I am a
              </label>
              <div class="mt-1 relative">
                <select
                  id="role"
                  name="role"
                  v-model="form.role"
                  class="mt-1 block w-full pl-10 pr-3 py-3 text-base border-gray-200 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm rounded-lg"
                >
                  <option value="farmer">Farmer</option>
                  <option value="buyer">Buyer</option>
                </select>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                  </svg>
                </div>
              </div>
              <InputError :message="form.errors.role" class="mt-2" />
            </div>

            <!-- Email Field -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email address
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
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

            <!-- Password Field -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                Password
              </label>
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
                  autocomplete="new-password"
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
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.88l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
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

            <!-- Confirm Password Field -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm Password
              </label>
              <div class="mt-1 relative rounded-md shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                  </svg>
                </div>
                <input
                  id="password_confirmation"
                  name="password_confirmation"
                  type="password"
                  autocomplete="new-password"
                  required
                  v-model="form.password_confirmation"
                  :class="form.errors.password_confirmation ? 'border-red-300 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500' : 'border-gray-200 text-gray-900 focus:ring-emerald-500 focus:border-emerald-500'"
                  class="block w-full pl-10 pr-3 py-3 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 transition-colors sm:text-sm"
                  placeholder="Confirm your password"
                />
              </div>
              <InputError :message="form.errors.password_confirmation" class="mt-2" />
            </div>

            <!-- Terms and Conditions -->
            <div class="flex items-start">
              <div class="flex items-center h-5">
                <input
                  id="terms"
                  name="terms"
                  type="checkbox"
                  v-model="form.terms"
                  class="h-4 w-4 text-emerald-600 focus:ring-emerald-500 border-gray-300 rounded"
                />
              </div>
              <div class="ml-3 text-sm">
                <label for="terms" class="font-medium text-gray-700">
                  I accept the 
                  <button 
                    type="button" 
                    @click="showTermsModal = true" 
                    class="text-emerald-600 hover:text-emerald-500 cursor-pointer font-medium focus:outline-none focus:underline"
                  >
                    Terms and Conditions
                  </button> 
                  and 
                  <button 
                    type="button" 
                    @click="showPrivacyModal = true" 
                    class="text-emerald-600 hover:text-emerald-500 cursor-pointer font-medium focus:outline-none focus:underline"
                  >
                    Privacy Policy
                  </button>
                </label>
                <InputError :message="form.errors.terms" class="mt-2" />
              </div>
            </div>
            <InputError :message="form.errors.acceptedTerms" class="mt-1" />
            
            <!-- Modals are now directly in the template above --> 

            <!-- Submit Button -->
            <div>
              <button
                type="submit"
                :disabled="form.processing"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200"
                :class="{ 'opacity-50 cursor-not-allowed': form.processing }"
              >
                <span v-if="!form.processing">Create Account</span>
                <svg v-else class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
              </button>
            </div>
          </form>

          <!-- Social Login Section -->
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
    </div>



    <!-- Terms and Conditions Modal -->
    <Modal :show="showTermsModal" @close="showTermsModal = false" title="Terms and Conditions" class="max-w-3xl">
      <div class="space-y-6 max-h-[65vh] overflow-y-auto pr-4">
        <div class="bg-emerald-50 p-4 rounded-lg border border-emerald-100">
          <h4 class="font-semibold text-emerald-800 text-lg mb-2">1. Acceptance of Terms</h4>
          <p class="text-gray-700">By registering and using PigConnect, you agree to comply with these Terms and Conditions. If you do not agree to these terms, you are prohibited from using the platform.</p>
        </div>

        <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
          <h4 class="font-semibold text-amber-800 text-lg mb-2">2. Eligibility</h4>
          <p class="text-gray-700">You must be at least 18 years old to use PigConnect. Users are responsible for ensuring that they comply with all applicable laws in the Philippines.</p>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">3. User Responsibilities</h4>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>Provide accurate and up-to-date information during registration.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>Maintain the confidentiality of your account details.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>Misuse, including providing false data or engaging in prohibited activities, may result in account termination.</span>
            </li>
          </ul>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">4. Services Provided</h4>
          <p class="text-gray-700">PigConnect provides tools for farm management, buyer-seller connections, and analytics. The platform serves as a facilitator and does not guarantee transaction outcomes.</p>
        </div>

        <div class="bg-red-50 p-4 rounded-lg border border-red-100">
          <h4 class="font-semibold text-red-800 text-lg mb-2">5. Prohibited Activities</h4>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-500 mt-2 mr-2"></span>
              <span>Uploading offensive, illegal, or harmful content.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-500 mt-2 mr-2"></span>
              <span>Engaging in fraudulent activities or impersonation.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-red-500 mt-2 mr-2"></span>
              <span>Attempting to disrupt the platform or breach its security measures.</span>
            </li>
          </ul>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">6. Intellectual Property</h4>
          <p class="text-gray-700">All content, designs, and features of PigConnect are owned by PigConnect and are protected under intellectual property laws in the Philippines.</p>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
          <h4 class="font-semibold text-blue-800 text-lg mb-2">7. Limitation of Liability</h4>
          <p class="text-gray-700">PigConnect is not responsible for losses, disputes, or damages arising from user activities or system errors. Users assume responsibility for interactions facilitated by the platform.</p>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">8. Amendments</h4>
          <p class="text-gray-700">PigConnect reserves the right to modify these terms. Significant changes will be communicated via email or in-platform notifications.</p>
        </div>

        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
          <h4 class="font-semibold text-purple-800 text-lg mb-2">9. Governing Law</h4>
          <p class="text-gray-700">These Terms and Conditions are governed by the laws of the Philippines.</p>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">10. Contact Us</h4>
          <p class="text-gray-700">For questions, email us at <a href="mailto:pigconnect.main@gmail.com" class="text-emerald-600 hover:text-emerald-500 font-medium hover:underline">pigconnect.main@gmail.com</a>.</p>
        </div>
      </div>
      <div class="flex justify-end mt-6 space-x-3 pt-4 border-t border-gray-100">
        <button 
          @click="showTermsModal = false" 
          class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors"
        >
          Cancel
        </button>
        <button 
          @click="acceptTerms" 
          class="px-5 py-2.5 text-sm font-medium text-white bg-emerald-600 rounded-lg hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors shadow-sm"
        >
          I Accept
        </button>
      </div>
    </Modal>

    <!-- Privacy Policy Modal -->
    <Modal :show="showPrivacyModal" @close="showPrivacyModal = false" title="Privacy Policy" class="max-w-3xl">
      <div class="space-y-6 max-h-[65vh] overflow-y-auto pr-4">
        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
          <h4 class="font-semibold text-blue-800 text-lg mb-2">1. Information We Collect</h4>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-blue-500 mt-2 mr-2"></span>
              <span><span class="font-medium text-gray-800">Personal Data:</span> Includes name, email, phone number, and farm/business details.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-blue-500 mt-2 mr-2"></span>
              <span><span class="font-medium text-gray-800">Usage Data:</span> Interaction patterns, device details, and IP address.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-blue-500 mt-2 mr-2"></span>
              <span><span class="font-medium text-gray-800">Transaction Data:</span> Purchase history and preferences.</span>
            </li>
          </ul>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">2. How We Use Your Information</h4>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>To provide and enhance PigConnect services.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>To deliver personalized recommendations and improve user experience.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>To notify you of updates, promotions, and system changes.</span>
            </li>
          </ul>
        </div>

        <div class="bg-purple-50 p-4 rounded-lg border border-purple-100">
          <h4 class="font-semibold text-purple-800 text-lg mb-2">3. Data Sharing</h4>
          <p class="text-gray-700 mb-2">Your data will not be sold or shared with third parties unless required for:</p>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-purple-500 mt-2 mr-2"></span>
              <span>Legal compliance.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-purple-500 mt-2 mr-2"></span>
              <span>Service facilitation (e.g., payment processors).</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-purple-500 mt-2 mr-2"></span>
              <span>System improvement in anonymized and aggregated forms.</span>
            </li>
          </ul>
        </div>

        <div class="bg-amber-50 p-4 rounded-lg border border-amber-100">
          <h4 class="font-semibold text-amber-800 text-lg mb-2">4. Data Security</h4>
          <p class="text-gray-700">We implement security measures to protect your data but cannot guarantee complete security due to risks associated with online data transmission.</p>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">5. User Rights</h4>
          <ul class="list-disc pl-5 space-y-2 text-gray-700">
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>Request access, correction, or deletion of your data by contacting <a href="mailto:pigconnect.main@gmail.com" class="text-emerald-600 hover:text-emerald-500 font-medium hover:underline">pigconnect.main@gmail.com</a>.</span>
            </li>
            <li class="flex items-start">
              <span class="inline-block h-1.5 w-1.5 rounded-full bg-emerald-500 mt-2 mr-2"></span>
              <span>Opt out of receiving promotional messages.</span>
            </li>
          </ul>
        </div>

        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">6. Cookies</h4>
          <p class="text-gray-700">Cookies are used to enhance functionality and analyze platform performance. You can manage cookie preferences through your browser.</p>
        </div>

        <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
          <h4 class="font-semibold text-gray-800 text-lg mb-2">7. Third-Party Links</h4>
          <p class="text-gray-700">PigConnect may link to external websites. We are not responsible for their content or privacy policies.</p>
        </div>

        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
          <h4 class="font-semibold text-blue-800 text-lg mb-2">8. Amendments</h4>
          <p class="text-gray-700">This policy is subject to updates. Changes will be notified via email or system announcements.</p>
        </div>

        <div class="bg-emerald-50 p-4 rounded-lg border border-emerald-100">
          <h4 class="font-semibold text-emerald-800 text-lg mb-2">9. Contact Us</h4>
          <p class="text-gray-700">For privacy-related inquiries, email us at <a href="mailto:pigconnect.main@gmail.com" class="text-emerald-600 hover:text-emerald-500 font-medium hover:underline">pigconnect.main@gmail.com</a>.</p>
        </div>
      </div>
      <div class="flex justify-end mt-6 space-x-3 pt-4 border-t border-gray-100">
        <button 
          @click="showPrivacyModal = false" 
          class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors"
        >
          Close
        </button>
      </div>
    </Modal>
  </LoginLayout>
</template>

<script setup>
import LoginLayout from '@/Layouts/LoginLayout.vue';
import InputError from '@/Components/InputError.vue';
import Modal from '@/Components/Modal.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

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

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    role: 'farmer',
    acceptedTerms: false,
});

const showPassword = ref(false);
const showTermsModal = ref(false);
const showPrivacyModal = ref(false);

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

const acceptTerms = () => {
    form.acceptedTerms = true;
    showTermsModal.value = false;
};

const acceptPrivacy = () => {
    showPrivacyModal.value = false;
};

const submit = () => {
    if (form.password !== form.password_confirmation) {
        form.setError('password_confirmation', 'The password confirmation does not match.');
        return;
    }

    if (!form.acceptedTerms) {
        form.setError('acceptedTerms', 'You must accept the Terms and Conditions and Privacy Policy.');
        return;
    }

    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>