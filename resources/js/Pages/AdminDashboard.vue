<template>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
      </template>
  
      <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
              <div class="mt-8 text-2xl">
                Welcome to your Admin Dashboard!
              </div>
  
              <div class="mt-6 text-gray-500">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                  <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-2xl">{{ totalUsers }}</p>
                  </div>
                  <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Buyers</h3>
                    <p class="text-2xl">{{ totalBuyers }}</p>
                  </div>
                  <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Farmers</h3>
                    <p class="text-2xl">{{ totalFarmers }}</p>
                  </div>
                  <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">New Registrations (Last 7 Days)</h3>
                    <p class="text-2xl">{{ newRegistrations }}</p>
                  </div>
                  <div class="p-4 bg-gray-100 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Average Session Duration</h3>
                    <p class="text-2xl">{{ averageSessionDuration }} mins</p>
                  </div>
                </div>
              </div>
  
              <div class="mt-6">
                <h3 class="text-lg font-semibold">Login Trends</h3>
                <canvas id="loginTrendsChart"></canvas>
              </div>
  
              <div class="mt-6">
                <h3 class="text-lg font-semibold">New Registrations Trends</h3>
                <canvas id="registrationTrendsChart"></canvas>
              </div>
            </div>
          </div>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref, onMounted } from 'vue';
  import { usePage } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import Chart from 'chart.js/auto';
  
  const { props } = usePage();
  const totalUsers = ref(props.totalUsers);
  const totalBuyers = ref(props.totalBuyers);
  const totalFarmers = ref(props.totalFarmers);
  const newRegistrations = ref(props.newRegistrations);
  const averageSessionDuration = ref(props.averageSessionDuration);
  const loginTrends = ref(props.loginTrends);
  const registrationTrends = ref(props.registrationTrends);
  
  onMounted(() => {
    const loginCtx = document.getElementById('loginTrendsChart').getContext('2d');
    new Chart(loginCtx, {
      type: 'line',
      data: {
        labels: loginTrends.value.map(trend => `Month ${trend.month}`),
        datasets: [{
          label: 'Logins',
          data: loginTrends.value.map(trend => trend.logins),
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1,
          fill: false
        }]
      },
      options: {
        scales: {
          x: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Month'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Logins'
            }
          }
        }
      }
    });
  
    const registrationCtx = document.getElementById('registrationTrendsChart').getContext('2d');
    new Chart(registrationCtx, {
      type: 'line',
      data: {
        labels: registrationTrends.value.map(trend => `Month ${trend.month}`),
        datasets: [{
          label: 'Registrations',
          data: registrationTrends.value.map(trend => trend.registrations),
          borderColor: 'rgba(153, 102, 255, 1)',
          borderWidth: 1,
          fill: false
        }]
      },
      options: {
        scales: {
          x: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Month'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Registrations'
            }
          }
        }
      }
    });
  });
  </script>
  
  <style scoped>
  /* Add any necessary styles here */
  </style>