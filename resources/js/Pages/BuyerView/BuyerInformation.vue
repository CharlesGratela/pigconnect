<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 text-white p-6 rounded-2xl shadow-lg">
          <div class="flex items-center space-x-3">
            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
              <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
              </svg>
            </div>
            <div>
              <h2 class="text-3xl font-bold">Buyer Information</h2>
              <p class="text-emerald-100 mt-1">Manage your profile and location preferences</p>
            </div>
          </div>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
          <!-- Profile Overview Card -->
          <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
            <div class="flex items-center justify-between mb-6">
              <div>
                <h3 class="text-2xl font-bold text-gray-800">Profile Setup</h3>
                <p class="text-gray-600 mt-1">Configure your location for better pig recommendations</p>
              </div>
              <div class="bg-emerald-100 p-3 rounded-xl">
                <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
              </div>
            </div>

            <!-- Current Information Display -->
            <div v-if="address" class="bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl p-4 mb-6">
              <div class="flex items-center space-x-3">
                <div class="bg-emerald-600 text-white rounded-lg p-2">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-sm font-medium text-emerald-800">Current Location</p>
                  <p class="text-emerald-900 font-semibold">{{ address }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Location Configuration Form -->
          <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100 p-6 border-b border-gray-200">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-600 p-2 rounded-lg">
                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  </svg>
                </div>
                Location Settings
              </h3>
              <p class="text-emerald-600 mt-1">Set your location to find nearby pig farms and get better recommendations</p>
            </div>

            <div class="p-6">
              <form @submit.prevent="submitForm" class="space-y-8">
                <!-- Location Section -->
                <div class="space-y-4">
                  <h4 class="text-lg font-bold text-gray-800 flex items-center space-x-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    </svg>
                    <span>Your Location</span>
                  </h4>
                  
                  <div class="bg-gray-50 rounded-xl p-4 border-2 border-gray-200">
                    <div class="flex items-center justify-between mb-3">
                      <label class="block text-sm font-medium text-gray-700">
                        Interactive Map (Drag marker to set your exact location)
                      </label>
                      
                      <!-- Location Controls -->
                      <div class="flex items-center space-x-3">
                        <!-- Auto-location button -->
                        <button 
                          type="button"
                          @click="autoFetchLocation"
                          :disabled="isLocationLoading"
                          class="inline-flex items-center px-3 py-2 text-xs font-medium rounded-lg border border-emerald-300 text-emerald-700 bg-emerald-50 hover:bg-emerald-100 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1 transition-colors duration-200 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                          <svg v-if="!isLocationLoading" class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                          </svg>
                          <svg v-else class="w-4 h-4 mr-1 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                          </svg>
                          {{ isLocationLoading ? 'Getting Location...' : 'Use My Location' }}
                        </button>
                      </div>
                    </div>
                    
                    <!-- Location Error Message -->
                    <div v-if="locationError" class="mb-3 p-3 bg-red-50 border border-red-200 rounded-lg">
                      <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm text-red-700">{{ locationError }}</p>
                      </div>
                    </div>
                    
                    <!-- Location Success Message -->
                    <div v-if="address && !isLocationLoading && !locationError" class="mb-3 p-3 bg-emerald-50 border border-emerald-200 rounded-lg">
                      <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <p class="text-sm text-emerald-700">Location updated successfully!</p>
                      </div>
                    </div>
                    
                    <div id="map" class="w-full rounded-lg shadow-md border border-gray-300"></div>
                  </div>

                  <div>
                    <label for="address" class="block text-sm font-bold text-gray-700 mb-2">Your Address</label>
                    <div class="relative">
                      <input 
                        type="text" 
                        id="address" 
                        v-model="address" 
                        placeholder="Enter your address..."
                        class="w-full px-4 py-3 bg-white border-2 border-gray-200 text-gray-800 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 pl-12"
                      />
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        </svg>
                      </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-1">This helps us show you nearby pig farms and relevant recommendations</p>
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
                      <span>Save Location Information</span>
                    </span>
                  </button>
                </div>
              </form>
            </div>
          </div>

          <!-- Benefits Card -->
          <div class="mt-8 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-200">
            <div class="flex items-start space-x-3">
              <div class="bg-blue-100 p-2 rounded-xl">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h4 class="font-bold text-blue-800 mb-2">Why Set Your Location?</h4>
                <ul class="text-blue-700 space-y-1 text-sm">
                  <li>• Find pig farms near your area</li>
                  <li>• Get personalized pig recommendations</li>
                  <li>• Reduce transportation costs and time</li>
                  <li>• Connect with local farmers in your region</li>
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

const location = reactive({
  lat: 14.5995, // Default to Philippines coordinates
  lng: 120.9842
});
const address = ref('');
const isLocationLoading = ref(false);
const locationError = ref('');

let map;
let marker;

// Function to get user's current location
const getCurrentLocation = () => {
  return new Promise((resolve, reject) => {
    if (!navigator.geolocation) {
      reject(new Error('Geolocation is not supported by this browser.'));
      return;
    }

    isLocationLoading.value = true;
    locationError.value = '';

    navigator.geolocation.getCurrentPosition(
      (position) => {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;
        
        console.log('User location obtained:', lat, lng);
        isLocationLoading.value = false;
        
        resolve({ lat, lng });
      },
      (error) => {
        isLocationLoading.value = false;
        let errorMessage = '';
        
        switch(error.code) {
          case error.PERMISSION_DENIED:
            errorMessage = "Location access denied by user.";
            break;
          case error.POSITION_UNAVAILABLE:
            errorMessage = "Location information is unavailable.";
            break;
          case error.TIMEOUT:
            errorMessage = "Location request timed out.";
            break;
          default:
            errorMessage = "An unknown error occurred while retrieving location.";
            break;
        }
        
        locationError.value = errorMessage;
        console.error('Geolocation error:', errorMessage);
        reject(new Error(errorMessage));
      },
      {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 60000
      }
    );
  });
};

const fetchBuyerInformation = async () => {
  try {
    const response = await fetch('/api/buyerinformation', {
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
      const lat = parseFloat(data.latitude);
      const lng = parseFloat(data.longitude);
      
      // Validate coordinates before setting
      if (!isNaN(lat) && !isNaN(lng) && lat >= -90 && lat <= 90 && lng >= -180 && lng <= 180) {
        location.lat = lat;
        location.lng = lng;

        if (marker && map) {
          marker.setPosition({ lat: location.lat, lng: location.lng });
          map.setCenter({ lat: location.lat, lng: location.lng });
        }

        await reverseGeocode(location.lat, location.lng);
      }
    } else {
      // If no saved location, try to get current location automatically
      console.log('No saved location found, attempting to get current location...');
      await autoFetchLocation();
    }
  } catch (error) {
    console.error('Error fetching buyer information:', error);
    // Fallback to auto-location if API fails
    await autoFetchLocation();
  }
};

// Auto-fetch user's current location
const autoFetchLocation = async () => {
  try {
    const currentLocation = await getCurrentLocation();
    location.lat = currentLocation.lat;
    location.lng = currentLocation.lng;
    
    // Update map if initialized
    if (marker && map) {
      marker.setPosition({ lat: location.lat, lng: location.lng });
      map.setCenter({ lat: location.lat, lng: location.lng });
    }
    
    // Get address for the current location
    await reverseGeocode(location.lat, location.lng);
    
    console.log('Auto-location successful:', currentLocation);
  } catch (error) {
    console.warn('Auto-location failed, using default location:', error.message);
    locationError.value = `Could not get your location: ${error.message}`;
  }
};

const reverseGeocode = async (lat, lng) => {
  // Validate coordinates before making API call
  if (isNaN(lat) || isNaN(lng) || lat === undefined || lng === undefined) {
    console.error('Invalid coordinates for reverse geocoding:', lat, lng);
    return;
  }

  const apiKey = 'AIzaSyC7qjUE5KQyJJkjvXGpsf-MeKVTbGXt490';
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

    marker = new google.maps.Marker({
      position: { lat: location.lat, lng: location.lng },
      map: map,
      draggable: true,
      title: 'Your Location'
    });

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
    const response = await fetch('api/buyerinformationstore', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify({
        location: location,
        address: address.value,
        latitude: location.lat,
        longitude: location.lng
      })
    });
    
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Form submitted successfully:', data);
    await fetchBuyerInformation();
    window.location.reload();
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};

onMounted(async () => {
  try {
    // Load Google Maps API first
    await loadGoogleMapsScript();
    
    // Initialize the map
    initMap();
    
    // Fetch buyer information (will auto-locate if no saved location)
    await fetchBuyerInformation();
  } catch (error) {
    console.error('Error during initialization:', error);
  }
});

// Google Maps script loading function
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
      resolve();
    };
    script.onerror = reject;
    document.head.appendChild(script);
  });
};

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