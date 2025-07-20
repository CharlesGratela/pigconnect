<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 -mx-6 -mt-6 px-6 pt-6 pb-8 rounded-b-2xl shadow-lg">
          <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
            <svg class="w-8 h-8 mr-3 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
            </svg>
            Buyer Dashboard
          </h2>
          <p class="text-emerald-100 mt-2">Discover quality pigs from trusted farmers</p>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Enhanced Header Section -->
          <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                  <div class="bg-emerald-100 p-3 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                    </svg>
                  </div>
                  <div>
                    <h3 class="text-xl font-bold text-gray-800">Recommended for You</h3>
                    <p class="text-gray-600">{{ recommendedPigs.length }} pigs match your preferences</p>
                  </div>
                </div>
                <div class="flex items-center space-x-2">
                  <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
                    {{ recommendedPigs.length }} available
                  </span>
                </div>
              </div>
            </div>
          </div>

          <!-- Pigs Grid -->
          <div v-if="recommendedPigs.length === 0" class="text-center py-16">
            <div class="bg-gray-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
              <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
              </svg>
            </div>
            <h3 class="text-lg font-medium text-gray-800 mb-2">No recommendations available</h3>
            <p class="text-gray-600">Set your preferences to get personalized pig recommendations.</p>
          </div>
          
          <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="pig in recommendedPigs" :key="pig.pigId" class="group bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
              <!-- Pig Image -->
              <div class="relative overflow-hidden">
                <img :src="`/storage/${pig.image}`" alt="Pig Image" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                <div class="absolute top-4 right-4">
                  <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">
                    Available
                  </span>
                </div>
              </div>
              
              <!-- Card Content -->
              <div class="p-6">
                <!-- Header -->
                <div class="flex items-center justify-between mb-4">
                  <h3 class="text-lg font-bold text-gray-800">{{ pig.pigId }}</h3>
                  <button @click="showPigDetails(pig)" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition-colors duration-200">
                    View Details →
                  </button>
                </div>
                
                <!-- Pig Details Grid -->
                <div class="space-y-3">
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Breed:</span>
                    <span class="text-sm text-gray-800 font-semibold">{{ pig.breed }}</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Weight:</span>
                    <span class="text-sm text-gray-800 font-semibold">{{ pig.weight }} kg</span>
                  </div>
                  <div class="flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-600">Age:</span>
                    <span class="text-sm text-gray-800 font-semibold">{{ computeAgeInMonths(pig.date_of_birth) }} months</span>
                  </div>
                  <div class="flex items-center justify-between pt-2 border-t border-gray-100">
                    <span class="text-sm font-medium text-gray-600">Price:</span>
                    <span class="text-lg font-bold text-emerald-600">₱{{ pig.price_per_kilo }}/kg</span>
                  </div>
                </div>
                
                <!-- Action Button -->
                <button @click="showPigDetails(pig)" class="w-full mt-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white font-medium py-2 px-4 rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 transform hover:scale-105">
                  View Full Details
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>

    <!-- Enhanced Pig Details Modal -->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-60 backdrop-blur-sm">
      <div class="bg-white rounded-2xl shadow-2xl w-[95%] md:w-[80%] lg:w-[60%] max-h-[90vh] overflow-hidden">
        <!-- Modal Header -->
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
          <div class="flex justify-between items-center">
            <h3 class="text-2xl font-bold text-white flex items-center">
              <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Pig Details
            </h3>
            <button @click="closeModal" class="text-emerald-200 hover:text-white transition-colors duration-200">
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
        </div>
        
        <!-- Modal Content -->
        <div class="p-6 max-h-[80vh] overflow-y-auto">
          <!-- Main Content Grid -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Column - Image and Basic Info -->
            <div class="space-y-4">
              <div class="aspect-square w-full overflow-hidden rounded-xl shadow-lg">
                <img :src="`/storage/${selectedPig.image}`" alt="Pig Image" class="w-full h-full object-cover">
              </div>
              
              <div class="bg-gradient-to-br from-emerald-50 to-green-50 p-4 rounded-xl border border-emerald-100">
                <h4 class="text-lg font-bold text-emerald-800 mb-3 flex items-center">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  Basic Information
                </h4>
                <div class="space-y-3">
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Owner:</span>
                    <span class="text-gray-800">{{ selectedPig.owner }}</span>
                  </div>
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Breed:</span>
                    <span class="text-gray-800">{{ selectedPig.breed }}</span>
                  </div>
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Weight:</span>
                    <span class="text-gray-800">{{ selectedPig.weight }} kg</span>
                  </div>
                  <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Age:</span>
                    <span class="text-gray-800">{{ computeAgeInMonths(selectedPig.date_of_birth) }} months</span>
                  </div>
                  <div class="flex justify-between items-center pt-2 border-t border-emerald-200">
                    <span class="font-semibold text-gray-700">Price:</span>
                    <span class="text-xl font-bold text-emerald-600">₱{{ selectedPig.price_per_kilo }}/kg</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Right Column - Location and Contact -->
            <div class="space-y-4">
              <div class="bg-gradient-to-br from-blue-50 to-indigo-50 p-4 rounded-xl border border-blue-100">
                <h4 class="text-lg font-bold text-blue-800 mb-3 flex items-center">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  </svg>
                  Location
                </h4>
                <p class="text-gray-700 mb-4">{{ selectedPig.location }}</p>
                <div id="map" class="w-full h-48 rounded-lg shadow-inner"></div>
              </div>

              <div class="bg-gradient-to-br from-emerald-50 to-green-50 p-4 rounded-xl border border-emerald-100">
                <h4 class="text-lg font-bold text-emerald-800 mb-3 flex items-center">
                  <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                  </svg>
                  Contact Seller
                </h4>
                <Link 
                  :href="route('chat.index', { userId: farmUserId })" 
                  :active="route('chat.index', { userId: farmUserId })" 
                  class="inline-block w-full text-center bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  Message the Seller
                </Link>
              </div>
            </div>
          </div>

          <!-- Feedback Section -->
          <div class="mt-6 space-y-6">
            <!-- Existing Feedback -->
            <div class="bg-gradient-to-br from-yellow-50 to-orange-50 p-4 rounded-xl border border-yellow-100">
              <h4 class="text-lg font-bold text-yellow-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                </svg>
                Customer Feedback
              </h4>
              <div v-if="feedback.length === 0" class="text-center text-gray-500 py-8">
                <div class="bg-gray-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3">
                  <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                  </svg>
                </div>
                <p>No feedback available yet.</p>
              </div>
              <div v-else class="space-y-3">
                <div v-for="item in feedback" :key="item.id" class="bg-white p-4 rounded-lg shadow-sm border border-gray-100">
                  <div class="flex justify-between items-center mb-2">
                    <span class="font-semibold text-gray-800">{{ item.user.name }}</span>
                    <div class="flex items-center">
                      <span class="text-yellow-500 mr-1">★</span>
                      <span class="text-gray-700 font-medium">{{ item.rating }}/5</span>
                    </div>
                  </div>
                  <p class="text-gray-600">{{ item.comment }}</p>
                </div>
              </div>
            </div>

            <!-- Add Feedback Form -->
            <div class="bg-gradient-to-br from-emerald-50 to-green-50 p-4 rounded-xl border border-emerald-100">
              <h4 class="text-lg font-bold text-emerald-800 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Your Feedback
              </h4>
              <form @submit.prevent="submitFeedback" class="space-y-4">
                <div>
                  <label for="rating" class="block text-gray-700 font-medium mb-2">Rating:</label>
                  <select 
                    id="rating" 
                    v-model="newFeedback.rating" 
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                  >
                    <option value="1">⭐ 1 Star</option>
                    <option value="2">⭐⭐ 2 Stars</option>
                    <option value="3">⭐⭐⭐ 3 Stars</option>
                    <option value="4">⭐⭐⭐⭐ 4 Stars</option>
                    <option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>
                  </select>
                </div>
                <div>
                  <label for="comment" class="block text-gray-700 font-medium mb-2">Comment:</label>
                  <textarea 
                    id="comment" 
                    v-model="newFeedback.comment" 
                    rows="3"
                    placeholder="Share your experience with this pig..."
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-colors duration-200"
                  ></textarea>
                </div>
                <button 
                  type="submit" 
                  class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white py-3 px-4 rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl transform hover:scale-105"
                >
                  Submit Feedback
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const recommendedPigs = ref([]);
const showModal = ref(false);
const selectedPig = ref(null);
const farmUserId = ref(null);
const feedback = ref([]);
const newFeedback = ref({
  rating: 5,
  comment: ''
});

const fetchRecommendations = async () => {
  try {
    const response = await fetch('/api/recommendations', {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    recommendedPigs.value = data.recommendations;
  } catch (error) {
    console.error('Error fetching recommendations:', error);
  }
};

const computeAgeInMonths = (dateOfBirth) => {
  const birthDate = new Date(dateOfBirth);
  const now = new Date();
  return (now.getFullYear() - birthDate.getFullYear()) * 12 + (now.getMonth() - birthDate.getMonth());
};

const showPigDetails = async (pig) => {
  selectedPig.value = pig;
  selectedPig.value.pigId = pig.pigId;
  selectedPig.value.price_per_kilo = pig.price_per_kilo;
  selectedPig.value.breed = pig.breed;
  showModal.value = true;
  farmUserId.value = pig.user_id;
  await fetchFarmDetails(pig.user_id);
  await fetchFeedback(pig.pigId);
  await trackInteraction(selectedPig.value.pigId);
};

const closeModal = () => {
  showModal.value = false;
};

const fetchFarmDetails = async (userId) => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/api/pigfarminformation/buyer?user_id=${userId}`, {
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const farmDetails = await response.json();
    selectedPig.value.id = farmDetails.id;
    selectedPig.value.owner = farmDetails.owner_name;

    selectedPig.value.location = farmDetails.location;
    const latitude = parseFloat(farmDetails.latitude);
    const longitude = parseFloat(farmDetails.longitude);
    if (isFinite(latitude) && isFinite(longitude)) {
      initMap(latitude, longitude);
    } else {
      console.error('Invalid latitude or longitude:', latitude, longitude);
      alert('Invalid location data');
    }
  } catch (error) {
    console.error('Error fetching farm details:', error);
    alert('Failed to fetch farm details');
  }
};

const fetchFeedback = async (pigId) => {
  try {
    const response = await fetch(`/api/pigs/${pigId}/feedback`, {
      headers: {
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      }
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    feedback.value = data;
  } catch (error) {
    console.error('Error fetching feedback:', error);
    alert('Failed to fetch feedback');
  }
};

const submitFeedback = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/api/pigs/${selectedPig.value.pigId}/feedback`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken
      },
      body: JSON.stringify({
        pig_id: selectedPig.value.pigId,
        comment: newFeedback.value.comment,
        rating: newFeedback.value.rating
      })
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    feedback.value.push(data);
    newFeedback.value.rating = 5;
    newFeedback.value.comment = '';
    fetchFeedback(selectedPig.value.pigId);
  } catch (error) {
    console.error('Error submitting feedback:', error);
    alert('Failed to submit feedback');
  }
};

const trackInteraction = async (pigId) => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/track_interaction', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify({ pig_id: pigId })
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    console.log('Interaction tracked successfully');
  } catch (error) {
    console.error('Error tracking interaction:', error);
  }
};

const initMap = (latitude, longitude) => {
  const map = new google.maps.Map(document.getElementById("map"), {
    center: { lat: latitude, lng: longitude },
    zoom: 15,
  });
  new google.maps.Marker({
    position: { lat: latitude, lng: longitude },
    map,
    title: "Pig Location",
  });
};

onMounted(() => {
  fetchRecommendations();
});
</script>

<style>
.modal {
  display: block;
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgb(0,0,0);
  background-color: rgba(0,0,0,0.4);
}
.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}
.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}
.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>