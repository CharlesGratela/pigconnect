<template>
  <AuthenticatedLayout>
    <template #header>
      <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
        <div class="flex items-center space-x-3">
          <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
          </div>
          <div>
            <h2 class="text-3xl font-bold">User Management</h2>
            <p class="text-emerald-100 mt-1">Monitor and manage system users efficiently</p>
          </div>
        </div>
      </div>
    </template>

    <div class="py-8">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
          <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Total Users</p>
                <p class="text-3xl font-bold text-gray-800">{{ users.length }}</p>
              </div>
              <div class="bg-emerald-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Farmers</p>
                <p class="text-3xl font-bold text-gray-800">{{ farmerCount }}</p>
              </div>
              <div class="bg-green-100 p-3 rounded-xl">
                <span class="text-2xl">🚜</span>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Buyers</p>
                <p class="text-3xl font-bold text-gray-800">{{ buyerCount }}</p>
              </div>
              <div class="bg-blue-100 p-3 rounded-xl">
                <span class="text-2xl">🛒</span>
              </div>
            </div>
          </div>
          
          <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 hover:shadow-xl transition-all duration-300">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-sm font-medium text-gray-600">Admins</p>
                <p class="text-3xl font-bold text-gray-800">{{ adminCount }}</p>
              </div>
              <div class="bg-purple-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
              </div>
            </div>
          </div>
        </div>

        <!-- Users Table -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
          <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
            <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
              <div class="bg-emerald-600 p-2 rounded-lg">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                </svg>
              </div>
              System Users
            </h3>
            <p class="text-emerald-600 mt-1">Manage all registered users in the system</p>
          </div>

          <!-- Desktop Table View -->
          <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">User</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Email</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Role</th>
                  <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                  <th scope="col" class="px-6 py-4 text-center text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-100">
                <tr v-for="user in users" :key="user.id" class="hover:bg-emerald-50 transition-all duration-200 group">
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center">
                          <span class="text-white font-bold text-sm">{{ getUserInitials(user.name) }}</span>
                        </div>
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900 group-hover:text-emerald-700 transition-colors">{{ user.name }}</div>
                        <div class="text-sm text-gray-500">ID: {{ user.id }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{ user.email }}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span :class="getRoleColor(user.role)" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium">
                      {{ getRoleIcon(user.role) }} {{ user.role }}
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                      Active
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                    <button 
                      @click="confirmDelete(user)" 
                      class="text-red-600 hover:text-red-800 transition-colors p-2 rounded-lg hover:bg-red-50"
                      :disabled="user.role === 'admin'"
                      :class="user.role === 'admin' ? 'opacity-50 cursor-not-allowed' : ''"
                    >
                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                      </svg>
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <!-- Mobile Card View -->
          <div class="block md:hidden space-y-4 p-4">
            <div v-for="user in users" :key="user.id" class="bg-gray-50 rounded-xl p-4 hover:bg-emerald-50 transition-all duration-200">
              <div class="flex items-center justify-between mb-3">
                <div class="flex items-center space-x-3">
                  <div class="h-10 w-10 rounded-full bg-gradient-to-r from-emerald-400 to-emerald-600 flex items-center justify-center">
                    <span class="text-white font-bold text-sm">{{ getUserInitials(user.name) }}</span>
                  </div>
                  <div>
                    <p class="font-medium text-gray-900">{{ user.name }}</p>
                    <p class="text-sm text-gray-500">{{ user.email }}</p>
                  </div>
                </div>
                <span :class="getRoleColor(user.role)" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium">
                  {{ getRoleIcon(user.role) }} {{ user.role }}
                </span>
              </div>
              <div class="flex justify-between items-center">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                  Active
                </span>
                <button 
                  @click="confirmDelete(user)" 
                  :disabled="user.role === 'admin'"
                  :class="user.role === 'admin' ? 'opacity-50 cursor-not-allowed' : 'hover:bg-red-100'"
                  class="text-red-600 p-2 rounded-lg transition-colors"
                >
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                  </svg>
                </button>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-if="users.length === 0" class="text-center py-12">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
            </svg>
            <h3 class="text-lg font-medium text-gray-900 mb-2">No users found</h3>
            <p class="text-gray-600">No users are currently registered in the system.</p>
          </div>
        </div>

        <!-- Confirmation Modal -->
        <div v-if="showDeleteModal" class="fixed inset-0 flex items-center justify-center z-50 p-4">
          <div class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm" @click="cancelDelete"></div>
          <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md relative z-10">
            <div class="p-6">
              <div class="flex items-center space-x-3 mb-4">
                <div class="bg-red-100 p-3 rounded-xl">
                  <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.268 15.5c-.77.833.192 2.5 1.732 2.5z" />
                  </svg>
                </div>
                <div>
                  <h3 class="text-lg font-bold text-gray-900">Confirm Deletion</h3>
                  <p class="text-gray-600">This action cannot be undone</p>
                </div>
              </div>
              
              <p class="text-gray-700 mb-6">
                Are you sure you want to delete user <strong>{{ userToDelete?.name }}</strong>? 
                This will permanently remove their account and all associated data.
              </p>
              
              <div class="flex space-x-3">
                <button 
                  @click="cancelDelete"
                  class="flex-1 bg-gray-100 text-gray-700 px-4 py-3 rounded-xl font-medium hover:bg-gray-200 transition-colors"
                >
                  Cancel
                </button>
                <button 
                  @click="deleteUser(userToDelete.id)"
                  class="flex-1 bg-red-600 text-white px-4 py-3 rounded-xl font-medium hover:bg-red-700 transition-colors"
                >
                  Delete User
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const { props } = usePage();
const users = ref(props.users);
const showDeleteModal = ref(false);
const userToDelete = ref(null);

const farmerCount = computed(() => {
  return users.value.filter(user => user.role === 'farmer').length;
});

const buyerCount = computed(() => {
  return users.value.filter(user => user.role === 'buyer').length;
});

const adminCount = computed(() => {
  return users.value.filter(user => user.role === 'admin').length;
});

const getUserInitials = (name) => {
  return name.split(' ').map(n => n[0]).join('').toUpperCase().slice(0, 2);
};

const getRoleColor = (role) => {
  const colors = {
    'farmer': 'bg-green-100 text-green-800',
    'buyer': 'bg-blue-100 text-blue-800',
    'admin': 'bg-purple-100 text-purple-800'
  };
  return colors[role] || 'bg-gray-100 text-gray-800';
};

const getRoleIcon = (role) => {
  const icons = {
    'farmer': '🚜',
    'buyer': '🛒',
    'admin': '👑'
  };
  return icons[role] || '👤';
};

const confirmDelete = (user) => {
  if (user.role === 'admin') return;
  userToDelete.value = user;
  showDeleteModal.value = true;
};

const cancelDelete = () => {
  showDeleteModal.value = false;
  userToDelete.value = null;
};

const deleteUser = async (userId) => {
  try {
    await $inertia.delete(`/admin/users/${userId}`);
    users.value = users.value.filter(user => user.id !== userId);
    showDeleteModal.value = false;
    userToDelete.value = null;
  } catch (error) {
    console.error('Error deleting user:', error);
  }
};
</script>

<style scoped>
/* Add any necessary styles here */
</style>