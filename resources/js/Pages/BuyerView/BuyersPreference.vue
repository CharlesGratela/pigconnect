<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-black leading-tight">Buyer Preferences</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-[75%]">
            <form @submit.prevent="submitForm" class="place-content-center">
              <div class="mb-4">
                <label for="preferredWeight" class="block text-sm font-medium text-black">Preferred Weight</label>
                <input type="text" id="preferredWeight" v-model="preferredWeight" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500" />
              </div>

              <div class="mb-4">
                <label for="ageOfPigs" class="block text-sm font-medium text-black">Age of Pigs</label>
                <select id="ageOfPigs" v-model="ageOfPigs" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500">
                  <option value="0-3 months">0 to 3 months (Piglets)</option>
                  <option value="3-6 months">3 to 6 months (Growers)</option>
                  <option value="6-8 months">6 to 8 months (Finishers)</option>
                  <option value="6 months and above">6 months and above (Breeding Stock)</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="priceRange" class="block text-sm font-medium text-black">Price Range</label>
                <input type="text" id="priceRange" v-model="priceRange" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-black rounded-lg focus:ring-blue-500 focus:border-blue-500" />
              </div>

              <button type="submit" class="w-full bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300">Submit</button>
            </form>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>

    <!-- Success Dialog -->
    <div v-if="showSuccessDialog" class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75">
      <div class="bg-white p-4 rounded-lg shadow-lg w-[80%] md:w-[40%]">
        <h3 class="text-xl font-bold text-black mb-2 text-center">Success</h3>
        <p class="text-black text-center">Buyer's preference has been saved successfully.</p>
        <div class="flex justify-center mt-4">
          <button @click="closeDialog" class="bg-blue-500 text-white p-2 rounded-lg focus:ring-4 focus:ring-blue-300">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import axios from 'axios';

const preferredWeight = ref('');
const ageOfPigs = ref('');
const priceRange = ref('');
const showSuccessDialog = ref(false);

const fetchBuyerPreferences = async () => {
  try {
    const response = await axios.get('/api/buyers_preference', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    const data = response.data;
    console.log(data);

    if (data) {
      preferredWeight.value = data.preferred_weight;
      ageOfPigs.value = data.age_of_pigs;
      priceRange.value = data.price_range;
    }
  } catch (error) {
    console.error('Error fetching buyer preferences:', error);
  }
};

const submitForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await axios.post('/api/buyers_preference', {
      preferred_weight: preferredWeight.value,
      age_of_pigs: ageOfPigs.value,
      price_range: priceRange.value
    }, {
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });

    if (response.status !== 200) {
      throw new Error('Network response was not ok');
    }

    const data = response.data;
    console.log('Form submitted successfully:', data);
    // Show success dialog
    showSuccessDialog.value = true;
    // Re-fetch the buyer preferences to reflect the updated details
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