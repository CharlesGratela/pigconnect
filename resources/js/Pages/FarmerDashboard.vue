<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-[#543434] leading-tight">Farmer Dashboard</h2>
    </template>

    <div class="flex">
      <!-- Sidebar -->

      <!-- Main Content -->
      <main class="flex-grow p-4">
        <!-- Report Generator -->
        <div class="mb-6 flex justify-end">
          <ReportGenerator
            v-if="analytics && expenses && pigs"
            :analytics="analytics"
            :expenses="expenses"
            :pigs="pigs"
          />
        </div>

        <!-- Analytics Section -->
        <div class="mt-6 mb-4">
          <h3 class="text-lg font-semibold text-[#543434] mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17a2.5 2.5 0 002.5-2.5V7.5A2.5 2.5 0 0011 5a2.5 2.5 0 00-2.5 2.5v7A2.5 2.5 0 0011 17z" /></svg>
            Analytics Overview
          </h3>
          <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-4">
            <div class="bg-[#A7FFEB] p-4 rounded-lg shadow-md flex flex-col items-center">
              <span class="text-3xl mb-2">🐖</span>
              <h4 class="text-md font-semibold text-[#543434]">Total Pigs</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.totalPigs }}</p>
            </div>
            <div class="bg-[#FFD180] p-4 rounded-lg shadow-md flex flex-col items-center">
              <span class="text-3xl mb-2">⚖️</span>
              <h4 class="text-md font-semibold text-[#543434]">Avg. Weight</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.averageWeight.toFixed(2) }} kg</p>
            </div>
            <div class="bg-[#81D4FA] p-4 rounded-lg shadow-md flex flex-col items-center">
              <span class="text-3xl mb-2">🌤️</span>
              <h4 class="text-md font-semibold text-[#543434]">Weather</h4>
              <p class="text-lg text-[#543434]">{{ weather.temperature }} °C</p>
              <p class="text-lg text-[#543434]">{{ weather.weather }}</p>
            </div>
            <div class="bg-[#FFD54F] p-4 rounded-lg shadow-md flex flex-col items-center">
              <span class="text-3xl mb-2">⭐</span>
              <h4 class="text-md font-semibold text-[#543434]">Avg. Rating</h4>
              <div class="flex items-center gap-1">
                <p class="text-2xl font-bold text-[#543434]">{{ analytics.averageRating }}</p>
                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.286 3.967a1 1 0 00.95.69h4.18c.969 0 1.371 1.24.588 1.81l-3.388 2.46a1 1 0 00-.364 1.118l1.287 3.966c.3.922-.755 1.688-1.54 1.118l-3.388-2.46a1 1 0 00-1.175 0l-3.388 2.46c-.784.57-1.838-.196-1.54-1.118l1.287-3.966a1 1 0 00-.364-1.118l-3.388-2.46c-.783-.57-.38-1.81.588-1.81h4.18a1 1 0 00.95-.69l1.286-3.967z"/></svg>
              </div>
            </div>
            <div class="bg-[#C5E1A5] p-4 rounded-lg shadow-md flex flex-col items-center">
              <span class="text-3xl mb-2">💉</span>
              <h4 class="text-md font-semibold text-[#543434]">% Vaccinated</h4>
              <div class="w-full bg-gray-200 rounded-full h-4 mb-2">
                <div class="bg-[#43a047] h-4 rounded-full transition-all duration-500" :style="`width: ${analytics.percentageVaccinated}%`"></div>
              </div>
              <p class="text-lg font-bold text-[#543434]">{{ analytics.percentageVaccinated }}%</p>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434] mb-2 flex items-center gap-2"><svg class="w-5 h-5 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 17v-2a4 4 0 014-4h10a4 4 0 014 4v2" /></svg>Weight Trend</h4>
              <div class="relative w-full chart-size">
                <canvas id="weightTrendChart" class="absolute inset-0 w-full h-full"></canvas>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434] mb-2 flex items-center gap-2"><svg class="w-5 h-5 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path d="M12 6v6l4 2" /></svg>Pig Statuses</h4>
              <div class="relative w-full chart-size">
                <canvas id="pigStatusChart" class="absolute inset-0 w-full h-full"></canvas>
              </div>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434] mb-2 flex items-center gap-2"><svg class="w-5 h-5 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3zm0 0V4m0 8v8m8-8a8 8 0 11-16 0 8 8 0 0116 0z" /></svg>Expenses</h4>
              <div class="relative w-full chart-size">
                <canvas id="expensesChart" class="absolute inset-0 w-full h-full"></canvas>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
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
    console.log('Analytics data:', data); // Log the response data
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
    console.log('Expenses data:', data); // Log the response data
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
    console.log('Pigs data:', data); // Log the response data
    pigs.value = data;
  } catch (error) {
    console.error('Error fetching pigs:', error);
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
        borderColor: '#26C6DA',
        backgroundColor: 'rgba(38, 198, 218, 0.2)',
        fill: true,
        tension: 0.4,
        pointRadius: 4,
        pointHoverRadius: 7,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1200,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { display: true, labels: { color: '#543434' } },
        tooltip: { enabled: true, mode: 'index', intersect: false }
      },
      scales: {
        x: {
          type: 'time',
          time: { unit: 'day' },
          ticks: { color: '#543434' }
        },
        y: {
          beginAtZero: true,
          ticks: { color: '#543434' }
        },
      },
    },
  });
};

const renderPigStatusChart = (pigStatuses) => {
  const ctx = document.getElementById('pigStatusChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: pigStatuses.map(item => item.status),
      datasets: [{
        label: 'Pig Statuses',
        data: pigStatuses.map(item => item.count),
        backgroundColor: [
          '#A7FFEB',
          '#FFD180',
          '#81D4FA',
          '#FFD54F',
          '#C5E1A5',
          '#FFAB91',
        ],
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        animateRotate: true,
        animateScale: true,
        duration: 1200,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { display: true, labels: { color: '#543434' } },
        tooltip: { enabled: true, mode: 'index', intersect: false }
      },
    },
  });
};

const renderExpensesChart = (expenses) => {
  const ctx = document.getElementById('expensesChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: expenses.map(item => item.date),
      datasets: [{
        label: 'Expenses',
        data: expenses.map(item => item.total_amount),
        borderColor: '#FF7043',
        backgroundColor: 'rgba(255, 112, 67, 0.2)',
        fill: true,
        tension: 0.4,
        pointRadius: 4,
        pointHoverRadius: 7,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      animation: {
        duration: 1200,
        easing: 'easeOutQuart'
      },
      plugins: {
        legend: { display: true, labels: { color: '#543434' } },
        tooltip: { enabled: true, mode: 'index', intersect: false }
      },
      scales: {
        x: {
          type: 'time',
          time: { unit: 'day' },
          ticks: { color: '#543434' }
        },
        y: {
          beginAtZero: true,
          ticks: { color: '#543434' }
        },
      },
    },
  });
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
@media (min-width: 768px) {
  .chart-size {
    height: 20rem;
  }
}
</style>