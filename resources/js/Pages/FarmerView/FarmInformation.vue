/**
 *
 * This Vue component represents the Farm Information page for the FarmerView.
 * It uses the `AuthenticatedLayout` for the layout and `@inertiajs/vue3` for page navigation.
 * The component integrates a map using the Leaflet library to allow users to select a location.
 * 
 * Data Properties:
 * - feedingType: Type of feeding (feed or natural).
 * - frequencyOfFeeding: Frequency of feeding.
 * - minPricePerKilo: Minimum price per kilo.
 * - maxPricePerKilo: Maximum price per kilo.
 * - location: Object containing latitude and longitude of the selected location.
 * 
 * Methods:
 * - initMap: Initializes the Leaflet map, sets up the tile layer, marker, and geocoder.
 * - submitForm: Handles form submission and logs the form data to the console.
 * 
 * Template:
 * - Displays a form with fields for location, feeding type, frequency of feeding, minimum price per kilo, and maximum price per kilo.
 * - The map is displayed in a div with id "map".
 * - The form submission is handled by the `submitForm` method.
 * 
 * Styles:
 * - The map div has a height of 400px and width of 100%.
 */
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
const location = ref('');
const feedingType = ref('feed');
const frequencyOfFeeding = ref('');
const minPricePerKilo = ref('');
const maxPricePerKilo = ref('');

</script>

<style>
#map {
  height: 400px;
  width: 100%;
}
</style>
<script>
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';
import 'leaflet-control-geocoder/dist/Control.Geocoder.css';
import 'leaflet-control-geocoder';

export default {
  data() {
    return {
      feedingType: '',
      frequencyOfFeeding: '',
      minPricePerKilo: '',
      maxPricePerKilo: '',
      location: {
        lat: 0,
        lng: 0
      }
    };
  },
  mounted() {
    this.initMap();
  },
  methods: {
    initMap() {
      const map = L.map('map').setView([51.505, -0.09], 13);

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      const marker = L.marker([51.505, -0.09], { draggable: true }).addTo(map);

      marker.on('dragend', (event) => {
        const position = marker.getLatLng();
        this.location.lat = position.lat;
        this.location.lng = position.lng;
      });

      const geocoder = L.Control.geocoder({
        defaultMarkGeocode: false
      })
        .on('markgeocode', (e) => {
          const bbox = e.geocode.bbox;
          const poly = L.polygon([
            bbox.getSouthEast(),
            bbox.getNorthEast(),
            bbox.getNorthWest(),
            bbox.getSouthWest()
          ]).addTo(map);
          map.fitBounds(poly.getBounds());
          marker.setLatLng(e.geocode.center);
          this.location.lat = e.geocode.center.lat;
          this.location.lng = e.geocode.center.lng;
        })
        .addTo(map);
    },
    submitForm() {
      // Handle form submission
      console.log('Form submitted with:', {
        feedingType: this.feedingType,
        frequencyOfFeeding: this.frequencyOfFeeding,
        minPricePerKilo: this.minPricePerKilo,
        maxPricePerKilo: this.maxPricePerKilo,
        location: this.location
      });
    }
  }
};
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>'    
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Farm Details</h2>
    </template>

    <div class="flex">
      <!-- Sidebar -->
   

      <!-- Main Content -->
      <main class="flex-grow p-4">
       

        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <form @submit.prevent="submitForm">
              <div class="mb-4">
                <label for="location" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Location</label>
                <div id="map" class="w-full h-64"></div>
              </div>

              <div class="mb-4">
                <label for="feedingType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feeding Type</label>
                <select id="feedingType" v-model="feedingType" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                  <option value="feed">Feed</option>
                  <option value="natural">Natural</option>
                </select>
              </div>

              <div class="mb-4">
                <label for="frequencyOfFeeding" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Frequency of Feeding</label>
                <input type="text" id="frequencyOfFeeding" v-model="frequencyOfFeeding" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
              </div>

              <div class="mb-4">
                <label for="minPricePerKilo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Minimum Price per Kilo</label>
                <input type="number" id="minPricePerKilo" v-model="minPricePerKilo" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
              </div>

              <div class="mb-4">
                <label for="maxPricePerKilo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Maximum Price per Kilo</label>
                <input type="number" id="maxPricePerKilo" v-model="maxPricePerKilo" class="mt-1 block w-full p-2.5 bg-gray-100 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400 dark:focus:ring-blue-500 dark:focus:border-blue-500" />
              </div>

              <button type="submit" class="w-full bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Submit</button>
            </form>
          </div>
        </div>
      </main>
    </div>
  </AuthenticatedLayout>
</template>
