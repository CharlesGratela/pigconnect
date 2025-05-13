<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Expenses</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-full md:w-[75%] px-4">
            <ExpenseModal @expense-added="fetchExpenses" />
            
            <!-- Expenses Table -->
            <div class="hidden md:block overflow-x-auto mt-4">
              <table class="min-w-full divide-y divide-[#c59461]">
                <thead class="bg-[#c58a61]">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-[#543434] uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-[#543434] uppercase tracking-wider">Cost</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-[#543434] uppercase tracking-wider">Date of Purchase</th>
                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-[#543434] uppercase tracking-wider">Type</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#c59461] text-center">
                  <tr v-for="expense in expenses" :key="expense.id">
                    <td class="px-6 py-4 whitespace-nowrap">{{ expense.name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ expense.cost }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ expense.date_of_purchase }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ expense.type }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Expenses Card View for Mobile -->
            <div class="block md:hidden mt-4 space-y-4">
              <div v-for="expense in expenses" :key="expense.id" class="bg-white p-4 rounded-lg shadow-md divide-y divide-[#c59461]">
                <div class="py-2">
                  <p class="text-sm font-medium text-[#543434]">Name: {{ expense.name }}</p>
                  <p class="text-sm font-medium text-[#543434]">Cost: {{ expense.cost }}</p>
                  <p class="text-sm font-medium text-[#543434]">Date of Purchase: {{ expense.date_of_purchase }}</p>
                  <p class="text-sm font-medium text-[#543434]">Type: {{ expense.type }}</p>
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