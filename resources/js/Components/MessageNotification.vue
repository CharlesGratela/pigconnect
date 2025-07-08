<template>
  <div>
    <!-- Toast Notification -->
    <div
      v-if="showToast"
      class="fixed top-4 right-4 bg-[#281c11] text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center space-x-3 animate-fade-in"
    >
      <svg
        class="w-6 h-6 text-[#c58a61]"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
        ></path>
      </svg>
      <span>{{ toastMessage }}</span>
      <button @click="showToast = false" class="text-white hover:text-[#c58a61]">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <!-- Message Notification Button -->
    <div class="relative">
      <button
        @click="toggleDropdown"
        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-[#281c11] hover:text-[#a7674d] focus:outline-none transition ease-in-out duration-150"
      >
        <svg
          class="w-5 h-5"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"
          ></path>
        </svg>
        <span v-if="unreadCount > 0" class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
          {{ unreadCount }}
        </span>
      </button>

      <!-- Dropdown Menu -->
      <div
        v-if="isOpen"
        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50"
      >
        <div class="px-4 py-2 border-b border-gray-200">
          <h3 class="text-sm font-semibold text-[#543434]">Messages</h3>
        </div>
        <div class="max-h-60 overflow-y-auto">
          <div v-if="notifications.length === 0" class="px-4 py-2 text-sm text-gray-500">
            No new messages
          </div>
          <template v-else>
            <div
              v-for="notification in notifications"
              :key="notification.id"
              class="px-4 py-2 hover:bg-gray-50 cursor-pointer"
              @click="markAsRead(notification)"
            >
              <div class="flex items-start">
                <div class="flex-1">
                  <p class="text-sm font-medium text-[#543434]">{{ notification.sender }}</p>
                  <p class="text-sm text-gray-500 truncate">{{ notification.message }}</p>
                  <p class="text-xs text-gray-400">{{ notification.time }}</p>
                </div>
                <div v-if="!notification.read" class="w-2 h-2 bg-blue-500 rounded-full"></div>
              </div>
            </div>
          </template>
        </div>
        <div class="px-4 py-2 border-t border-gray-200">
          <Link
            :href="route('chat.list')"
            class="text-sm text-[#c58a61] hover:text-[#a7674d] font-medium"
          >
            View all messages
          </Link>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, defineExpose } from 'vue';
import { Link, router } from '@inertiajs/vue3';

const isOpen = ref(false);
const notifications = ref([]);
const unreadCount = ref(0);
const showToast = ref(false);
const toastMessage = ref('');
const previousUnreadCount = ref(0);

const toggleDropdown = () => {
  isOpen.value = !isOpen.value;
};

const showNewMessageToast = (newNotifications) => {
  if (newNotifications.length > 0) {
    const latestMessage = newNotifications[0];
    toastMessage.value = `New message from ${latestMessage.sender}: ${latestMessage.message}`;
    showToast.value = true;
    
    // Auto-hide toast after 5 seconds
    setTimeout(() => {
      showToast.value = false;
    }, 5000);
  }
};

const fetchNotifications = async () => {
  try {
    console.log('Fetching notifications...');
    const response = await fetch('/api/messages/notifications', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
      },
    });
    
    if (response.ok) {
      const data = await response.json();
      console.log('Received notifications:', data);
      
      // Check if there are new unread messages
      if (data.unread_count > previousUnreadCount.value) {
        showNewMessageToast(data.notifications);
      }
      
      notifications.value = data.notifications;
      unreadCount.value = data.unread_count;
      previousUnreadCount.value = data.unread_count;
    } else {
      console.error('Failed to fetch notifications:', response.status);
    }
  } catch (error) {
    console.error('Error fetching notifications:', error);
  }
};

const markAsRead = async (notification) => {
  try {
    const response = await fetch(`/api/messages/${notification.id}/read`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
      },
    });
    
    if (response.ok) {
      notification.read = true;
      unreadCount.value = Math.max(0, unreadCount.value - 1);
      isOpen.value = false;
      router.visit(route('chat.index', { userId: notification.sender_id }));
    }
  } catch (error) {
    console.error('Error marking notification as read:', error);
  }
};

// Close dropdown when clicking outside
const handleClickOutside = (event) => {
  if (isOpen.value && !event.target.closest('.relative')) {
    isOpen.value = false;
  }
};

onMounted(() => {
  fetchNotifications();
  document.addEventListener('click', handleClickOutside);
});

onUnmounted(() => {
  document.removeEventListener('click', handleClickOutside);
});

// Expose the fetchNotifications method to parent components
defineExpose({
  fetchNotifications
});
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style> 