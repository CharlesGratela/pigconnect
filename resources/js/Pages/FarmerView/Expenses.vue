<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Expenses</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-full md:w-[75%] px-4">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-[#543434]">Expense Management</h2>
              <ExpenseModal @expense-added="fetchExpenses" />
            </div>
            
            <!-- Expenses Table -->
            <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden">
              <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-[#543434] flex items-center gap-2">
                  <svg class="w-5 h-5 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
                  Expense Records
                </h3>
              </div>
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cost</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Purchase</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="expense in expenses" :key="expense.id" class="hover:bg-gray-50 transition-colors duration-200">
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-[#543434]">{{ expense.name }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-[#543434]">₱{{ expense.cost }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-[#543434]">{{ expense.date_of_purchase }}</td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm text-[#543434]">{{ expense.type }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Expenses Card View for Mobile -->
            <div class="block md:hidden space-y-4">
              <div v-for="expense in expenses" :key="expense.id" class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                  <h3 class="text-lg font-semibold text-[#543434]">{{ expense.name }}</h3>
                  <span class="text-sm text-[#c58a61]">{{ expense.type }}</span>
                </div>
                <div class="p-4 space-y-2">
                  <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Cost</span>
                    <span class="text-sm text-[#543434]">₱{{ expense.cost }}</span>
                  </div>
                  <div class="flex justify-between items-center">
                    <span class="text-sm font-medium text-gray-500">Date of Purchase</span>
                    <span class="text-sm text-[#543434]">{{ expense.date_of_purchase }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import ExpenseModal from '@/Pages/FarmerView/ExpensesModal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const expenses = ref([]);

const fetchExpenses = async () => {
  try {
    const response = await fetch('/api/expenses', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
      },
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    expenses.value = data;
  } catch (error) {
    console.error('Error fetching expenses:', error);
  }
};

onMounted(() => {
  fetchExpenses();
});
</script>

<style scoped>
/* Add any necessary styles here */
</style>