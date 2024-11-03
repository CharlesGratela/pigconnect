<template>
    <div>
      <AuthenticatedLayout>
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Buyer's Preferences</h2>
        </template>
        <main>
          <div class="flex justify-center">
            <div class="w-[75%]">
              <button @click="showModal = true" class="mb-4 bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Set Preferences</button>
  
              <!-- Add Preferences Modal -->
              <div v-if="showModal" class="modal">
                <div class="modal-content">
                  <span class="close" @click="closeModal">&times;</span>
                  <form @submit.prevent="submitPreferenceForm">
                    <div class="mb-4">
                      <label for="preferredWeight" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Preferred Weight</label>
                      <input type="text" id="preferredWeight" v-model="form.preferred_weight" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
  
                    <div class="mb-4">
                      <label for="ageOfPigs" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Age of Pigs</label>
                      <select id="ageOfPigs" v-model="form.age_of_pigs" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Weanlings (4-8 weeks old)">Weanlings (4-8 weeks old)</option>
                        <option value="Growers (2-4 months old)">Growers (2-4 months old)</option>
                        <option value="Market-ready (6 months and older)">Market-ready (6 months and older)</option>
                      </select>
                    </div>
  
                    <div class="mb-4">
                      <label for="priceRange" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Price Range</label>
                      <input type="text" id="priceRange" v-model="form.price_range" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                    </div>
  
                    <div class="mt-5 sm:mt-6">
                      <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-500 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Submit</button>
                    </div>
                  </form>
                </div>
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
  import axios from 'axios';
  
  const showModal = ref(false);
  const form = reactive({
    preferred_weight: '',
    age_of_pigs: '',
    price_range: '',
  });
  
  const openModal = () => {
    showModal.value = true;
    fetchPreferences();
  };
  
  const closeModal = () => {
    showModal.value = false;
  };
  
  const fetchPreferences = async () => {
    try {
      const response = await axios.get('/api/buyer/preferences');
      if (response.data) {
        form.preferred_weight = response.data.preferred_weight;
        form.age_of_pigs = response.data.age_of_pigs;
        form.price_range = response.data.price_range;
      }
    } catch (error) {
      console.error('Error fetching preferences:', error);
    }
  };
  
  const submitPreferenceForm = async () => {
    try {
      const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
      const response = await fetch('/api/buyer/preferences', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify(form),
      });
  
      if (!response.ok) {
        throw new Error('Network response was not ok');
      }
  
      const data = await response.json();
      console.log('Preferences submitted successfully:', data);
      closeModal();
    } catch (error) {
      console.error('Error submitting preferences:', error);
    }
  };
  
  onMounted(() => {
    fetchPreferences();
  });
  </script>
  
  <style>
  .modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
  }
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    color: #000;
  }
  .dark .modal-content {
    background-color: #333;
    color: #fff;
  }
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  </style>