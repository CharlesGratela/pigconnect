<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <div>
              <h2 class="text-3xl font-bold">Farm Information</h2>
              <p class="text-emerald-100 mt-1">Configure your farm location and feeding preferences</p>
            </div>
          </div>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Farm Overview Card -->
          <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
              <div>
                <h3 class="text-2xl font-bold text-gray-800">Farm Setup</h3>
                <p class="text-gray-600 mt-1">Set your farm location and feeding configuration</p>
              </div>
              <div class="bg-emerald-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
              </div>
            </div>

            <!-- Current Information Display -->
            <div v-if="address" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
              <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl p-4">
                <div class="flex items-center space-x-3">
                  <div class="bg-emerald-600 text-white rounded-lg p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-emerald-800">Current Location</p>
                    <p class="text-emerald-900 font-semibold truncate">{{ address }}</p>
                  </div>
                </div>
              </div>
              
              <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-4">
                <div class="flex items-center space-x-3">
                  <div class="bg-blue-600 text-white rounded-lg p-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                  </div>
                  <div>
                    <p class="text-sm font-medium text-blue-800">Feeding Type</p>
                    <p class="text-blue-900 font-semibold">{{ feedingType || 'Not set' }}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Farm Configuration Form -->
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-600 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                  </svg>
                </div>
                Configure Farm Details
              </h3>
              <p class="text-emerald-600 mt-1">Update your farm location and feeding preferences</p>
            </div>

            <div class="p-6">
              <form @submit.prevent="submitForm" class="space-y-8">
                <!-- Location Section -->
                <div class="space-y-4">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <span>Farm Location</span>
                  </h4>
                  
                  <div class="bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-3">
                      Interactive Map (Drag marker to set exact location)
                    </label>
                    <div id="map" class="w-full rounded-lg shadow-md border border-gray-300"></div>
                  </div>

                  <div>
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Farm Address</label>
                    <div class="relative">
                      <input 
                        type="text" 
                        id="address" 
                        v-model="address" 
                        placeholder="Enter your farm address..."
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                      />
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Feeding Configuration Section -->
                <div class="space-y-4 border-t border-gray-200 pt-8">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                    </svg>
                    <span>Feeding Configuration</span>
                  </h4>

                  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                      <label for="feedingType" class="block text-sm font-bold text-gray-700 mb-2">Feeding Type</label>
                      <div class="relative">
                        <select 
                          id="feedingType" 
                          v-model="feedingType" 
                          class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 appearance-none"
                        >
                          <option value="">Select feeding type...</option>
                          <option value="feed">Commercial Feed</option>
                          <option value="natural">Natural Feeding</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                          </svg>
                        </div>
                      </div>
                    </div>

                    <div>
                      <label for="frequencyOfFeeding" class="block text-sm font-bold text-gray-700 mb-2">Feeding Frequency (times per day)</label>
                      <div class="relative">
                        <input 
                          type="number" 
                          id="frequencyOfFeeding" 
                          v-model="frequencyOfFeeding" 
                          min="1" 
                          max="10"
                          placeholder="e.g., 3"
                          class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                        />
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Submit Button -->
                <div class="pt-6 border-t border-gray-200">
                  <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-4 rounded-xl font-bold text-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]"
                  >
                    <span class="flex items-center justify-center space-x-2">
                      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                      </svg>
                      <span>Save Farm Information</span>
                    </span>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Tips Card -->
          <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-start space-x-3">
              <div class="bg-blue-100 p-2 rounded-xl">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h4 class="font-bold text-blue-800 mb-2">Farm Setup Tips</h4>
                <ul class="text-blue-700 space-y-1 text-sm">
                  <li>• Accurate location helps with weather monitoring and planning</li>
                  <li>• Commercial feed provides consistent nutrition</li>
                  <li>• Natural feeding can reduce costs but requires careful monitoring</li>
                  <li>• Adjust feeding frequency based on pig age and size</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted, watch } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const feedingType = ref('');
const frequencyOfFeeding = ref(0);
const location = reactive({
  lat: 14.5995, // Default to Philippines coordinates
  lng: 120.9842
});
const address = ref('');
const isMapLoaded = ref(false);

let map;
let marker;

const loadGoogleMapsScript = () => {
  return new Promise((resolve, reject) => {
    if (window.google && window.google.maps) {
      resolve();
      return;
    }

    const script = document.createElement('script');
    script.src = `https://maps.googleapis.com/maps/api/js?key=AIzaSyCL_IiN0vAn1y3Z_ZttsmYwi4R1fgXD1zU&libraries=places&loading=async`;
    script.async = true;
    script.defer = true;
    
    script.onload = () => {
      isMapLoaded.value = true;
      resolve();
    };
    script.onerror = reject;
    document.head.appendChild(script);
  });
};

const fetchFarmInformation = async () => {
  try {
    const response = await fetch('/api/pigfarminformation', {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log(data);
  
    if (data && data.latitude != null && data.longitude != null) {
      feedingType.value = data.feeding_type;
      frequencyOfFeeding.value = data.frequency_of_feeding;
      
      // Validate coordinates before setting
      const lat = parseFloat(data.latitude);
      const lng = parseFloat(data.longitude);
      
      if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
        location.lat = lat;
        location.lng = lng;

        // Update marker position only if coordinates are valid
        if (marker && map) {
          marker.setPosition({ lat: location.lat, lng: location.lng });
          map.setCenter({ lat: location.lat, lng: location.lng });
        }

        // Perform reverse geocoding to get the address
        await reverseGeocode(location.lat, location.lng);
      } else {
        console.warn('Invalid coordinates received from server:', data.latitude, data.longitude);
      }
    }
  } catch (error) {
    console.error('Error fetching farm information:', error);
  }
};

const reverseGeocode = async (lat, lng) => {
  // Validate coordinates before making API call
  if (isNaN(lat) || isNaN(lng) || lat === undefined || lng === undefined) {
    console.error('Invalid coordinates for reverse geocoding:', lat, lng);
    return;
  }

  const apiKey = 'AIzaSyCL_IiN0vAn1y3Z_ZttsmYwi4R1fgXD1zU';
  const url = `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=${apiKey}`;

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log('Reverse Geocoding Result:', data);
    if (data.results && data.results.length > 0) {
      address.value = data.results[0].formatted_address;
    }
  } catch (error) {
    console.error('Error performing reverse geocoding:', error);
  }
};

const geocodeAddress = async (address) => {
  if (!address || address.trim() === '') {
    console.warn('Empty address provided for geocoding');
    return;
  }

  const apiKey = 'AIzaSyCL_IiN0vAn1y3Z_ZttsmYwi4R1fgXD1zU';
  const url = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(address)}&key=${apiKey}`;

  try {
    const response = await fetch(url);
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    const data = await response.json();
    console.log('Geocoding Result:', data);
    
    if (data.results && data.results.length > 0) {
      const position = data.results[0].geometry.location;
      const lat = parseFloat(position.lat);
      const lng = parseFloat(position.lng);
      
      // Validate coordinates before setting
      if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
        location.lat = lat;
        location.lng = lng;

        // Update marker position only if map and marker are initialized
        if (marker && map) {
          marker.setPosition({ lat: location.lat, lng: location.lng });
          map.setCenter({ lat: location.lat, lng: location.lng });
        }
      } else {
        console.error('Invalid coordinates from geocoding:', position);
      }
    } else {
      console.warn('No geocoding results found for address:', address);
    }
  } catch (error) {
    console.error('Error performing geocoding:', error);
  }
};

const initMap = () => {
  // Validate coordinates before initializing map
  if (isNaN(location.lat) || isNaN(location.lng)) {
    console.warn('Invalid coordinates for map initialization, using default location');
    location.lat = 14.5995; // Default to Philippines coordinates
    location.lng = 120.9842;
  }

  try {
    map = new google.maps.Map(document.getElementById('map'), {
      center: { lat: location.lat, lng: location.lng },
      zoom: 13,
      mapTypeControl: true,
      streetViewControl: true,
      fullscreenControl: true
    });

    // Use the traditional marker (suppressing deprecation warning is handled by Google)
    marker = new google.maps.Marker({
      position: { lat: location.lat, lng: location.lng },
      map: map,
      draggable: true,
      title: 'Farm Location'
    });

    // Add marker drag event listener
    google.maps.event.addListener(marker, 'dragend', async function() {
      const position = marker.getPosition();
      const newLat = position.lat();
      const newLng = position.lng();
      
      // Validate new coordinates
      if (!isNaN(newLat) && !isNaN(newLng)) {
        location.lat = newLat;
        location.lng = newLng;
        map.setCenter({ lat: location.lat, lng: location.lng });
        await reverseGeocode(location.lat, location.lng);
      }
    });

    console.log('Google Maps initialized successfully');
  } catch (error) {
    console.error('Error initializing Google Maps:', error);
  }
};

const submitForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/pigfarminformation', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}` // Ensure the token is sent with the request
      },
      body: JSON.stringify({
        feedingType: feedingType.value,
        frequencyOfFeeding: frequencyOfFeeding.value,
        location: location,
        address: address.value // Include the address in the form submission
      })
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Form submitted successfully:', data);
    // Re-fetch the farm information to reflect the updated details
    await fetchFarmInformation();
    window.location.reload();
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};

onMounted(async () => {
  try {
    await loadGoogleMapsScript();
    await fetchFarmInformation();
    initMap();
  } catch (error) {
    console.error('Error loading Google Maps:', error);
  }
});

watch(address, async (newAddress) => {
  if (newAddress) {
    await geocodeAddress(newAddress);
  }
});
</script>

<style>
#map {
  height: 400px;
  width: 100%;
}
</style>