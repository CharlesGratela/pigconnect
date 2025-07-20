<template>
    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 -mx-6 -mt-6 px-6 pt-6 pb-8 rounded-b-2xl shadow-lg">
                <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
                    <svg class="w-8 h-8 mr-3 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-5l4 4-m-6 4a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Admin Dashboard
                </h2>
                <p class="text-emerald-100 mt-2">Monitor and manage your PigConnect platform</p>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="mb-8">
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center space-x-4">
                            <div class="bg-emerald-100 p-3 rounded-xl">
                                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800">Welcome to your Admin Dashboard!</h3>
                                <p class="text-gray-600 mt-1">Here's an overview of your platform's performance</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
                    <!-- Total Users Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-6 rounded-2xl border border-blue-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-600 text-sm font-medium uppercase tracking-wide">Total Users</p>
                                <p class="text-3xl font-bold text-blue-800 mt-2">{{ totalUsers }}</p>
                            </div>
                            <div class="bg-blue-200 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Buyers Card -->
                    <div class="bg-gradient-to-br from-emerald-50 to-green-100 p-6 rounded-2xl border border-emerald-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-600 text-sm font-medium uppercase tracking-wide">Total Buyers</p>
                                <p class="text-3xl font-bold text-emerald-800 mt-2">{{ totalBuyers }}</p>
                            </div>
                            <div class="bg-emerald-200 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Total Farmers Card -->
                    <div class="bg-gradient-to-br from-amber-50 to-yellow-100 p-6 rounded-2xl border border-amber-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-amber-600 text-sm font-medium uppercase tracking-wide">Total Farmers</p>
                                <p class="text-3xl font-bold text-amber-800 mt-2">{{ totalFarmers }}</p>
                            </div>
                            <div class="bg-amber-200 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- New Registrations Card -->
                    <div class="bg-gradient-to-br from-purple-50 to-violet-100 p-6 rounded-2xl border border-purple-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-600 text-sm font-medium uppercase tracking-wide">New Users (7d)</p>
                                <p class="text-3xl font-bold text-purple-800 mt-2">{{ newRegistrations }}</p>
                            </div>
                            <div class="bg-purple-200 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Session Duration Card -->
                    <div class="bg-gradient-to-br from-rose-50 to-pink-100 p-6 rounded-2xl border border-rose-200 shadow-lg hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-rose-600 text-sm font-medium uppercase tracking-wide">Avg Session</p>
                                <p class="text-3xl font-bold text-rose-800 mt-2">{{ averageSessionDuration }}<span class="text-lg">m</span></p>
                            </div>
                            <div class="bg-rose-200 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Login Trends Chart -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Login Trends</h3>
                                <p class="text-sm text-gray-600">Daily login activity over time</p>
                            </div>
                        </div>
                        <div class="relative">
                            <canvas id="loginTrendsChart" class="w-full h-64"></canvas>
                        </div>
                    </div>

                    <!-- Registration Trends Chart -->
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="bg-emerald-100 p-2 rounded-lg">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-800">Registration Trends</h3>
                                <p class="text-sm text-gray-600">New user registrations over time</p>
                            </div>
                        </div>
                        <div class="relative">
                            <canvas id="registrationTrendsChart" class="w-full h-64"></canvas>
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
          label: 'Daily Logins',
          data: loginTrends.value.map(trend => trend.logins),
          borderColor: 'rgb(59, 130, 246)',
          backgroundColor: 'rgba(59, 130, 246, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: 'rgb(59, 130, 246)',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 5
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'Month',
              color: '#6b7280',
              font: { weight: 'bold' }
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'Number of Logins',
              color: '#6b7280',
              font: { weight: 'bold' }
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
          label: 'New Registrations',
          data: registrationTrends.value.map(trend => trend.registrations),
          borderColor: 'rgb(16, 185, 129)',
          backgroundColor: 'rgba(16, 185, 129, 0.1)',
          borderWidth: 3,
          fill: true,
          tension: 0.4,
          pointBackgroundColor: 'rgb(16, 185, 129)',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 5
        }]
      },
      options: {
        responsive: true,
        plugins: {
          legend: {
            display: true,
            position: 'top',
          }
        },
        scales: {
          x: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'Month',
              color: '#6b7280',
              font: { weight: 'bold' }
            }
          },
          y: {
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            },
            title: {
              display: true,
              text: 'Number of Registrations',
              color: '#6b7280',
              font: { weight: 'bold' }
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