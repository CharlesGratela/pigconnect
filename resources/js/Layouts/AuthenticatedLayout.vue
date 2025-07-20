<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import MessageNotification from '@/Components/MessageNotification.vue';

const showingNavigationDropdown = ref(false);
const { props: pageProps } = usePage();

// Add notification polling
const pollNotifications = () => {
    const messageNotification = document.querySelector('message-notification');
    if (messageNotification) {
        messageNotification.fetchNotifications();
    }
};

onMounted(() => {
    // Start polling for notifications every 3 seconds
    const interval = setInterval(pollNotifications, 3000);
    
    onUnmounted(() => {
        clearInterval(interval);
    });
});
</script>

<template>
    <div class="min-h-screen bg-gray-50">
        <!-- Enhanced Navigation -->
        <nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <!-- Enhanced Logo -->
                        <div class="shrink-0 flex items-center">
                            <Link :href="dashboardRoute" class="flex items-center space-x-3 group">
                                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 p-2.5 rounded-xl shadow-lg group-hover:shadow-xl transition-all duration-300 group-hover:scale-105">
                                    <img src="/images/favicon.png" alt="PigConnect" class="h-6 w-6" />
                                </div>
                                <div class="hidden sm:block">
                                    <h1 class="text-xl font-bold text-gray-800 font-theme-heading">PigConnect</h1>
                                    <p class="text-xs text-emerald-600 font-medium">Smart Farm Management</p>
                                </div>
                            </Link>
                        </div>

                        <!-- Enhanced Navigation Links -->
                        <div class="hidden md:flex md:ml-8 md:space-x-2">
                            <!-- Dashboard Link -->
                            <Link :href="dashboardRoute" 
                                  :class="route().current(dashboardRoute) ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                  class="inline-flex items-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 14h8" />
                                </svg>
                                Dashboard
                            </Link>

                            <!-- Farmer Navigation -->
                            <template v-if="$page.props.auth.user.role == 'farmer'">
                                <Link :href="route('farmer.pigfarminformation')" 
                                      :class="route().current('farmer.pigfarminformation') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-4 py-2 border rounded-lg text-sm font-medium transition-all duration-200 whitespace-nowrap">
                                    <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Farm Info
                                </Link>
                                
                                <Link :href="route('pig.information')" 
                                      :class="route().current('pig.information') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l7-3 7 3z" />
                                    </svg>
                                    Livestock
                                </Link>
                                
                                <Link :href="route('farmer.expenses')" 
                                      :class="route().current('farmer.expenses') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                                    </svg>
                                    Expenses
                                </Link>
                                
                                <Link :href="route('farmer.breedingrecord')" 
                                      :class="route().current('farmer.breedingrecord') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Breeding
                                </Link>
                                
                                <Link :href="route('farmer.feedingschedule')" 
                                      :class="route().current('farmer.feedingschedule') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-3 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Schedule
                                </Link>
                            </template>

                            <!-- Admin Navigation -->
                            <template v-if="$page.props.auth.user.role == 'admin'">
                                <Link :href="route('admin.users')" 
                                      :class="route().current('admin.users') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-4 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                                    </svg>
                                    Users
                                </Link>
                            </template>

                            <!-- Buyer Navigation -->
                            <template v-if="$page.props.auth.user.role == 'buyer'">
                                <Link :href="route('buyer.preferences')" 
                                      :class="route().current('buyer.preferences') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-4 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    Preferences
                                </Link>
                                
                                <Link :href="route('buyer.information')" 
                                      :class="route().current('buyer.information') ? 'bg-emerald-50 text-emerald-700 border-emerald-200' : 'text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 border-transparent'"
                                      class="inline-flex items-center px-4 py-2 border rounded-lg text-sm font-medium transition-all duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    Profile
                                </Link>
                            </template>
                        </div>
                    </div>

                    <!-- Enhanced User Menu with MessageNotification nearby -->
                    <div class="hidden md:flex items-center space-x-4">
                        <!-- Message Notification positioned near profile -->
                        <div class="relative">
                            <MessageNotification />
                        </div>
                        
                        <!-- Enhanced User Menu -->
                        <div class="relative">
                            <Dropdown align="right" width="64">
                                <template #trigger>
                                    <button class="flex items-center space-x-3 p-2 rounded-xl hover:bg-gray-100 transition-all duration-200 group">
                                        <div class="flex items-center space-x-3">
                                            <!-- User Avatar -->
                                            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 h-9 w-9 rounded-lg flex items-center justify-center shadow-md group-hover:shadow-lg transition-all duration-200">
                                                <span class="text-white font-semibold text-sm">
                                                    {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                                                </span>
                                            </div>
                                            <!-- User Info -->
                                            <div class="hidden lg:block text-left">
                                                <p class="text-sm font-semibold text-gray-800">{{ $page.props.auth.user.name }}</p>
                                                <p class="text-xs text-emerald-600 capitalize font-medium">{{ $page.props.auth.user.role }}</p>
                                            </div>
                                            <!-- Chevron -->
                                            <svg class="w-4 h-4 text-gray-500 group-hover:text-emerald-600 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </div>
                                    </button>
                                </template>

                                <template #content>
                                    <div class="bg-white rounded-xl shadow-xl border border-gray-200 overflow-hidden">
                                        <!-- User Info Header -->
                                        <div class="px-4 py-3 bg-gradient-to-r from-emerald-50 to-emerald-100 border-b border-gray-200">
                                            <div class="flex items-center space-x-3">
                                                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 h-10 w-10 rounded-lg flex items-center justify-center shadow-md">
                                                    <span class="text-white font-semibold">
                                                        {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="font-semibold text-gray-800">{{ $page.props.auth.user.name }}</p>
                                                    <p class="text-sm text-emerald-600 capitalize">{{ $page.props.auth.user.role }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Menu Items -->
                                        <div class="py-1">
                                            <DropdownLink :href="route('profile.edit')" class="flex items-center px-4 py-3 text-sm text-gray-700 hover:bg-emerald-50 hover:text-emerald-700 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                </svg>
                                                My Profile
                                            </DropdownLink>
                                            
                                            <hr class="border-gray-200 my-1">
                                            
                                            <DropdownLink :href="route('logout')" method="post" as="button" class="w-full flex items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200">
                                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                                </svg>
                                                Sign Out
                                            </DropdownLink>
                                        </div>
                                    </div>
                                </template>
                            </Dropdown>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="md:hidden flex items-center">
                        <button
                            @click="showingNavigationDropdown = !showingNavigationDropdown"
                            class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:text-emerald-600 hover:bg-emerald-50 focus:outline-none focus:bg-emerald-50 focus:text-emerald-600 transition-all duration-200"
                        >
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path
                                    :class="{
                                        hidden: showingNavigationDropdown,
                                        'inline-flex': !showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"
                                />
                                <path
                                    :class="{
                                        hidden: !showingNavigationDropdown,
                                        'inline-flex': showingNavigationDropdown,
                                    }"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"
                                />
                            </svg>
                        </button>
                    </div>
            </div>

            <!-- Enhanced Mobile Navigation Menu -->
            <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }" class="md:hidden border-t border-emerald-200 bg-gradient-to-br from-white to-emerald-50 shadow-lg">
                <!-- Mobile User Info Header -->
                <div class="px-4 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 border-b border-emerald-300">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white bg-opacity-20 h-10 w-10 rounded-lg flex items-center justify-center shadow-md">
                            <span class="text-white font-semibold">
                                {{ $page.props.auth.user.name.charAt(0).toUpperCase() }}
                            </span>
                        </div>
                        <div>
                            <p class="text-white font-semibold">{{ $page.props.auth.user.name }}</p>
                            <p class="text-emerald-100 text-sm capitalize">{{ $page.props.auth.user.role }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="px-4 pt-4 pb-3 space-y-2">
                    <!-- Mobile Dashboard Link -->
                    <ResponsiveNavLink :href="dashboardRoute" :active="route().current(dashboardRoute)" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                        <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span class="font-medium text-gray-800">Dashboard</span>
                    </ResponsiveNavLink>

                    <!-- Mobile Farmer Links -->
                    <template v-if="$page.props.auth.user.role == 'farmer'">
                        <ResponsiveNavLink :href="route('farmer.pigfarminformation')" :active="route().current('farmer.pigfarminformation')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium text-gray-800">Farm Info</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('pig.information')" :active="route().current('pig.information')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l7-3 7 3z" />
                            </svg>
                            <span class="font-medium text-gray-800">Livestock</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('farmer.expenses')" :active="route().current('farmer.expenses')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9v-9m0-9v9" />
                            </svg>
                            <span class="font-medium text-gray-800">Expenses</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('farmer.breedingrecord')" :active="route().current('farmer.breedingrecord')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="font-medium text-gray-800">Breeding</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('farmer.feedingschedule')" :active="route().current('farmer.feedingschedule')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-medium text-gray-800">Schedule</span>
                        </ResponsiveNavLink>
                    </template>

                    <!-- Mobile Admin Links -->
                    <template v-if="$page.props.auth.user.role == 'admin'">
                        <ResponsiveNavLink :href="route('admin.users')" :active="route().current('admin.users')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                            <span class="font-medium text-gray-800">Users</span>
                        </ResponsiveNavLink>
                    </template>

                    <!-- Mobile Buyer Links -->
                    <template v-if="$page.props.auth.user.role == 'buyer'">
                        <ResponsiveNavLink :href="route('buyer.preferences')" :active="route().current('buyer.preferences')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-medium text-gray-800">Preferences</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('buyer.information')" :active="route().current('buyer.information')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium text-gray-800">Profile</span>
                        </ResponsiveNavLink>
                    </template>
                </div>

                <!-- Enhanced Mobile Footer Section -->
                <div class="border-t border-emerald-200 bg-gradient-to-r from-gray-50 to-emerald-50 px-4 py-4">
                    <div class="space-y-2">
                        <ResponsiveNavLink :href="route('profile.edit')" :active="route().current('profile.edit')" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-emerald-100">
                            <svg class="w-5 h-5 mr-3 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="font-medium text-gray-800">My Profile</span>
                        </ResponsiveNavLink>
                        
                        <ResponsiveNavLink :href="route('logout')" method="post" as="button" class="flex items-center px-3 py-3 rounded-lg transition-all duration-200 hover:bg-red-50 text-red-600 hover:text-red-700">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="font-medium">Sign Out</span>
                        </ResponsiveNavLink>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-1">
            <slot />
        </main>
    </div>
</template>

<script>
export default {
    computed: {
        // Define a computed property to determine the dashboard route based on the user's role
        redirectToPigFarmInformation() {
            return route('farmer.pigfarminformation');
        },

        dashboardRoute() {
            const role = this.$page.props.auth.user.role;
            if (role === 'farmer') {
                return route('farmer.dashboard');
            } else if (role === 'buyer') {
                return route('buyer.dashboard');
            } else if (role === 'admin') {
                return route('admin.dashboard');
            } else {
                // Default route if role is not defined
                return route('dashboard');
            }
        },
    },
};
</script>