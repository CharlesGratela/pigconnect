<template>
  <div>
    <!-- Enhanced Add Expense Button -->
    <button 
      @click="openModal" 
      class="flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium"
    >
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
      </svg>
      Add Expense
    </button>

    <!-- Enhanced Modal -->
    <transition name="modal" enter-active-class="duration-300 ease-out" enter-from-class="opacity-0" enter-to-class="opacity-100" leave-active-class="duration-200 ease-in" leave-from-class="opacity-100" leave-to-class="opacity-0">
      <div v-if="isOpen" class="fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <!-- Enhanced Backdrop -->
          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="closeModal"></div>

          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

          <!-- Enhanced Modal Content -->
          <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
            
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
              <div class="flex justify-between items-center">
                <h3 class="text-xl font-bold text-white flex items-center">
                  <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                  </svg>
                  Add New Expense
                </h3>
                <button @click="closeModal" class="text-emerald-200 hover:text-white transition-colors duration-200">
                  <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </div>
            </div>

            <!-- Modal Body -->
            <div class="bg-white px-6 py-6">
              <form @submit.prevent="submitExpenseForm" class="space-y-6">
                <!-- Expense Name Field -->
                <div>
                  <label for="expenseName" class="block text-sm font-medium text-gray-700 mb-2">
                    Expense Name
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                      </svg>
                    </div>
                    <input 
                      type="text" 
                      id="expenseName" 
                      v-model="expenseName" 
                      required
                      class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm"
                      placeholder="Enter expense name"
                    />
                  </div>
                </div>

                <!-- Cost Field -->
                <div>
                  <label for="expenseCost" class="block text-sm font-medium text-gray-700 mb-2">
                    Cost (₱)
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <span class="text-gray-400 text-sm font-medium">₱</span>
                    </div>
                    <input 
                      type="number" 
                      step="0.01"
                      id="expenseCost" 
                      v-model="expenseCost" 
                      required
                      class="block w-full pl-8 pr-3 py-3 border border-gray-200 rounded-lg leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm"
                      placeholder="0.00"
                    />
                  </div>
                </div>

                <!-- Date Field -->
                <div>
                  <label for="expenseDate" class="block text-sm font-medium text-gray-700 mb-2">
                    Date of Purchase
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                    </div>
                    <input 
                      type="date" 
                      id="expenseDate" 
                      v-model="expenseDate" 
                      required
                      class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm"
                    />
                  </div>
                </div>

                <!-- Type Field -->
                <div>
                  <label for="expenseType" class="block text-sm font-medium text-gray-700 mb-2">
                    Expense Type
                  </label>
                  <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                      </svg>
                    </div>
                    <select 
                      id="expenseType" 
                      v-model="expenseType" 
                      required
                      class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-lg leading-5 bg-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm appearance-none"
                    >
                      <option value="" disabled>Select expense type</option>
                      <option value="medication">Medication</option>
                      <option value="food">Food</option>
                      <option value="transportation">Transportation</option>
                      <option value="equipment">Equipment</option>
                      <option value="maintenance">Maintenance</option>
                      <option value="other">Other</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                      <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                      </svg>
                    </div>
                  </div>
                </div>
              </form>
            </div>

            <!-- Modal Footer -->
            <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 space-y-reverse sm:space-y-0">
              <button 
                @click="closeModal" 
                type="button" 
                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200"
              >
                Cancel
              </button>
              <button 
                @click="submitExpenseForm"
                type="submit" 
                :disabled="isSubmitting"
                :class="{ 'opacity-50 cursor-not-allowed': isSubmitting }"
                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200"
              >
                <svg v-if="isSubmitting" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ isSubmitting ? 'Adding...' : 'Add Expense' }}
              </button>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </div>
</template>

<script setup>
import { ref, defineEmits } from 'vue';

const isOpen = ref(false);
const isSubmitting = ref(false);
const expenseName = ref('');
const expenseCost = ref('');
const expenseDate = ref('');
const expenseType = ref('');

const emit = defineEmits(['expense-added']);

const openModal = () => {
  isOpen.value = true;
  // Set default date to today
  if (!expenseDate.value) {
    expenseDate.value = new Date().toISOString().split('T')[0];
  }
};

const closeModal = () => {
  isOpen.value = false;
  resetForm();
};

const resetForm = () => {
  expenseName.value = '';
  expenseCost.value = '';
  expenseDate.value = '';
  expenseType.value = '';
};

const submitExpenseForm = async () => {
  if (isSubmitting.value) return;
  
  // Basic validation
  if (!expenseName.value || !expenseCost.value || !expenseDate.value || !expenseType.value) {
    alert('Please fill in all fields');
    return;
  }

  isSubmitting.value = true;

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/expenses', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
      },
      body: JSON.stringify({
        name: expenseName.value,
        cost: parseFloat(expenseCost.value),
        date_of_purchase: expenseDate.value,
        type: expenseType.value,
      }),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Expense submitted successfully:', data);
    
    // Show success feedback
    // You could add a toast notification here
    
    closeModal();
    emit('expense-added'); // Emit event to notify parent component
    window.location.reload();
  } catch (error) {
    console.error('Error submitting expense:', error);
    alert('Failed to add expense. Please try again.');
  } finally {
    isSubmitting.value = false;
  }
};
</script>

<style scoped>
/* Modal transition styles */
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.3s ease;
}

.modal-enter-from,
.modal-leave-to {
  opacity: 0;
}

/* Custom scrollbar for modal content */
.modal-content::-webkit-scrollbar {
  width: 6px;
}

.modal-content::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.modal-content::-webkit-scrollbar-thumb {
  background: #10b981;
  border-radius: 3px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
  background: #059669;
}
</style>