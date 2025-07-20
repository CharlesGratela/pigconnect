<script setup>
import { ref } from 'vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
        default: true
    },
    canRegister: {
        type: Boolean,
        default: true
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

// For demo purposes - random heights for the chart bars
const chartBars = Array(12).fill(0).map(() => Math.floor(Math.random() * 100));
</script>

<template>
  <Head title="Welcome" />
  
  <div class="min-h-screen bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
      <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
          <div class="flex items-center space-x-2">
            <div class="bg-emerald-600 h-10 w-10 rounded-lg flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="font-bold text-xl text-gray-800">PigConnect</span>
          </div>
          
          <!-- Simplified navigation - removed Home, Features, Pricing, About -->
          <div class="hidden md:flex items-center space-x-8">
            <span class="text-gray-600">Smart Farm Management Solution</span>
          </div>
          
          <!-- Removed Login/Register buttons from navigation as they'll be in hero section -->
          <div class="flex items-center">
            <span class="text-sm text-gray-500">Revolutionize Your Farm</span>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-16 md:py-24">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
          <div class="md:w-1/2 md:pr-12 mb-10 md:mb-0">
            <div class="inline-block px-3 py-1 bg-emerald-100 text-emerald-600 rounded-full text-sm font-medium mb-6">
              Smart Farming Solution
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
              Revolutionize Your Pig Farm Management
            </h1>
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
              PigConnect is a comprehensive web app designed for pig farmers, enabling seamless tracking of herd health, growth, and productivity.
            </p>
            
            <!-- Updated CTA buttons - replaced Start Free Trial/Free Demo with Login/Register -->
            <div class="flex flex-col sm:flex-row gap-4">
              <Link v-if="canLogin" :href="route('login')" class="px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors flex items-center justify-center shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Login</span>
              </Link>
              <Link v-if="canRegister" :href="route('register')" class="px-8 py-4 border-2 border-emerald-600 text-emerald-600 hover:bg-emerald-600 hover:text-white font-semibold rounded-lg transition-colors flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Register</span>
              </Link>
            </div>
          </div>
          
          <div class="md:w-1/2 relative">
            <div class="relative">
              <img src="/images/farmerhero.png" alt="Farmer with pigs" class="rounded-2xl w-full h-auto">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
      <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-2 text-white mb-4">
              <div class="bg-emerald-600 h-8 w-8 rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <span class="font-bold text-lg">PigConnect</span>
            </div>
            <p class="text-sm">
              The comprehensive pig farm management solution that helps you optimize operations and increase productivity.
            </p>
          </div>
          
          <div>
            <h4 class="text-white font-semibold mb-4">Product</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Farm Management</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Health Tracking</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Analytics</a></li>
            </ul>
          </div>
          
          <div>
            <h4 class="text-white font-semibold mb-4">Support</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Documentation</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
            </ul>
          </div>
          
          <div>
            <h4 class="text-white font-semibold mb-4">Company</h4>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">About Us</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
            </ul>
          </div>
        </div>
        
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm">
          <p>&copy; 2024 PigConnect. All rights reserved.</p>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* Add any custom styles here if needed */
</style>
