<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
              </svg>
            </div>
            <div>
              <h2 class="text-3xl font-bold">Expense Management</h2>
              <p class="text-emerald-100 mt-1">Track and manage your farm expenses efficiently</p>
            </div>
          </div>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Header Section with Action -->
          <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 space-y-4 md:space-y-0">
            <div>
              <h3 class="text-2xl font-bold text-gray-800">Financial Overview</h3>
              <p class="text-gray-600 mt-1">Monitor your spending patterns and expenses</p>
            </div>
            <ExpenseModal @expense-added="fetchExpenses" />
          </div>
          
          <!-- Expenses Statistics Cards -->
          <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Total Expenses</p>
                  <p class="text-3xl font-bold text-gray-800">₱{{ totalExpenses.toLocaleString() }}</p>
                </div>
                <div class="bg-emerald-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">This Month</p>
                  <p class="text-3xl font-bold text-gray-800">₱{{ monthlyExpenses.toLocaleString() }}</p>
                </div>
                <div class="bg-blue-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                </div>
              </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-sm font-medium text-gray-600">Total Records</p>
                  <p class="text-3xl font-bold text-gray-800">{{ expenses.length }}</p>
                </div>
                <div class="bg-purple-100 p-3 rounded-xl">
                  <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
            
          <!-- Expenses Table -->
          <div class="hidden md:block bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-600 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
                </div>
                Expense Records
              </h3>
              <p class="text-emerald-600 mt-1">Detailed breakdown of all your farm expenses</p>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                  <tr>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Cost</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Date of Purchase</th>
                    <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Type</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                  <tr v-for="expense in expenses" :key="expense.id" class="hover:bg-emerald-50 transition-all duration-200 group">
                    <td class="px-6 py-4 whitespace-nowrap">
                      <div class="font-medium text-gray-900 group-hover:text-emerald-700 transition-colors">{{ expense.name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                        ₱{{ expense.cost }}
                      </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ formatDate(expense.date_of_purchase) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                      <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium" :class="getTypeColor(expense.type)">
                        {{ expense.type }}
                      </span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Expenses Card View for Mobile -->
          <div class="block md:hidden space-y-6">
            <div v-for="expense in expenses" :key="expense.id" class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100 hover:shadow-xl transition-all duration-300">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-4 border-b border-gray-200">
                <h3 class="text-lg font-bold text-emerald-800">{{ expense.name }}</h3>
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium mt-2" :class="getTypeColor(expense.type)">
                  {{ expense.type }}
                </span>
              </div>
              <div class="p-4 space-y-3">
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium text-gray-600">Cost</span>
                  <span class="text-lg font-bold text-emerald-600">₱{{ expense.cost }}</span>
                </div>
                <div class="flex justify-between items-center">
                  <span class="text-sm font-medium text-gray-600">Date of Purchase</span>
                  <span class="text-sm text-gray-800">{{ formatDate(expense.date_of_purchase) }}</span>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Empty State -->
          <div v-if="expenses.length === 0" class="text-center py-12">
            <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
              <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
              <h3 class="text-lg font-medium text-gray-900 mb-2">No expenses recorded</h3>
              <p class="text-gray-600">Start tracking your farm expenses by adding your first expense record.</p>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import ExpenseModal from '@/Pages/FarmerView/ExpensesModal.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const expenses = ref([]);

const totalExpenses = computed(() => {
  return expenses.value.reduce((total, expense) => total + parseFloat(expense.cost || 0), 0);
});

const monthlyExpenses = computed(() => {
  const currentMonth = new Date().getMonth();
  const currentYear = new Date().getFullYear();
  
  return expenses.value
    .filter(expense => {
      const expenseDate = new Date(expense.date_of_purchase);
      return expenseDate.getMonth() === currentMonth && expenseDate.getFullYear() === currentYear;
    })
    .reduce((total, expense) => total + parseFloat(expense.cost || 0), 0);
});

const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleDateString('en-US', { 
    year: 'numeric', 
    month: 'short', 
    day: 'numeric' 
  });
};

const getTypeColor = (type) => {
  const colors = {
    'feed': 'bg-blue-100 text-blue-800',
    'medicine': 'bg-red-100 text-red-800',
    'equipment': 'bg-purple-100 text-purple-800',
    'maintenance': 'bg-yellow-100 text-yellow-800',
    'labor': 'bg-green-100 text-green-800',
    'default': 'bg-gray-100 text-gray-800'
  };
  return colors[type?.toLowerCase()] || colors.default;
};

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