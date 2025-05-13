<template>
    <div>
      <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-[#543434] leading-tight">Feeding Schedule</h2>
        </template>
        <main>
          <div class="flex justify-center">
            <div class="w-[75%]">
              <form @submit.prevent="submitForm" class="place-content-center">
                <div v-for="(time, index) in feedingTimes" :key="index" class="mb-4">
                  <label :for="'feedingTime' + index" class="block text-sm font-medium text-[#543434]">Feeding Time {{ index + 1 }}</label>
                  <input type="time" :id="'feedingTime' + index" v-model="feedingTimes[index]" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
                </div>
  
                <button type="submit" class="w-full bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Submit</button>
              </form>
              <div v-if="showSuccessMessage" class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg">
                Feeding schedule saved successfully!
              </div>
            </div>
          </div>
        </main>
      </AuthenticatedLayout>
    </div>
  </template>
  
  <script setup>
  import { ref, reactive, onMounted } from 'vue';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  const feedingFrequency = ref(0);
  const feedingTimes = reactive([]);
  const showSuccessMessage = ref(false);
  
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