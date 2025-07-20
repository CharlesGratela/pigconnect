<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div>
              <h2 class="text-3xl font-bold">Breeding Records</h2>
              <p class="text-emerald-100 mt-1">Track and manage pig breeding activities</p>
            </div>
          </div>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Header Section with Action -->
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
            <div>
              <h3 class="text-2xl font-bold text-gray-800">Breeding Management</h3>
              <p class="text-gray-600 mt-1">Monitor breeding records and track expected farrowing dates</p>
            </div>
            <button 
              @click="openAddBreedingForm" 
              class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center space-x-2"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
              </svg>
              <span>Add Breeding Record</span>
            </button>
          </div>

          <!-- Breeding Statistics Cards -->
          <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Total Records</p>
                  <p class="text-3xl font-bold text-gray-800">{{ breedingRecords.length }}</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Active Sows</p>
                  <p class="text-3xl font-bold text-gray-800">{{ femalePigs.length }}</p>
                </div>
                <div class="bg-pink-100 p-3 rounded-xl">
                  <span class="text-2xl">🐷</span>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Active Boars</p>
                  <p class="text-3xl font-bold text-gray-800">{{ malePigs.length }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                  <span class="text-2xl">🐽</span>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Upcoming</p>
                  <p class="text-3xl font-bold text-gray-800">{{ upcomingFarrowings }}</p>
                </div>
                <div class="bg-yellow-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>

          <!-- Add Breeding Record Form Modal -->
          <div v-if="showAddBreedingForm" class="fixed inset-0 flex items-center justify-center z-50 p-4">
            <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="closeAddBreedingForm"></div>
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md relative z-10 max-h-[90vh] overflow-y-auto">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
                <div class="flex items-center justify-between">
                  <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                    <div class="bg-emerald-600 p-2 rounded-lg">
                      <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                      </svg>
                    </div>
                    Add Breeding Record
                  </h3>
                  <button @click="closeAddBreedingForm" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                  </button>
                </div>
              </div>
              
              <div class="p-6">
                <form @submit.prevent="addBreedingRecord" class="space-y-6">
                  <div>
                    <label for="sowId" class="block text-sm font-bold text-gray-700 mb-2">Sow (Female Pig)</label>
                    <div class="relative">
                      <select 
                        id="sowId" 
                        v-model="breedingForm.sow_id" 
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 appearance-none" 
                        required
                      >
                        <option value="">Select a sow...</option>
                        <option v-for="pig in femalePigs" :key="pig.pigId" :value="pig.pigId">{{ pig.pigId }}</option>
                      </select>
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  
                  <div>
                    <label for="boarId" class="block text-sm font-bold text-gray-700 mb-2">Boar (Male Pig)</label>
                    <div class="relative">
                      <select 
                        id="boarId" 
                        v-model="breedingForm.boar_id" 
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 appearance-none" 
                        required
                      >
                        <option value="">Select a boar...</option>
                        <option v-for="pig in malePigs" :key="pig.pigId" :value="pig.pigId">{{ pig.pigId }}</option>
                      </select>
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                      </div>
                    </div>
                  </div>
                  
                  <div>
                    <label for="dateOfBreeding" class="block text-sm font-bold text-gray-700 mb-2">Date of Breeding</label>
                    <div class="relative">
                      <input 
                        type="date" 
                        id="dateOfBreeding" 
                        v-model="breedingForm.date_of_breeding" 
                        @change="computeExpectedFarrowingDate" 
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200" 
                        required
                      />
                    </div>
                  </div>
                  
                  <div>
                    <label for="expectedFarrowingDate" class="block text-sm font-bold text-gray-700 mb-2">Expected Farrowing Date</label>
                    <div class="relative">
                      <input 
                        type="date" 
                        id="expectedFarrowingDate" 
                        v-model="breedingForm.expected_farrowing_date" 
                        class="w-full px-4 py-3 bg-emerald-50 border-2 border-emerald-200 text-emerald-800 rounded-xl cursor-not-allowed" 
                        readonly
                      />
                      <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                      </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">Automatically calculated (114 days from breeding date)</p>
                  </div>
                  
                  <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]"
                  >
                    <span class="flex items-center justify-center space-x-2">
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                      <span>Add Breeding Record</span>
                    </span>
                  </button>
                </form>
              </div>
            </div>
          </div>

          <!-- Breeding Records Table -->
          <div class="hidden md:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-600 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
                Breeding Records
              </h3>
              <p class="text-emerald-600 mt-1">Comprehensive breeding history and tracking</p>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Sow ID</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Boar ID</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Date of Breeding</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Expected Farrowing</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                    <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <tr v-for="record in breedingRecords" :key="record.id" class="hover:bg-emerald-50 transition-all duration-200 group">
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-pink-100 text-pink-800">
                        {{ record.sow_id }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ record.boar_id }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">{{ formatDate(record.date_of_breeding) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center text-gray-600">{{ formatDate(record.expected_farrowing_date) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      <span :class="getStatusColor(record.expected_farrowing_date)" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                        {{ getStatus(record.expected_farrowing_date) }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-center">
                      <button 
                        @click="deleteBreedingRecord(record.id)" 
                        class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-50"
                      >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Mobile Card View -->
          <div class="block md:hidden space-y-6">
            <div v-for="record in breedingRecords" :key="record.id" class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                  <h3 class="text-lg font-bold text-emerald-800">Breeding Record</h3>
                  <span :class="getStatusColor(record.expected_farrowing_date)" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium">
                    {{ getStatus(record.expected_farrowing_date) }}
                  </span>
                </div>
              </div>
              <div class="p-4 space-y-3">
                <div class="grid grid-cols-2 gap-4">
                  <div>
                    <span class="text-sm font-medium text-gray-600">Sow ID</span>
                    <p class="text-pink-700 font-semibold">{{ record.sow_id }}</p>
                  </div>
                  <div>
                    <span class="text-sm font-medium text-gray-600">Boar ID</span>
                    <p class="text-blue-700 font-semibold">{{ record.boar_id }}</p>
                  </div>
                </div>
                <div class="grid grid-cols-1 gap-3">
                  <div>
                    <span class="text-sm font-medium text-gray-600">Breeding Date</span>
                    <p class="text-gray-800 font-semibold">{{ formatDate(record.date_of_breeding) }}</p>
                  </div>
                  <div>
                    <span class="text-sm font-medium text-gray-600">Expected Farrowing</span>
                    <p class="text-gray-800 font-semibold">{{ formatDate(record.expected_farrowing_date) }}</p>
                  </div>
                </div>
                <div class="pt-3 border-t border-gray-200">
                  <button 
                    @click="deleteBreedingRecord(record.id)" 
                    class="w-full bg-red-50 text-red-600 px-4 py-2 rounded-lg font-medium hover:bg-red-100 transition-colors flex items-center justify-center space-x-2"
                  >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                    <span>Delete Record</span>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="breedingRecords.length === 0" class="text-center py-12">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
              <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              <h3 class="text-lg font-medium text-gray-900 mb-2">No breeding records</h3>
              <p class="text-gray-600 mb-4">Start tracking your pig breeding by adding your first breeding record.</p>
              <button 
                @click="openAddBreedingForm" 
                class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
              >
                Add Your First Record
              </button>
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

const breedingRecords = ref([]);
const showAddBreedingForm = ref(false);
const breedingForm = reactive({
  sow_id: '',
  boar_id: '',
  date_of_breeding: '',
  expected_farrowing_date: ''
});
const malePigs = ref([]);
const femalePigs = ref([]);

const upcomingFarrowings = computed(() => {
  const today = new Date();
  const nextMonth = new Date(today);
  nextMonth.setMonth(today.getMonth() + 1);
  
  return breedingRecords.value.filter(record => {
    const farrowingDate = new Date(record.expected_farrowing_date);
    return farrowingDate >= today && farrowingDate <= nextMonth;
  }).length;
});

const formatDate = (dateString) => {
  if (!dateString) return '';
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric' 
  });
};

const getStatus = (farrowingDate) => {
  const today = new Date();
  const farrowing = new Date(farrowingDate);
  const daysUntil = Math.ceil((farrowing - today) / (1000 * 60 * 60 * 24));
  
  if (daysUntil < 0) return 'Overdue';
  if (daysUntil === 0) return 'Due Today';
  if (daysUntil <= 7) return 'Due Soon';
  if (daysUntil <= 30) return 'This Month';
  return 'Upcoming';
};

const getStatusColor = (farrowingDate) => {
  const status = getStatus(farrowingDate);
  const colors = {
    'Overdue': 'bg-red-100 text-red-800',
    'Due Today': 'bg-orange-100 text-orange-800',
    'Due Soon': 'bg-yellow-100 text-yellow-800',
    'This Month': 'bg-blue-100 text-blue-800',
    'Upcoming': 'bg-green-100 text-green-800'
  };
  return colors[status] || 'bg-gray-100 text-gray-800';
};

const fetchBreedingRecords = async () => {
  try {
    const response = await fetch('/api/breeding-records', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    breedingRecords.value = data;
  } catch (error) {
    console.error('Error fetching breeding records:', error);
  }
};

const fetchPigs = async () => {
  try {
    const response = await fetch('/api/pigs', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    malePigs.value = data.filter(pig => pig.gender === 'male');
    femalePigs.value = data.filter(pig => pig.gender === 'female');
  } catch (error) {
    console.error('Error fetching pigs:', error);
  }
};

const computeExpectedFarrowingDate = () => {
  const dateOfBreeding = new Date(breedingForm.date_of_breeding);
  const gestationPeriod = 114; // Gestation period for pigs in days
  const expectedFarrowingDate = new Date(dateOfBreeding);
  expectedFarrowingDate.setDate(dateOfBreeding.getDate() + gestationPeriod);
  breedingForm.expected_farrowing_date = expectedFarrowingDate.toISOString().split('T')[0];
};

const addBreedingRecord = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/breeding-records', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(breedingForm)
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    breedingRecords.value.push(data);
    closeAddBreedingForm();
  } catch (error) {
    console.error('Error adding breeding record:', error);
  }
};

const deleteBreedingRecord = async (id) => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    await fetch(`/api/breeding-records/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    breedingRecords.value = breedingRecords.value.filter(record => record.id !== id);
  } catch (error) {
    console.error('Error deleting breeding record:', error);
  }
};

const closeAddBreedingForm = () => {
  breedingForm.sow_id = '';
  breedingForm.boar_id = '';
  breedingForm.date_of_breeding = '';
  breedingForm.expected_farrowing_date = '';
  showAddBreedingForm.value = false;
};

const openAddBreedingForm = () => {
  showAddBreedingForm.value = true;
  fetchPigs();
};

onMounted(() => {
  fetchBreedingRecords();
});
</script>

<style scoped>
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