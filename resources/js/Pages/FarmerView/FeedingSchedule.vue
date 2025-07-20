<template>
    <div>
      <AuthenticatedLayout>
        <template #header>
          <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
            <div class="flex items-center space-x-3">
              <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h2 class="text-3xl font-bold">Feeding Schedule</h2>
                <p class="text-emerald-100 mt-1">Manage your daily feeding times efficiently</p>
              </div>
            </div>
          </div>
        </template>
        <main class="py-8">
          <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Schedule Overview Card -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
              <div class="flex items-center justify-between mb-6">
                <div>
                  <h3 class="text-2xl font-bold text-gray-800">Schedule Overview</h3>
                  <p class="text-gray-600 mt-1">Set up your daily feeding times for optimal pig health</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
              </div>

              <!-- Current Schedule Summary -->
              <div v-if="feedingTimes.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                <div v-for="(time, index) in feedingTimes" :key="index" class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl p-4">
                  <div class="flex items-center space-x-3">
                    <div class="bg-emerald-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold">
                      {{ index + 1 }}
                    </div>
                    <div>
                      <p class="text-sm font-medium text-emerald-800">Feeding Time {{ index + 1 }}</p>
                      <p class="text-lg font-bold text-emerald-900">{{ formatTime(time) || 'Not set' }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Feeding Schedule Form -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
                <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                  <div class="bg-emerald-600 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </div>
                  Configure Feeding Times
                </h3>
                <p class="text-emerald-600 mt-1">Set precise times for your daily feeding schedule</p>
              </div>

              <div class="p-6">
                <form @submit.prevent="submitForm" class="space-y-6">
                  <!-- Number of Feedings Selector -->
                  <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3">Number of Daily Feedings</label>
                    <div class="flex flex-wrap gap-3">
                      <button 
                        v-for="num in [2, 3, 4, 5, 6]" 
                        :key="num"
                        type="button"
                        @click="setFeedingFrequency(num)"
                        :class="feedingFrequency === num ? 'bg-emerald-600 text-white shadow-lg' : 'bg-gray-100 text-gray-700 hover:bg-emerald-50 hover:text-emerald-600'"
                        class="px-6 py-3 rounded-xl font-medium transition-all duration-200 border border-gray-200 hover:border-emerald-300"
                      >
                        {{ num }} times
                      </button>
                    </div>
                  </div>

                  <!-- Feeding Times Input -->
                  <div v-if="feedingTimes.length > 0" class="space-y-4">
                    <h4 class="text-lg font-bold text-gray-800 mb-4">Set Feeding Times</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                      <div v-for="(time, index) in feedingTimes" :key="index" class="relative">
                        <label :for="'feedingTime' + index" class="block text-sm font-medium text-gray-700 mb-2">
                          <span class="flex items-center space-x-2">
                            <span class="bg-emerald-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">
                              {{ index + 1 }}
                            </span>
                            <span>Feeding Time {{ index + 1 }}</span>
                          </span>
                        </label>
                        <div class="relative">
                          <input 
                            type="time" 
                            :id="'feedingTime' + index" 
                            v-model="feedingTimes[index]" 
                            class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 text-lg font-medium"
                            :class="feedingTimes[index] ? 'border-emerald-300 bg-emerald-50' : ''"
                          />
                          <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div class="pt-6 border-t border-gray-200">
                    <button 
                      type="submit" 
                      :disabled="!hasValidTimes"
                      class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 disabled:from-gray-400 disabled:to-gray-500 disabled:cursor-not-allowed transform hover:scale-[1.02] disabled:hover:scale-100"
                    >
                      <span class="flex items-center justify-center space-x-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Save Feeding Schedule</span>
                      </span>
                    </button>
                  </div>
                </form>
              </div>
            </div>

            <!-- Success Message -->
            <div v-if="showSuccessMessage" class="fixed top-4 right-4 z-50 transform transition-all duration-300">
              <div class="bg-white rounded-2xl shadow-2xl border border-green-200 p-6 max-w-sm">
                <div class="flex items-center space-x-3">
                  <div class="bg-green-100 p-2 rounded-xl">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <div>
                    <h4 class="font-bold text-green-800">Success!</h4>
                    <p class="text-green-600 text-sm">Feeding schedule saved successfully!</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tips Card -->
            <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
              <div class="flex items-start space-x-3">
                <div class="bg-blue-100 p-2 rounded-xl">
                  <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                </div>
                <div>
                  <h4 class="font-bold text-blue-800 mb-2">Feeding Schedule Tips</h4>
                  <ul class="text-blue-700 space-y-1 text-sm">
                    <li>• Maintain consistent feeding times for better pig health</li>
                    <li>• Young pigs typically need 3-4 feedings per day</li>
                    <li>• Adult pigs usually do well with 2-3 feedings per day</li>
                    <li>• Space feedings evenly throughout the day</li>
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
  import { ref, reactive, onMounted, computed } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  const feedingFrequency = ref(0);
  const feedingTimes = reactive([]);
  const showSuccessMessage = ref(false);

  const hasValidTimes = computed(() => {
    return feedingTimes.length > 0 && feedingTimes.some(time => time && time.trim() !== '');
  });

  const formatTime = (timeString) => {
    if (!timeString) return '';
    const [hours, minutes] = timeString.split(':');
    const hour = parseInt(hours);
    const ampm = hour >= 12 ? 'PM' : 'AM';
    const displayHour = hour % 12 || 12;
    return `${displayHour}:${minutes} ${ampm}`;
  };

  const setFeedingFrequency = (num) => {
    feedingFrequency.value = num;
    updateFeedingTimes();
  };
  
  const fetchFeedingSchedule = async () => {
    try {
      const response = await fetch('/api/feedingschedule', {
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Ensure the token is sent with the request
        },
        credentials: 'include' // Ensure cookies are sent with the request
      });
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
      const data = await response.json();
      console.log(data);
    
      if (data) {
        feedingFrequency.value = data.frequency_of_feeding;
        updateFeedingTimes(data.feeding_times);
      }
    } catch (error) {
      console.error('Error fetching feeding schedule:', error);
    }
  };
  
  const updateFeedingTimes = (savedFeedingTimes = []) => {
    feedingTimes.length = 0;
    for (let i = 0; i < feedingFrequency.value; i++) {
      feedingTimes.push(savedFeedingTimes[i] || '');
    }
  };
  
  const submitForm = async () => {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch('/api/feedingschedule', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
          'Authorization': `Bearer ${localStorage.getItem('token')}` // Ensure the token is sent with the request
        },
        body: JSON.stringify({
          feeding_times: feedingTimes
        })
      });
  
      if (!response.ok) {
        const errorText = await response.text();
        console.error('Error response:', errorText);
        throw new Error('Network response was not ok');
      }
  
      const data = await response.json();
      console.log('Form submitted successfully:', data);
      showSuccessMessage.value = true;
      setTimeout(() => {
        showSuccessMessage.value = false;
      }, 3000); // Hide the success message after 3 seconds
      fetchFeedingSchedule(); // Re-fetch the feeding schedule to update the displayed times
    } catch (error) {
      console.error('Error submitting form:', error);
    }
  };
  
  onMounted(() => {
    fetchFeedingSchedule();
  });
  </script>
  
  <style>
  /* Add any necessary styles here */
  </style>