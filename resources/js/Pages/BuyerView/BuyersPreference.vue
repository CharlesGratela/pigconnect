<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Buyer Preferences</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-[75%] lg:w-[25%]">
            <form @submit.prevent="submitForm" class="place-content-center">
              <div class="mb-4">
                <label for="preferredWeight" class="block text-sm font-medium text-[#543434]">Preferred Weight</label>
                <input type="text" id="preferredWeight" v-model="preferredWeight" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
              </div>

              <div class="mb-4">
                <label for="ageOfPigs" class="block text-sm font-medium text-[#543434]">Age of Pigs</label>
                <select id="ageOfPigs" v-model="ageOfPigs" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]">
                  <option value="0-3 months">0 to 3 months (Piglets)</option>
                  <option value="3-6 months">3 to 6 months (Growers)</option>
                  <option value="6-8 months">6 to 8 months (Finishers)</option>
                  <option value="6 months and above">6 months and above (Breeding Stock)</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="priceRange" class="block text-sm font-medium text-[#543434]">Price Range</label>
                <input type="text" id="priceRange" v-model="priceRange" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
              </div>

              <div class="mb-4">
                <label for="preferNearby" class="block text-sm font-medium text-[#543434]">Prefer Nearby Location</label>
                <select id="preferNearby" v-model="preferNearby" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]">
                  <option value="1">Yes</option>
                  <option value="0">No</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="breed" class="block text-sm font-medium text-[#543434]">Preferred Breed</label>
                <input type="text" id="breed" v-model="breed" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
              </div>

              <button type="submit" class="w-full bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Submit</button>
            </form>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>

    <!-- Success Dialog -->
    <div v-if="showSuccessDialog" class="fixed inset-0 flex items-center justify-center z-50 bg-[#543434] bg-opacity-75">
      <div class="bg-white p-4 rounded-lg shadow-lg w-[80%] md:w-[40%]">
        <h3 class="text-xl font-bold text-[#543434] mb-2 text-center">Success</h3>
        <p class="text-[#543434] text-center">Buyer's preference has been saved successfully.</p>
        <div class="flex justify-center mt-4">
          <button @click="closeDialog" class="bg-[#281c11] text-white p-2 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Close</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const preferredWeight = ref('');
const ageOfPigs = ref('');
const priceRange = ref('');
const preferNearby = ref(0);
const breed = ref('');
const showSuccessDialog = ref(false);

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