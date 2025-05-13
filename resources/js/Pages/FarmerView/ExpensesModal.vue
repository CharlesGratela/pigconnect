<template>
  <div>
    <button @click="openModal" class="bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Add Expense</button>

    <transition name="modal">
      <div v-if="isOpen" class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
          <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-[#543434] opacity-75"></div>
          </div>

          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

          <div class="inline-block align-middle bg-white rounded-lg text-left lg:text-center overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="sm:flex sm:items-start">
                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                  <h3 class="text-lg leading-6 font-medium text-[#543434]" id="modal-title">Add Expense</h3>
                  <div class="mt-2">
                    <form @submit.prevent="submitExpenseForm">
                      <div class="mb-4">
                        <label for="expenseName" class="block text-sm font-medium text-[#543434]">Name</label>
                        <input type="text" id="expenseName" v-model="expenseName" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
                      </div>

                      <div class="mb-4">
                        <label for="expenseCost" class="block text-sm font-medium text-[#543434]">Cost</label>
                        <input type="number" id="expenseCost" v-model="expenseCost" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
                      </div>

                      <div class="mb-4">
                        <label for="expenseDate" class="block text-sm font-medium text-[#543434]">Date of Purchase</label>
                        <input type="date" id="expenseDate" v-model="expenseDate" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" />
                      </div>

                      <div class="mb-4">
                        <label for="expenseType" class="block text-sm font-medium text-[#543434]">Type</label>
                        <select id="expenseType" v-model="expenseType" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]">
                          <option value="medication">Medication</option>
                          <option value="food">Food</option>
                          <option value="transportation">Transportation</option>
                        </select>
                      </div>

                      <div class="mt-5 sm:mt-6">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#281c11] text-base font-medium text-white hover:bg-[#a7674d] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c58a61] sm:text-sm">Submit</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-[#c58a61] px-4 py-3 sm:px-6 sm:flex flex-row-reverse ">
              <button @click="closeModal" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-[#c59461] shadow-sm px-4 py-2 bg-white text-base font-medium text-[#543434] hover:bg-[#c59461] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#c58a61] sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
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
const expenseName = ref('');
const expenseCost = ref('');
const expenseDate = ref('');
const expenseType = ref('');

const emit = defineEmits(['expense-added']);

const openModal = () => {
  isOpen.value = true;
};

const closeModal = () => {
  isOpen.value = false;
};

const submitExpenseForm = async () => {
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
        cost: expenseCost.value,
        date_of_purchase: expenseDate.value,
        type: expenseType.value,
      }),
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Expense submitted successfully:', data);
    closeModal();

    emit('expense-added'); // Emit event to notify parent component
    window.location.reload();
  } catch (error) {
    console.error('Error submitting expense:', error);
  }
};
</script>

<style>
/* Add any necessary styles here */
</style>