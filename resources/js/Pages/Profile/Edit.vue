<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import ProfilePicture from './Partials/ProfilePicture.vue';
import { Head, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const { props } = usePage();
const currentProfilePicture = props.auth.user.profile_picture;
const activeTab = ref('profile');

const tabs = [
    { id: 'profile', name: 'Profile Information', icon: 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z' },
    { id: 'security', name: 'Security', icon: 'M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z' },
    { id: 'account', name: 'Account Settings', icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' }
];
</script>

<template>
    <Head title="Profile Settings" />

    <AuthenticatedLayout>
        <template #header>
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold">Profile Settings</h2>
                            <p class="text-emerald-100 mt-1">Manage your account information and preferences</p>
                        </div>
                    </div>
                    <div class="hidden lg:flex items-center space-x-4 text-emerald-100">
                        <div class="text-right">
                            <p class="text-sm opacity-75">Welcome back,</p>
                            <p class="font-semibold">{{ $page.props.auth.user.name }}</p>
                        </div>
                        <div class="bg-white/20 h-12 w-12 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">{{ $page.props.auth.user.name.charAt(0).toUpperCase() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </template>

        <main class="py-8">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Profile Overview Stats -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-2xl p-6 border border-blue-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-blue-600 text-sm font-medium">Account Status</p>
                                <p class="text-blue-900 text-xl font-bold">Active</p>
                            </div>
                            <div class="bg-blue-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 rounded-2xl p-6 border border-emerald-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-emerald-600 text-sm font-medium">User Role</p>
                                <p class="text-emerald-900 text-xl font-bold capitalize">{{ $page.props.auth.user.role }}</p>
                            </div>
                            <div class="bg-emerald-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-2xl p-6 border border-purple-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-purple-600 text-sm font-medium">Security</p>
                                <p class="text-purple-900 text-xl font-bold">Protected</p>
                            </div>
                            <div class="bg-purple-600 p-3 rounded-xl">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Tabs -->
                <div class="bg-white rounded-2xl shadow-lg mb-8 border border-gray-100">
                    <div class="border-b border-gray-200">
                        <nav class="flex space-x-8 px-6">
                            <button
                                v-for="tab in tabs"
                                :key="tab.id"
                                @click="activeTab = tab.id"
                                :class="[
                                    'flex items-center space-x-2 py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200',
                                    activeTab === tab.id
                                        ? 'border-emerald-500 text-emerald-600'
                                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                                ]"
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tab.icon" />
                                </svg>
                                <span>{{ tab.name }}</span>
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Profile Information Tab -->
                        <div v-show="activeTab === 'profile'" class="space-y-8">
                            <div class="text-center">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Profile Information</h3>
                                <p class="text-gray-600">Update your personal information and profile picture</p>
                            </div>
                            
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                                <div class="lg:order-2">
                                    <ProfilePicture :initial-image="currentProfilePicture" />
                                </div>
                                <div class="lg:order-1">
                                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                                        <UpdateProfileInformationForm
                                            :must-verify-email="mustVerifyEmail"
                                            :status="status"
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Security Tab -->
                        <div v-show="activeTab === 'security'" class="space-y-8">
                            <div class="text-center">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Security Settings</h3>
                                <p class="text-gray-600">Keep your account secure by updating your password regularly</p>
                            </div>
                            
                            <div class="max-w-2xl mx-auto">
                                <div class="bg-gray-50 rounded-2xl p-6 border border-gray-200">
                                    <UpdatePasswordForm />
                                </div>
                            </div>
                        </div>

                        <!-- Account Settings Tab -->
                        <div v-show="activeTab === 'account'" class="space-y-8">
                            <div class="text-center">
                                <h3 class="text-2xl font-bold text-gray-800 mb-2">Account Settings</h3>
                                <p class="text-gray-600">Manage your account preferences and data</p>
                            </div>
                            
                            <div class="max-w-2xl mx-auto">
                                <div class="bg-red-50 rounded-2xl p-6 border border-red-200">
                                    <DeleteUserForm />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Tips -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
                    <div class="flex items-start space-x-3">
                        <div class="bg-blue-100 p-2 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-blue-800 mb-2">Profile Tips</h4>
                            <ul class="text-blue-700 space-y-1 text-sm">
                                <li>• Keep your profile information up to date for better service</li>
                                <li>• Use a strong, unique password to protect your account</li>
                                <li>• Enable two-factor authentication when available</li>
                                <li>• Regularly review your account settings and privacy preferences</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </AuthenticatedLayout>
</template>
