<template>
  <Head title="Farm Dashboard - PigConnect" />

  <AuthenticatedLayout>
    <!-- Page Header -->
    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 shadow-lg">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between">
          <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
            </div>
            <div>
              <h1 class="text-3xl font-bold text-white font-theme-heading">Farm Dashboard</h1>
              <p class="text-emerald-100 mt-1">Welcome back! Here's your farm overview for today</p>
            </div>
          </div>
          
          <!-- Report Generator Button -->
          <ReportGenerator
            v-if="analytics && expenses && pigs"
            :analytics="analytics"
            :expenses="expenses"
            :pigs="pigs"
            class="mt-4 md:mt-0 bg-white/10 hover:bg-white/20 text-white border border-white/30 px-6 py-3 rounded-xl font-semibold transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 backdrop-blur-sm"
          />
        </div>
      </div>
    </div>

    <!-- Main Dashboard Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
      
      <!-- Quick Stats Cards -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Pigs Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group">
          <div class="p-6 relative">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-emerald-400/20 to-emerald-600/20 rounded-full -translate-y-4 translate-x-4"></div>
            <div class="flex items-center justify-between mb-4">
              <div class="bg-emerald-100 p-3 rounded-xl group-hover:bg-emerald-200 transition-colors duration-300">
                <span class="text-3xl">🐷</span>
              </div>
              <div class="text-emerald-600 text-sm font-medium bg-emerald-50 px-3 py-1 rounded-full">Total</div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ analytics.totalPigs }}</h3>
            <p class="text-sm text-gray-600">Pigs in your farm</p>
            <div class="mt-4 h-1 bg-emerald-200 rounded-full overflow-hidden">
              <div class="h-full bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full animate-pulse"></div>
            </div>
          </div>
        </div>

        <!-- Average Weight Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group">
          <div class="p-6 relative">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-400/20 to-blue-600/20 rounded-full -translate-y-4 translate-x-4"></div>
            <div class="flex items-center justify-between mb-4">
              <div class="bg-blue-100 p-3 rounded-xl group-hover:bg-blue-200 transition-colors duration-300">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3" />
                </svg>
              </div>
              <div class="text-blue-600 text-sm font-medium bg-blue-50 px-3 py-1 rounded-full">Avg</div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ analytics.averageWeight?.toFixed(1) || 0 }} kg</h3>
            <p class="text-sm text-gray-600">Average weight</p>
            <div class="mt-4 h-1 bg-blue-200 rounded-full overflow-hidden">
              <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full" :style="`width: ${Math.min(analytics.averageWeight / 100 * 100, 100)}%`"></div>
            </div>
          </div>
        </div>

        <!-- Weather Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group">
          <div class="p-6 relative">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-orange-400/20 to-orange-600/20 rounded-full -translate-y-4 translate-x-4"></div>
            <div class="flex items-center justify-between mb-4">
              <div class="bg-orange-100 p-3 rounded-xl group-hover:bg-orange-200 transition-colors duration-300">
                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z" />
                </svg>
              </div>
              <div class="text-orange-600 text-sm font-medium bg-orange-50 px-3 py-1 rounded-full">Live</div>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ weather.temperature }}°C</h3>
            <p class="text-sm text-gray-600 capitalize">{{ weather.weather }}</p>
            <div class="mt-4 flex items-center space-x-2">
              <div class="h-2 w-2 bg-orange-400 rounded-full animate-pulse"></div>
              <span class="text-xs text-gray-500">Updated now</span>
            </div>
          </div>
        </div>

        <!-- Rating Card -->
        <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 overflow-hidden group">
          <div class="p-6 relative">
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-amber-400/20 to-amber-600/20 rounded-full -translate-y-4 translate-x-4"></div>
            <div class="flex items-center justify-between mb-4">
              <div class="bg-amber-100 p-3 rounded-xl group-hover:bg-amber-200 transition-colors duration-300">
                <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118l-3.388-2.46c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z"/>
                </svg>
              </div>
              <div class="text-amber-600 text-sm font-medium bg-amber-50 px-3 py-1 rounded-full">Quality</div>
            </div>
            <div class="flex items-center space-x-2 mb-1">
              <h3 class="text-2xl font-bold text-gray-800">{{ analytics.averageRating || 0 }}</h3>
              <div class="flex space-x-1">
                <svg v-for="star in 5" :key="star" class="w-4 h-4" :class="star <= (analytics.averageRating || 0) ? 'text-amber-400' : 'text-gray-300'" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118l-3.388-2.46c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z"/>
                </svg>
              </div>
            </div>
            <p class="text-sm text-gray-600">Average rating</p>
          </div>
        </div>
      </div>

      <!-- Vaccination Progress Card -->
      <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl shadow-xl p-8 text-white">
        <div class="flex items-center justify-between mb-6">
          <div class="flex items-center space-x-4">
            <div class="bg-white/20 p-4 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h2 class="text-2xl font-bold">Vaccination Progress</h2>
              <p class="text-emerald-100">Keep your herd healthy and protected</p>
            </div>
          </div>
          <div class="text-right">
            <div class="text-4xl font-bold">{{ analytics.percentageVaccinated || 0 }}%</div>
            <div class="text-sm text-emerald-100">Completed</div>
          </div>
        </div>
        
        <div class="relative">
          <div class="w-full bg-white/20 rounded-full h-6 overflow-hidden backdrop-blur-sm">
            <div 
              class="h-full bg-gradient-to-r from-green-400 to-green-300 rounded-full transition-all duration-1000 ease-out shadow-lg"
              :style="`width: ${analytics.percentageVaccinated || 0}%`"
            ></div>
          </div>
          <div class="absolute -top-1 bg-white text-emerald-600 px-3 py-1 rounded-full text-sm font-semibold shadow-lg transition-all duration-1000" 
               :style="`left: ${Math.max(0, Math.min(analytics.percentageVaccinated - 8, 88))}%`">
            {{ analytics.percentageVaccinated || 0 }}%
          </div>
        </div>
      </div>

      <!-- Charts Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Weight Trend Chart -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
          <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
              <div class="bg-emerald-500 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                </svg>
              </div>
              <div>
                <h3 class="text-xl font-bold text-gray-800">Weight Trend Analysis</h3>
                <p class="text-sm text-gray-600">Track your pigs' growth over time</p>
              </div>
            </div>
          </div>
          <div class="p-6">
            <div class="relative w-full chart-size">
              <canvas id="weightTrendChart" class="absolute inset-0 w-full h-full"></canvas>
            </div>
          </div>
        </div>

        <!-- Pig Status Distribution -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
          <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
            <div class="flex items-center space-x-3">
              <div class="bg-emerald-500 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-bold text-gray-800">Status Overview</h3>
                <p class="text-sm text-gray-600">Current herd distribution</p>
              </div>
            </div>
          </div>
          <div class="p-6">
            <div class="relative w-full chart-size-small">
              <canvas id="pigStatusChart" class="absolute inset-0 w-full h-full"></canvas>
            </div>
          </div>
        </div>
      </div>

      <!-- Expenses Chart -->
      <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gradient-to-r from-gray-50 to-gray-100 p-6 border-b border-gray-200">
          <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3">
              <div class="bg-emerald-500 p-3 rounded-xl">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                </svg>
              </div>
              <div>
                <h3 class="text-xl font-bold text-gray-800">Financial Overview</h3>
                <p class="text-sm text-gray-600">Track your farm expenses and spending patterns</p>
              </div>
            </div>
            <div class="text-right">
              <div class="text-2xl font-bold text-gray-800">₱{{ totalExpenses.toLocaleString() }}</div>
              <div class="text-sm text-gray-600">Total Expenses</div>
            </div>
          </div>
        </div>
        <div class="p-6">
          <div class="relative w-full chart-size">
            <canvas id="expensesChart" class="absolute inset-0 w-full h-full"></canvas>
          </div>
        </div>
      </div>

      <!-- Quick Actions Grid -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <Link :href="route('pig.information')" class="group bg-white hover:bg-emerald-50 border border-gray-200 hover:border-emerald-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
          <div class="flex items-center space-x-4">
            <div class="bg-emerald-100 group-hover:bg-emerald-200 p-4 rounded-xl transition-colors duration-300">
              <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800 group-hover:text-emerald-700 transition-colors">Add Pigs</h4>
              <p class="text-sm text-gray-600">Register new livestock</p>
            </div>
          </div>
        </Link>

        <Link :href="route('farmer.expenses')" class="group bg-white hover:bg-blue-50 border border-gray-200 hover:border-blue-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
          <div class="flex items-center space-x-4">
            <div class="bg-blue-100 group-hover:bg-blue-200 p-4 rounded-xl transition-colors duration-300">
              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800 group-hover:text-blue-700 transition-colors">Track Expenses</h4>
              <p class="text-sm text-gray-600">Monitor farm costs</p>
            </div>
          </div>
        </Link>

        <Link :href="route('farmer.feedingschedule')" class="group bg-white hover:bg-orange-50 border border-gray-200 hover:border-orange-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
          <div class="flex items-center space-x-4">
            <div class="bg-orange-100 group-hover:bg-orange-200 p-4 rounded-xl transition-colors duration-300">
              <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800 group-hover:text-orange-700 transition-colors">Feeding Schedule</h4>
              <p class="text-sm text-gray-600">Manage meal times</p>
            </div>
          </div>
        </Link>

        <Link :href="route('farmer.breedingrecord')" class="group bg-white hover:bg-purple-50 border border-gray-200 hover:border-purple-200 rounded-2xl p-6 transition-all duration-300 hover:shadow-lg">
          <div class="flex items-center space-x-4">
            <div class="bg-purple-100 group-hover:bg-purple-200 p-4 rounded-xl transition-colors duration-300">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
            </div>
            <div>
              <h4 class="font-semibold text-gray-800 group-hover:text-purple-700 transition-colors">Breeding Records</h4>
              <p class="text-sm text-gray-600">Track reproduction</p>
            </div>
          </div>
        </Link>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { ref, onMounted, computed } from 'vue';
import Chart from 'chart.js/auto';
import zoomPlugin from 'chartjs-plugin-zoom';
import 'chartjs-adapter-date-fns';
import ReportGenerator from '@/Components/ReportGenerator.vue';

Chart.register(zoomPlugin);

const analytics = ref({
  totalPigs: 0,
  averageWeight: 0,
  weightTrend: [],
  pigStatuses: [],
  expenses: [],
  averageRating: 0,
  percentageVaccinated: 0,
});

const weather = ref({
  temperature: 0,
  weather: '',
});

const expenses = ref([]);
const pigs = ref([]);

const totalExpenses = computed(() => {
  return expenses.value.reduce((sum, item) => sum + (item.total_amount || item.amount || 0), 0);
});

const fetchAnalytics = async () => {
  try {
    const response = await fetch('/api/analytics', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log('Analytics data:', data);
    analytics.value = data;
    renderWeightTrendChart(data.weightTrend);
    renderPigStatusChart(data.pigStatuses);
    renderExpensesChart(data.expenses);
  } catch (error) {
    console.error('Error fetching analytics:', error);
  }
};

const fetchExpenses = async () => {
  try {
    const response = await fetch('/api/expenses', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log('Expenses data:', data);
    expenses.value = data;
  } catch (error) {
    console.error('Error fetching expenses:', error);
  }
};

const fetchPigs = async () => {
  try {
    const response = await fetch('/api/pigs', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log('Pigs data:', data);
    pigs.value = data;
  } catch (error) {
    console.error('Error fetching pigs:', error);
  }
};

const fetchWeather = async () => {
  try {
    const response = await fetch('/api/weather', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`,
      },
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    weather.value = data;
  } catch (error) {
    console.error('Error fetching weather:', error);
  }
};

const renderWeightTrendChart = (weightTrend) => {
  const ctx = document.getElementById('weightTrendChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: weightTrend.map(item => item.date),
      datasets: [{
        label: 'Average Weight (kg)',
        data: weightTrend.map(item => item.average_weight),
        borderColor: '#10b981',
        backgroundColor: 'rgba(16, 185, 129, 0.1)',
        fill: true,
        tension: 0.4,
        pointRadius: 5,
        pointHoverRadius: 8,
        pointBackgroundColor: '#10b981',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 2,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1500,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { 
          display: true, 
          labels: { 
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          } 
        },
        tooltip: { 
          enabled: true, 
          mode: 'index', 
          intersect: false,
          backgroundColor: 'rgba(55, 65, 81, 0.9)',
          titleColor: '#ffffff',
          bodyColor: '#ffffff',
          borderColor: '#10b981',
          borderWidth: 1,
        }
      },
      scales: {
        x: {
          type: 'time',
          time: { unit: 'day' },
          ticks: { 
            color: '#6b7280',
            font: {
              size: 12
            }
          },
          grid: {
            color: 'rgba(107, 114, 128, 0.1)'
          }
        },
        y: {
          beginAtZero: true,
          ticks: { 
            color: '#6b7280',
            font: {
              size: 12
            }
          },
          grid: {
            color: 'rgba(107, 114, 128, 0.1)'
          }
        },
      },
    },
  });
};

const renderPigStatusChart = (pigStatuses) => {
  const ctx = document.getElementById('pigStatusChart').getContext('2d');
  new Chart(ctx, {
    type: 'doughnut',
    data: {
      labels: pigStatuses.map(item => item.status),
      datasets: [{
        data: pigStatuses.map(item => item.count),
        backgroundColor: [
          '#10b981', // emerald-500 - healthy
          '#f59e0b', // amber-500 - warning  
          '#ef4444', // red-500 - sick
          '#8b5cf6', // violet-500 - breeding
          '#06b6d4', // cyan-500 - sold
          '#6366f1', // indigo-500 - other
        ],
        borderWidth: 0,
        hoverOffset: 8,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        animateRotate: true,
        animateScale: true,
        duration: 1500,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { 
          display: true,
          position: 'bottom',
          labels: { 
            color: '#374151',
            padding: 15,
            font: {
              size: 12,
              weight: 'bold'
            }
          } 
        },
        tooltip: {
          backgroundColor: 'rgba(55, 65, 81, 0.9)',
          titleColor: '#ffffff',
          bodyColor: '#ffffff',
          borderColor: '#10b981',
          borderWidth: 1,
        }
      },
    },
  });
};

const renderExpensesChart = (expensesData) => {
  const ctx = document.getElementById('expensesChart').getContext('2d');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: expensesData.map(item => item.date),
      datasets: [{
        label: 'Expenses (₱)',
        data: expensesData.map(item => item.total_amount),
        backgroundColor: 'rgba(16, 185, 129, 0.8)',
        borderColor: '#10b981',
        borderWidth: 1,
        borderRadius: 8,
        borderSkipped: false,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1500,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { 
          display: true, 
          labels: { 
            color: '#374151',
            font: {
              size: 14,
              weight: 'bold'
            }
          } 
        },
        tooltip: {
          backgroundColor: 'rgba(55, 65, 81, 0.9)',
          titleColor: '#ffffff',
          bodyColor: '#ffffff',
          borderColor: '#10b981',
          borderWidth: 1,
          callbacks: {
            label: function(context) {
              return `₱${context.parsed.y.toLocaleString()}`;
            }
          }
        }
      },
      scales: {
        x: {
          ticks: { 
            color: '#6b7280',
            font: {
              size: 12
            }
          },
          grid: {
            color: 'rgba(107, 114, 128, 0.1)'
          }
        },
        y: {
          beginAtZero: true,
          ticks: { 
            color: '#6b7280',
            font: {
              size: 12
            },
            callback: function(value) {
              return '₱' + value.toLocaleString();
            }
          },
          grid: {
            color: 'rgba(107, 114, 128, 0.1)'
          }
        },
      },
    },
  });
};

onMounted(() => {
  fetchAnalytics();
  fetchWeather();
  fetchExpenses();
  fetchPigs();
});
</script>

<style scoped>
.chart-size {
  width: 100%;
  height: 16rem;
  min-height: 250px;
  position: relative;
}
.chart-size-small {
  width: 100%;
  height: 12rem;
  min-height: 180px;
  position: relative;
}
@media (min-width: 768px) {
  .chart-size {
    height: 20rem;
  }
  .chart-size-small {
    height: 14rem;
  }
}
</style>