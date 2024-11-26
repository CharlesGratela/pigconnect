<script setup>
import { ref } from 'vue';

import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import FarmerDashboard from '@/Pages/FarmerDashboard.vue';

const showingNavigationDropdown = ref(false);
const showingSidebar = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-[#F7B5CA] py-6 border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="dashboardRoute">
                                    <img src="/images/favicon.png" alt="Site Logo" class="h-10" />
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="text-black hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                                <NavLink :href="dashboardRoute" :active="route().current(dashboardRoute)">
                                    Dashboard
                                </NavLink>
                                <template v-if="$page.props.auth.user.role == 'farmer'">
                                    <NavLink :href="route('farmer.pigfarminformation')">
                                        Farm Information
                                    </NavLink>
                                    <NavLink :href="route('pig.information')">
                                        Pig Information
                                    </NavLink>
                                    <NavLink :href="route('farmer.expenses')">
                                        Expenses
                                    </NavLink>
                                    <NavLink :href="route('farmer.breedingrecord')">
                                        Breeding Record
                                    </NavLink>
                                </template>
                                <template v-if="$page.props.auth.user.role == 'buyer'">
                                    <NavLink :href="route('buyer.preferences')" :active="route().current('buyer.preferences')">
                                        Buyer Information
                                    </NavLink>
                                    <NavLink :href="dashboardRoute" :active="route().current(dashboardRoute)">
                                        Favorites
                                    </NavLink>
                                </template>
                                <NavLink :href="route('chat')" :active="route().current('chat')">
                                    Messages
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ms-6">
                            <!-- Settings Dropdown -->
                            <div class="ms-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-black bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ms-2 -me-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-me-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-black hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
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
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1 text-black">
                        <template v-if="$page.props.auth.user.role == 'farmer'">
                            <ResponsiveNavLink :href="dashboardRoute" :active="route().current(dashboardRoute)">
                                Home
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('farmer.pigfarminformation')" :active="route().current('farmer.pigfarminformation')">
                                Farm Information
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('pig.information')" :active="route().current('farmer.piginformation')">
                                Pig Information
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('farmer.expenses')" :active="route().current('farmer.expenses')">
                                Expenses
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('farmer.breedingrecord')" :active="route().current('farmer.breedingrecord')">
                                Breeding Record
                            </ResponsiveNavLink>
                        </template>
                        <template v-if="$page.props.auth.user.role == 'buyer'">
                            <ResponsiveNavLink :href="route('buyer.preferences')" :active="route().current('buyer.preferences')">
                                Buyer Information
                            </ResponsiveNavLink>
                            <ResponsiveNavLink :href="dashboardRoute" :active="route().current(dashboardRoute)">
                                Favorites
                            </ResponsiveNavLink>
                        </template>
                        <ResponsiveNavLink :href="route('chat')" :active="route().current('chat')">
                            Messages
                        </ResponsiveNavLink>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200 text-black">
                        <div class="px-4">
                            <div class="font-medium text-base text-black">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-black">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
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