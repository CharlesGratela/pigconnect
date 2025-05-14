<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Buyer Dashboard</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-full md:w-[75%]">
            <h3 class="text-lg font-semibold text-[#543434] mb-4">Recommended Pigs</h3>
            <div v-if="recommendedPigs.length === 0" class="text-center text-[#543434]">
              No recommendations available.
            </div>
            <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
              <div v-for="pig in recommendedPigs" :key="pig.pigId" class="p-4 bg-white rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                  <img :src="`/storage/${pig.image}`" alt="Pig Image" class="w-24 h-24 sm:w-28 sm:h-28 rounded-lg mr-4 object-cover">
                  <div>
                    <h3 class="text-lg font-semibold text-[#543434]">{{ pig.pigId }}</h3>
                    <button @click="showPigDetails(pig)" class="text-[#c58a61] hover:underline">View Details</button>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Breed:</span>
                  <span class="text-[#543434]"> {{ pig.breed }} per kilo</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Weight: </span>
                  <span class="text-[#543434]">{{ pig.weight }} kg.</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Age:</span>
                  <span class="text-[#543434]">{{ computeAgeInMonths(pig.date_of_birth) }} months</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Price Range:</span>
                  <span class="text-[#543434]">₱ {{ pig.price_per_kilo }} per kilo</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>

    <!-- Pig Details Modal -->
    <div v-if="showModal" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50">
      <div class="bg-white p-6 rounded-lg shadow-xl w-[95%] md:w-[80%] lg:w-[60%] max-h-[90vh] overflow-y-auto">
        <!-- Header with close button -->
        <div class="flex justify-between items-center mb-6">
          <h3 class="text-2xl font-bold text-[#543434]">Pig Details</h3>
          <button @click="closeModal" class="text-gray-500 hover:text-gray-700">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

        <!-- Main Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <!-- Left Column - Image and Basic Info -->
          <div class="space-y-4">
            <div class="aspect-square w-full overflow-hidden rounded-lg">
              <img :src="`/storage/${selectedPig.image}`" alt="Pig Image" class="w-full h-full object-cover">
            </div>
            
            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
              <div class="flex justify-between items-center">
                <span class="font-semibold text-[#543434]">Owner:</span>
                <span class="text-[#543434]">{{ selectedPig.owner }}</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-[#543434]">Breed:</span>
                <span class="text-[#543434]">{{ selectedPig.breed }}</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-[#543434]">Weight:</span>
                <span class="text-[#543434]">{{ selectedPig.weight }} kg</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-[#543434]">Age:</span>
                <span class="text-[#543434]">{{ computeAgeInMonths(selectedPig.date_of_birth) }} months</span>
              </div>
              <div class="flex justify-between items-center">
                <span class="font-semibold text-[#543434]">Price:</span>
                <span class="text-[#543434]">₱ {{ selectedPig.price_per_kilo }} per kilo</span>
              </div>
            </div>
          </div>

          <!-- Right Column - Location and Contact -->
          <div class="space-y-4">
            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="text-lg font-semibold text-[#543434] mb-2">Location</h4>
              <p class="text-[#543434] mb-4">{{ selectedPig.location }}</p>
              <div id="map" class="w-full h-48 rounded-lg"></div>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg">
              <h4 class="text-lg font-semibold text-[#543434] mb-2">Contact Seller</h4>
              <Link 
                :href="route('chat.index', { userId: farmUserId })" 
                :active="route('chat.index', { userId: farmUserId })" 
                class="inline-block w-full text-center bg-[#c58a61] text-white py-2 px-4 rounded-lg hover:bg-[#b37a51] transition-colors duration-200"
              >
                Message the Seller
              </Link>
            </div>
          </div>
        </div>

        <!-- Feedback Section -->
        <div class="mt-6 space-y-6">
          <!-- Existing Feedback -->
          <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-[#543434] mb-4">Feedback</h4>
            <div v-if="feedback.length === 0" class="text-center text-gray-500 py-4">
              No feedback available.
            </div>
            <div v-else class="space-y-3">
              <div v-for="item in feedback" :key="item.id" class="bg-white p-3 rounded-lg shadow-sm">
                <div class="flex justify-between items-center mb-2">
                  <span class="font-semibold text-[#543434]">{{ item.user.name }}</span>
                  <div class="flex items-center">
                    <span class="text-yellow-500 mr-1">★</span>
                    <span class="text-[#543434]">{{ item.rating }}/5</span>
                  </div>
                </div>
                <p class="text-[#543434]">{{ item.comment }}</p>
              </div>
            </div>
          </div>

          <!-- Add Feedback Form -->
          <div class="bg-gray-50 p-4 rounded-lg">
            <h4 class="text-lg font-semibold text-[#543434] mb-4">Add Feedback</h4>
            <form @submit.prevent="submitFeedback" class="space-y-4">
              <div>
                <label for="rating" class="block text-[#543434] mb-2">Rating:</label>
                <select 
                  id="rating" 
                  v-model="newFeedback.rating" 
                  class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c58a61] focus:border-[#c58a61]"
                >
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div>
                <label for="comment" class="block text-[#543434] mb-2">Comment:</label>
                <textarea 
                  id="comment" 
                  v-model="newFeedback.comment" 
                  rows="3"
                  class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#c58a61] focus:border-[#c58a61]"
                ></textarea>
              </div>
              <button 
                type="submit" 
                class="w-full bg-[#c58a61] text-white py-2 px-4 rounded-lg hover:bg-[#b37a51] transition-colors duration-200"
              >
                Submit Feedback
              </button>
            </form>
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