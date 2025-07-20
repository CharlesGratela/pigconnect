<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <h2 class="text-3xl font-bold">Buyer Preferences</h2>
              <p class="text-emerald-100 mt-1">Set your preferences to get personalized pig recommendations</p>
            </div>
          </div>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Preferences Overview Card -->
          <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
              <div>
                <h3 class="text-2xl font-bold text-gray-800">Your Preferences</h3>
                <p class="text-gray-600 mt-1">Customize your pig search criteria for better matches</p>
              </div>
              <div class="bg-emerald-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                </svg>
              </div>
            </div>

            <!-- Current Preferences Summary -->
            <div v-if="hasPreferences" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl p-4">
                <div class="flex items-center space-x-3">
                  <div class="bg-emerald-600 text-white rounded-lg p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-emerald-800">Weight Range</p>
                    <p class="text-emerald-900 font-semibold">{{ preferredWeight || 'Not set' }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-4">
                <div class="flex items-center space-x-3">
                  <div class="bg-blue-600 text-white rounded-lg p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-blue-800">Age Group</p>
                    <p class="text-blue-900 font-semibold">{{ ageOfPigs || 'Not set' }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-purple-50 to-purple-100 rounded-xl p-4">
                <div class="flex items-center space-x-3">
                  <div class="bg-purple-600 text-white rounded-lg p-2">
                    <span class="text-lg">💰</span>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-purple-800">Price Range</p>
                    <p class="text-purple-900 font-semibold">{{ priceRange || 'Not set' }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Preference Configuration Form -->
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-600 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </div>
                Configure Your Preferences
              </h3>
              <p class="text-emerald-600 mt-1">Set your criteria to find the perfect pigs for your needs</p>
            </div>

            <div class="p-6">
              <form @submit.prevent="submitForm" class="space-y-8">
                <!-- Weight Preferences -->
                <div class="space-y-4">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                    </svg>
                    <span>Weight Preferences</span>
                  </h4>
                  
                  <div>
                    <label for="preferredWeight" class="block text-sm font-bold text-gray-700 mb-2">Preferred Weight Range</label>
                    <div class="relative">
                      <input 
                        type="text" 
                        id="preferredWeight" 
                        v-model="preferredWeight" 
                        placeholder="e.g., 50-80 kg"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                      />
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Age Preferences -->
                <div class="space-y-4 border-t border-gray-200 pt-8">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <span>Age Group</span>
                  </h4>
                  
                  <div>
                    <label for="ageOfPigs" class="block text-sm font-bold text-gray-700 mb-2">Preferred Age of Pigs</label>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                      <div 
                        v-for="ageOption in ageOptions" 
                        :key="ageOption.value"
                        @click="ageOfPigs = ageOption.value"
                        :class="ageOfPigs === ageOption.value ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-emerald-300'"
                        class="border-2 rounded-xl p-4 cursor-pointer transition-all duration-200 hover:shadow-md"
                      >
                        <div class="flex items-center space-x-3">
                          <div :class="ageOfPigs === ageOption.value ? 'bg-emerald-600' : 'bg-gray-400'" class="w-4 h-4 rounded-full transition-colors"></div>
                          <div>
                            <p :class="ageOfPigs === ageOption.value ? 'text-emerald-800' : 'text-gray-800'" class="font-medium">{{ ageOption.label }}</p>
                            <p :class="ageOfPigs === ageOption.value ? 'text-emerald-600' : 'text-gray-600'" class="text-sm">{{ ageOption.description }}</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Price and Additional Preferences -->
                <div class="space-y-6 border-t border-gray-200 pt-8">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <span class="text-emerald-600 text-xl">💰</span>
                    <span>Budget & Location</span>
                  </h4>
                  
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                      <label for="priceRange" class="block text-sm font-bold text-gray-700 mb-2">Price Range</label>
                      <div class="relative">
                        <input 
                          type="text" 
                          id="priceRange" 
                          v-model="priceRange" 
                          placeholder="e.g., ₱5,000 - ₱10,000"
                          class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                          <span class="text-emerald-600 text-lg">₱</span>
                        </div>
                      </div>
                    </div>

                    <div>
                      <label for="preferNearby" class="block text-sm font-bold text-gray-700 mb-2">Prefer Nearby Location</label>
                      <div class="flex space-x-3">
                        <button 
                          type="button"
                          @click="preferNearby = '1'"
                          :class="preferNearby === '1' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-emerald-50'"
                          class="flex-1 px-4 py-3 rounded-xl font-medium transition-all duration-200"
                        >
                          Yes, nearby preferred
                        </button>
                        <button 
                          type="button"
                          @click="preferNearby = '0'"
                          :class="preferNearby === '0' ? 'bg-emerald-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-emerald-50'"
                          class="flex-1 px-4 py-3 rounded-xl font-medium transition-all duration-200"
                        >
                          Distance not important
                        </button>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Breed Preferences -->
                <div class="space-y-4 border-t border-gray-200 pt-8">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <span class="text-2xl">🐷</span>
                    <span>Breed Preferences</span>
                  </h4>
                  
                  <div>
                    <label for="breed" class="block text-sm font-bold text-gray-700 mb-2">Preferred Breed</label>
                    <div class="relative">
                      <input 
                        type="text" 
                        id="breed" 
                        v-model="breed" 
                        placeholder="e.g., Landrace, Yorkshire, Duroc"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                      />
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <span class="text-emerald-600 text-lg">🐷</span>
                      </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Leave blank for any breed</p>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200">
                  <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]"
                  >
                    <span class="flex items-center justify-center space-x-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                      <span>Save Preferences</span>
                    </span>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Benefits Card -->
          <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-start space-x-3">
              <div class="bg-blue-100 p-2 rounded-xl">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h4 class="font-bold text-blue-800 mb-2">Why Set Preferences?</h4>
                <ul class="text-blue-700 space-y-1 text-sm">
                  <li>• Get personalized pig recommendations that match your needs</li>
                  <li>• Save time by filtering out unsuitable options</li>
                  <li>• Find the best value within your budget</li>
                  <li>• Connect with farmers who have what you're looking for</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const preferredWeight = ref('');
const ageOfPigs = ref('');
const priceRange = ref('');
const preferNearby = ref('');
const breed = ref('');
const showSuccessDialog = ref(false);

const ageOptions = [
  {
    value: '0-3 months',
    label: 'Piglets (0-3 months)',
    description: 'Young pigs for raising'
  },
  {
    value: '3-6 months',
    label: 'Growers (3-6 months)',
    description: 'Growing pigs'
  },
  {
    value: '6-8 months',
    label: 'Finishers (6-8 months)',
    description: 'Near market weight'
  },
  {
    value: '6 months and above',
    label: 'Breeding Stock (6+ months)',
    description: 'For breeding purposes'
  }
];

const hasPreferences = computed(() => {
  return preferredWeight.value || ageOfPigs.value || priceRange.value || breed.value;
});

const fetchBuyerPreferences = async () => {
  try {
    const response = await fetch('/api/buyerspreferencesget', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log(data);

    if (data) {
      preferredWeight.value = data.preferred_weight;
      ageOfPigs.value = data.age_of_pigs;
      priceRange.value = data.price_range;
      breed.value = data.breed;
      if(data.prefer_nearby === 1) {
        preferNearby.value = '1';
      } else {
        preferNearby.value = '0';
      }
    }
  } catch (error) {
    console.error('Error fetching buyer preferences:', error);
  }
};

const submitForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/buyerspreferencesstore', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify({
        preferred_weight: preferredWeight.value,
        age_of_pigs: ageOfPigs.value,
        price_range: priceRange.value,
        prefer_nearby: preferNearby.value,
        breed: breed.value
      })
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Form submitted successfully:', data);
    // Show success dialog
    showSuccessDialog.value = true;
    // Re-fetch the buyer preferences to reflect the updated details
    window.location.reload();
    await fetchBuyerPreferences();
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};

const closeDialog = () => {
  showSuccessDialog.value = false;
};

onMounted(() => {
  fetchBuyerPreferences();
});
</script>

<style>
/* Add any necessary styles here */
</style>