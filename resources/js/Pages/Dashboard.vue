<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center space-x-3">
                    <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">Welcome to PigConnect</h2>
                        <p class="text-emerald-100 mt-1">Your smart pig farming management platform</p>
                    </div>
                </div>
            </div>
        </template>

        <div class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Welcome Section -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
                    <div class="text-center">
                        <div class="bg-emerald-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">You're Successfully Logged In!</h3>
                        <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                            Welcome to PigConnect, your comprehensive platform for modern pig farming management. 
                            Get started by exploring our powerful features designed to optimize your farming operations.
                        </p>
                    </div>
                </div>

                <!-- Feature Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-emerald-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Analytics & Insights</h4>
                        <p class="text-gray-600">Track your farm performance with detailed analytics and actionable insights to improve productivity.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-blue-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Smart Scheduling</h4>
                        <p class="text-gray-600">Automate feeding schedules and manage breeding programs with intelligent timing systems.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-purple-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Connect & Trade</h4>
                        <p class="text-gray-600">Connect with buyers and sellers in your area to expand your network and business opportunities.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-yellow-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Financial Management</h4>
                        <p class="text-gray-600">Monitor expenses, track profits, and manage your farm's financial health with comprehensive tools.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-red-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Record Keeping</h4>
                        <p class="text-gray-600">Maintain detailed records of breeding, health, and production data for better farm management.</p>
                    </div>

                    <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                        <div class="bg-indigo-100 w-16 h-16 rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Location Services</h4>
                        <p class="text-gray-600">Use GPS and mapping features to optimize farm layout and connect with nearby partners.</p>
                    </div>
                </div>

                <!-- Getting Started Section -->
                <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-2xl p-8 border border-emerald-200">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold text-emerald-800 mb-4">Ready to Get Started?</h3>
                        <p class="text-emerald-700 mb-6 max-w-2xl mx-auto">
                            Explore the navigation menu to access all features. Whether you're managing livestock, 
                            tracking expenses, or connecting with buyers, PigConnect has everything you need.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="bg-white rounded-xl p-4 shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-emerald-100 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="font-semibold text-gray-800">Documentation</p>
                                        <p class="text-sm text-gray-600">Learn how to use all features</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white rounded-xl p-4 shadow-md">
                                <div class="flex items-center space-x-3">
                                    <div class="bg-blue-100 p-2 rounded-lg">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </div>
                                    <div class="text-left">
                                        <p class="font-semibold text-gray-800">Support</p>
                                        <p class="text-sm text-gray-600">Get help when you need it</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
