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
            <div class="bg-green-600 h-10 w-10 rounded-lg flex items-center justify-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <span class="font-bold text-xl text-gray-800">PigConnect</span>
          </div>
          

          
          <div class="flex items-center space-x-3">
              <a v-if="canLogin" href="/login" class="px-4 py-2 text-green-600 hover:text-green-700 font-medium transition-colors">
                Login
              </a>
              <a v-if="canRegister" href="/register" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors">
                Register
              </a>
          </div>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-16 md:py-24">
      <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row items-center">
          <div class="md:w-1/2 md:pr-12 mb-10 md:mb-0">
            <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-medium mb-6">
              Smart Farming Solution
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
              Revolutionize Your Pig Farm Management
            </h1>
            <p class="text-xl text-gray-600 mb-8 leading-relaxed">
              PigConnect is a comprehensive web app designed for pig farmers, enabling seamless tracking of herd health, growth, and productivity.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4">
              <Link v-if="canRegister" :href="route('register')" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md transition-colors flex items-center justify-center">
                <span>Create an account</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
              </Link>
      
            </div>
            
            <div class="mt-10 flex items-center">
              <div class="flex -space-x-2 mr-4">
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=80&h=80&q=80" alt="User" class="h-10 w-10 rounded-full border-2 border-white" />
                <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=80&h=80&q=80" alt="User" class="h-10 w-10 rounded-full border-2 border-white" />
                <img src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=80&h=80&q=80" alt="User" class="h-10 w-10 rounded-full border-2 border-white" />
                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=80&h=80&q=80" alt="User" class="h-10 w-10 rounded-full border-2 border-white" />
                <div class="h-10 w-10 rounded-full border-2 border-white bg-green-100 flex items-center justify-center text-green-600 text-xs font-bold">
                  +98
                </div>
              </div>
              <div class="text-gray-600 text-sm">
                <span class="font-semibold text-gray-900">500+ farmers</span> are already using PigConnect
              </div>
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

    <!-- Features Section -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Everything You Need to Manage Your Farm</h2>
          <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            PigConnect provides all the tools you need to optimize your operations and stay connected to your herd.
          </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
          <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Inventory Management</h3>
            <p class="text-gray-600">Keep track of your entire herd with detailed records and automatic updates.</p>
          </div>
          
          <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Health Analytics</h3>
            <p class="text-gray-600">Monitor health metrics and receive alerts for potential issues before they become problems.</p>
          </div>
          
          <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Feeding Schedules</h3>
            <p class="text-gray-600">Optimize feeding times and quantities based on growth data and nutritional needs.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-16 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
          <div class="inline-block mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 24 24">
              <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
            </svg>
          </div>
          <blockquote class="text-2xl font-medium text-gray-900 mb-8">
            "PigConnect has transformed how we manage our farm. The health tracking alone has saved us thousands in potential losses."
          </blockquote>
          <div class="flex items-center justify-center">
            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Customer" class="h-12 w-12 rounded-full mr-4" />
            <div class="text-left">
              <div class="font-medium text-gray-900">John Smith</div>
              <div class="text-gray-600 text-sm">Smith Family Farms</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-green-600">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-white mb-6">Ready to Optimize Your Farm?</h2>
        <p class="text-xl text-green-100 mb-8 max-w-2xl mx-auto">
          Join hundreds of successful pig farmers who have transformed their operations with PigConnect.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <Link v-if="canRegister" :href="route('register')" class="px-8 py-3 bg-white text-green-600 font-medium rounded-md hover:bg-green-50 transition-colors">
            Get Started
          </Link>
          <a href="#contact" class="px-8 py-3 border border-white text-white font-medium rounded-md hover:bg-green-700 transition-colors">
            Contact Sales
          </a>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-12">
      <div class="container mx-auto px-4">
        <div class="grid md:grid-cols-4 gap-8">
          <div>
            <div class="flex items-center space-x-2 text-white mb-4">
              <div class="bg-green-600 h-8 w-8 rounded-md flex items-center justify-center">
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
            <h3 class="text-white font-medium mb-4">Product</h3>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">Features</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Pricing</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Integrations</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Updates</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-white font-medium mb-4">Company</h3>
            <ul class="space-y-2 text-sm">
              <li><a href="#" class="hover:text-white transition-colors">About</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Careers</a></li>
              <li><a href="#" class="hover:text-white transition-colors">Contact</a></li>
            </ul>
          </div>
          
          <div>
            <h3 class="text-white font-medium mb-4">Stay Updated</h3>
            <p class="text-sm mb-4">Subscribe to our newsletter for the latest updates and features.</p>
            <div class="flex">
              <input type="email" placeholder="Your email" class="px-4 py-2 bg-gray-800 text-white rounded-l-md focus:outline-none focus:ring-1 focus:ring-green-500 w-full" />
              <button class="px-4 py-2 bg-green-600 text-white rounded-r-md hover:bg-green-700 transition-colors">
                Subscribe
              </button>
            </div>
          </div>
        </div>
        
        <div class="border-t border-gray-800 mt-12 pt-8 flex flex-col md:flex-row justify-between items-center">
          <div class="text-sm mb-4 md:mb-0">
            &copy; {{ new Date().getFullYear() }} PigConnect. All rights reserved.
          </div>
          <div class="flex space-x-6">
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
              </svg>
            </a>
            <a href="#" class="text-gray-400 hover:text-white transition-colors">
              <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" />
              </svg>
            </a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<style scoped>
/* Add any custom styles here if needed */
</style>
