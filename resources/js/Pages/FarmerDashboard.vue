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

        <!-- Analytics Section -->
        <div class="mt-6 mb-4">
          <h3 class="text-lg font-semibold text-[#543434] mb-4">Analytics</h3>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
            <div class="bg-[#f0f4c3] p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Total Pigs</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.totalPigs }}</p>
            </div>
            <div class="bg-[#ffccbc] p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Average Weight</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.averageWeight.toFixed(2) }} kg</p>
            </div>
            <div class="bg-[#bbdefb] p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Current Weather</h4>
              <p class="text-lg text-[#543434]">Temperature: {{ weather.temperature }} °C</p>
              <p class="text-lg text-[#543434]">Status: {{ weather.weather }}</p>
            </div>
            <div class="bg-[#d1c4e9] p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Average Rating</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.averageRating }}</p>
            </div>
            <div class="bg-[#c8e6c9] p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Percentage of Pigs Vaccinated</h4>
              <p class="text-2xl font-bold text-[#543434]">{{ analytics.percentageVaccinated }}%</p>
            </div>
          </div>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Weight Trend</h4>
              <canvas id="weightTrendChart"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Pig Statuses</h4>
              <canvas id="pigStatusChart"></canvas>
            </div>
            <div class="bg-white p-4 rounded-lg shadow-md">
              <h4 class="text-md font-semibold text-[#543434]">Expenses</h4>
              <canvas id="expensesChart" ></canvas>
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

const renderWeightTrendChart = (weightTrend) => {
  console.log('Weight Trend Data:', weightTrend); // Log the weight trend data
  const ctx = document.getElementById('weightTrendChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: weightTrend.map(item => item.date),
      datasets: [{
        label: 'Average Weight (kg)',
        data: weightTrend.map(item => item.average_weight),
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        fill: true,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
    
      scales: {
        x: {
          type: 'time',
          time: {
            unit: 'day',
          },
        },
        y: {
          beginAtZero: true,
        },
      },
    },
  });
};

const renderPigStatusChart = (pigStatuses) => {
  console.log('Pig Status Data:', pigStatuses); // Log the pig status data
  const ctx = document.getElementById('pigStatusChart').getContext('2d');
  new Chart(ctx, {
    type: 'pie',
    data: {
      labels: pigStatuses.map(item => item.status),
      datasets: [{
        label: 'Pig Statuses',
        data: pigStatuses.map(item => item.count),
        backgroundColor: [
          '#FF6384',
          '#36A2EB',
          '#FFCE56',
          '#4BC0C0',
          '#9966FF',
          '#FF9F40',
        ],
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
    },
  });
};

const renderExpensesChart = (expenses) => {
  console.log('Expenses Data:', expenses); // Log the expenses data
  const ctx = document.getElementById('expensesChart').getContext('2d');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: expenses.map(item => item.date),
      datasets: [{
        label: 'Expenses',
        data: expenses.map(item => item.total_amount),
        borderColor: 'rgba(255, 99, 132, 1)',
        backgroundColor: 'rgba(255, 99, 132, 0.2)',
        fill: true,
      }],
    },
    options: {
      responsive: true,
      maintainAspectRatio: true,
    
      scales: {
        x: {
          type: 'time',
          time: {
            unit: 'day',
          },
        },
        y: {
          beginAtZero: true,
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
});
</script>

<style scoped>
.chart-size {
  width: 100%;
  height: 300px; /* Adjust the height as needed */
}
</style>