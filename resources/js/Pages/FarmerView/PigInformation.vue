<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 -mx-6 -mt-6 px-6 pt-6 pb-8 rounded-b-2xl shadow-lg">
          <h2 class="font-bold text-2xl text-white leading-tight flex items-center">
            <span class="text-3xl mr-3">🐷</span>
            Livestock Management
          </h2>
          <p class="text-emerald-100 mt-2">Manage your pig inventory and track their information</p>
        </div>
      </template>
      <main class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
              <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                  <div class="bg-emerald-100 p-3 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                  </div>
                  <div>
                    <h2 class="text-2xl font-bold text-gray-800">Pig Inventory</h2>
                    <p class="text-gray-600">{{ pigs.length }} pigs in your farm</p>
                  </div>
                </div>
                <button 
                  @click="showModal = true" 
                  class="flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-6 py-3 rounded-xl hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105 font-medium"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Add New Pig
                </button>
              </div>
            </div>
          </div>
            
          <!-- Table View for Desktop -->
          <div class="hidden md:block bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
            <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-emerald-50 to-green-50">
              <h3 class="text-xl font-bold text-emerald-800 flex items-center gap-3">
                <div class="bg-emerald-100 p-2 rounded-lg">
                  <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                </div>
                Detailed Pig Inventory
              </h3>
              <p class="text-emerald-600 mt-1">Comprehensive view of all your livestock</p>
            
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Weight</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date of Birth</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gender</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Breed</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mark</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price per Kilo</th>
                      <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="pig in pigs" :key="pig.pigId" class="hover:bg-gray-50 transition-colors duration-200">
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-700">{{ pig.pigId }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">{{ pig.weight }} kg</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">{{ pig.date_of_birth }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700 capitalize">{{ pig.gender }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">{{ pig.breed }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <span :class="{
                          'px-2 inline-flex text-xs leading-5 font-semibold rounded-full': true,
                          'bg-green-100 text-green-800': pig.status === 'healthy',
                          'bg-red-100 text-red-800': pig.status === 'sick',
                          'bg-blue-100 text-blue-800': pig.status === 'sold',
                          'bg-gray-100 text-gray-800': pig.status === 'dead'
                        }">
                          {{ pig.status }}
                        </span>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <img 
                          :src="`/storage/${pig.image}`" 
                          alt="Pig Image" 
                          class="w-16 h-16 rounded-full object-cover cursor-pointer hover:opacity-80 transition-opacity shadow-sm"
                          @click="showEnlargedImage(`/storage/${pig.image}`, 'Pig Image')"
                        >
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <template v-if="pig.mark">
                          <img 
                            :src="`/storage/${pig.mark}`" 
                            alt="Pig Mark" 
                            class="w-16 h-16 rounded-full object-cover cursor-pointer hover:opacity-80 transition-opacity shadow-sm"
                            @click="showEnlargedImage(`/storage/${pig.mark}`, 'Pig Mark')"
                          >
                        </template>
                        <template v-else>
                          <span class="text-sm text-gray-500">No Mark</span>
                        </template>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-700">₱{{ pig.price_per_kilo }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                          <button 
                            @click="viewVaccinationRecords(pig.pigId)" 
                            class="bg-emerald-100 text-emerald-600 px-3 py-2 rounded-lg hover:bg-emerald-200 transition-colors duration-200 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                          >
                            Vaccination
                          </button>
                          <button 
                            @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" 
                            class="bg-emerald-100 text-emerald-600 px-3 py-2 rounded-lg hover:bg-emerald-200 transition-colors duration-200 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                          >
                            Edit
                          </button>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Card View for Mobile -->
            <div class="md:hidden space-y-4">
              <div v-for="pig in pigs" :key="pig.pigId" class="bg-white rounded-lg shadow-md overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                  <div class="flex items-center space-x-4">
                    <img 
                      :src="`/storage/${pig.image}`" 
                      alt="Pig Image" 
                      class="w-20 h-20 rounded-full object-cover cursor-pointer hover:opacity-80 transition-opacity shadow-sm"
                      @click="showEnlargedImage(`/storage/${pig.image}`, 'Pig Image')"
                    >
                    <div>
                      <h3 class="text-lg font-semibold text-gray-700">ID: {{ pig.pigId }}</h3>
                      <span :class="{
                        'px-2 inline-flex text-xs leading-5 font-semibold rounded-full mt-1': true,
                        'bg-green-100 text-green-800': pig.status === 'healthy',
                        'bg-red-100 text-red-800': pig.status === 'sick',
                        'bg-blue-100 text-blue-800': pig.status === 'sold',
                        'bg-gray-100 text-gray-800': pig.status === 'dead'
                      }">
                        {{ pig.status }}
                      </span>
                    </div>
                  </div>
                </div>
                <div class="p-4 space-y-3">
                  <div class="grid grid-cols-2 gap-4">
                    <div>
                      <p class="text-sm font-medium text-gray-500">Weight</p>
                      <p class="text-sm text-gray-700">{{ pig.weight }} kg</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Price per Kilo</p>
                      <p class="text-sm text-gray-700">₱{{ pig.price_per_kilo }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                      <p class="text-sm text-gray-700">{{ pig.date_of_birth }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Gender</p>
                      <p class="text-sm text-gray-700 capitalize">{{ pig.gender }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Breed</p>
                      <p class="text-sm text-gray-700">{{ pig.breed }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Mark</p>
                      <template v-if="pig.mark">
                        <img 
                          :src="`/storage/${pig.mark}`" 
                          alt="Pig Mark" 
                          class="w-12 h-12 rounded-full object-cover cursor-pointer hover:opacity-80 transition-opacity shadow-sm"
                          @click="showEnlargedImage(`/storage/${pig.mark}`, 'Pig Mark')"
                        >
                      </template>
                      <template v-else>
                        <span class="text-sm text-gray-500">No Mark</span>
                      </template>
                    </div>
                  </div>
                  <div class="flex space-x-2 pt-2">
                    <button 
                      @click="viewVaccinationRecords(pig.pigId)" 
                      class="flex-1 bg-emerald-100 text-emerald-600 px-3 py-2 rounded-lg hover:bg-emerald-200 transition-colors duration-200 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                    >
                      Vaccination
                    </button>
                    <button 
                      @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" 
                      class="flex-1 bg-emerald-100 text-emerald-600 px-3 py-2 rounded-lg hover:bg-emerald-200 transition-colors duration-200 focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50"
                    >
                      Edit
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enhanced Add Pig Modal -->
            <div v-if="showModal" class="fixed inset-0 z-50 overflow-y-auto">
              <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                  <!-- Modal Header -->
                  <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                      <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add New Pig
                      </h3>
                      <button @click="showModal = false" class="text-emerald-200 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  
                  <!-- Modal Body -->
                  <div class="bg-white px-6 py-6 max-h-[70vh] overflow-y-auto">
                    <form @submit.prevent="submitForm" class="space-y-6">
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Weight Field -->
                        <div>
                          <label for="weight" class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-3m-3 3l-3-3" />
                              </svg>
                            </div>
                            <input type="number" step="0.01" id="weight" v-model="form.weight" 
                                   class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                   placeholder="Enter weight" required>
                          </div>
                        </div>

                        <!-- Price per Kilo Field -->
                        <div>
                          <label for="price_per_kilo" class="block text-sm font-medium text-gray-700 mb-2">Price per Kilogram (₱)</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-400 text-sm font-medium">₱</span>
                            </div>
                            <input type="number" step="0.01" id="price_per_kilo" v-model="form.price_per_kilo" 
                                   class="block w-full pl-8 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                   placeholder="0.00" required>
                          </div>
                        </div>

                        <!-- Date of Birth Field -->
                        <div>
                          <label for="date_of_birth" class="block text-sm font-medium text-gray-700 mb-2">Date of Birth</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                            </div>
                            <input type="date" id="date_of_birth" v-model="form.date_of_birth" 
                                   class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" required>
                          </div>
                        </div>

                        <!-- Gender Field -->
                        <div>
                          <label for="gender" class="block text-sm font-medium text-gray-700 mb-2">Gender</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                              </svg>
                            </div>
                            <select id="gender" v-model="form.gender" 
                                    class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm appearance-none" required>
                              <option value="" disabled>Select gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Breed Field -->
                      <div>
                        <label for="breed" class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                        <div class="relative">
                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                          </div>
                          <select id="breed" v-model="form.breed" 
                                  class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm appearance-none" required>
                            <option value="" disabled>Select breed</option>
                            <option value="Large White">Large White</option>
                            <option value="Landrace">Landrace</option>
                            <option value="Duroc">Duroc</option>
                            <option value="Hampshire">Hampshire</option>
                            <option value="Yorkshire">Yorkshire</option>
                            <option value="Pietrain">Pietrain</option>
                            <option value="Tamworth">Tamworth</option>
                            <option value="Gloucestershire Old Spot">Gloucestershire Old Spot</option>
                            <option value="Mangalitsa">Mangalitsa</option>
                            <option value="Ossabaw Hog">Ossabaw Hog</option>
                            <option value="Kunekune">Kunekune</option>
                            <option value="American Guinea Hog">American Guinea Hog</option>
                            <option value="Mulefoot">Mulefoot</option>
                            <option value="Large Black">Large Black</option>
                            <option value="Hereford">Hereford</option>
                            <option value="Chester White">Chester White</option>
                            <option value="Poland China">Poland China</option>
                            <option value="Spotted">Spotted</option>
                            <option value="Crossbred">Crossbred</option>
                            <option value="Other">Other</option>
                          </select>
                          <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                          </div>
                        </div>
                      </div>

                      <!-- Image Upload Fields -->
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                          <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Pig Image</label>
                          <div class="relative">
                            <input type="file" id="image" @change="handlePigImageUpload" 
                                   class="block w-full px-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                   accept="image/*" required>
                          </div>
                        </div>

                        <div>
                          <label for="mark" class="block text-sm font-medium text-gray-700 mb-2">Mark Image (Optional)</label>
                          <div class="relative">
                            <input type="file" id="mark" @change="handleMarkImageUpload" 
                                   class="block w-full px-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                   accept="image/*">
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <!-- Modal Footer -->
                  <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 space-y-reverse sm:space-y-0">
                    <button @click="closeModal" type="button" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                      Cancel
                    </button>
                    <button @click="submitForm" type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                      Add Pig
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enhanced Edit Pig Modal -->
            <div v-if="showEditModal" class="fixed inset-0 z-50 overflow-y-auto">
              <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="showEditModal = false"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full border border-gray-100">
                  <!-- Modal Header -->
                  <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                      <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Pig Details
                      </h3>
                      <button @click="showEditModal = false" class="text-emerald-200 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  
                  <!-- Modal Body -->
                  <div class="bg-white px-6 py-6 max-h-[70vh] overflow-y-auto">
                    <form @submit.prevent="updatePigDetails" class="space-y-6">
                      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Weight Field -->
                        <div>
                          <label for="editWeight" class="block text-sm font-medium text-gray-700 mb-2">Weight (kg)</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16l3-3m-3 3l-3-3" />
                              </svg>
                            </div>
                            <input type="number" step="0.01" id="editWeight" v-model="editForm.weight" 
                                   class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" required>
                          </div>
                        </div>

                        <!-- Price per Kilo Field -->
                        <div>
                          <label for="editPricePerKilo" class="block text-sm font-medium text-gray-700 mb-2">Price per Kilogram (₱)</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <span class="text-gray-400 text-sm font-medium">₱</span>
                            </div>
                            <input type="number" step="0.01" id="editPricePerKilo" v-model="editForm.price_per_kilo" 
                                   class="block w-full pl-8 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" required>
                          </div>
                        </div>

                        <!-- Status Field -->
                        <div>
                          <label for="editStatus" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                            </div>
                            <select id="editStatus" v-model="editForm.status" 
                                    class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm appearance-none" required>
                              <option value="healthy">Healthy</option>
                              <option value="sick">Sick</option>
                              <option value="sold">Sold</option>
                              <option value="dead">Dead</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                              </svg>
                            </div>
                          </div>
                        </div>

                        <!-- Breed Field -->
                        <div>
                          <label for="editBreed" class="block text-sm font-medium text-gray-700 mb-2">Breed</label>
                          <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                              </svg>
                            </div>
                            <select id="editBreed" v-model="editForm.breed" 
                                    class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm appearance-none" required>
                              <option value="Large White">Large White</option>
                              <option value="Landrace">Landrace</option>
                              <option value="Duroc">Duroc</option>
                              <option value="Hampshire">Hampshire</option>
                              <option value="Yorkshire">Yorkshire</option>
                              <option value="Pietrain">Pietrain</option>
                              <option value="Tamworth">Tamworth</option>
                              <option value="Gloucestershire Old Spot">Gloucestershire Old Spot</option>
                              <option value="Mangalitsa">Mangalitsa</option>
                              <option value="Ossabaw Hog">Ossabaw Hog</option>
                              <option value="Kunekune">Kunekune</option>
                              <option value="American Guinea Hog">American Guinea Hog</option>
                              <option value="Mulefoot">Mulefoot</option>
                              <option value="Large Black">Large Black</option>
                              <option value="Hereford">Hereford</option>
                              <option value="Chester White">Chester White</option>
                              <option value="Poland China">Poland China</option>
                              <option value="Spotted">Spotted</option>
                              <option value="Crossbred">Crossbred</option>
                              <option value="Other">Other</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                              <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                              </svg>
                            </div>
                          </div>
                        </div>
                      </div>

                      <!-- Image Upload Field -->
                      <div>
                        <label for="editImage" class="block text-sm font-medium text-gray-700 mb-2">Update Image (Optional)</label>
                        <div class="relative">
                          <input type="file" id="editImage" @change="handleEditImageUpload" 
                                 class="block w-full px-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                 accept="image/*">
                        </div>
                      </div>
                    </form>
                  </div>

                  <!-- Modal Footer -->
                  <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 space-y-reverse sm:space-y-0">
                    <button @click="showEditModal = false" type="button" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                      Cancel
                    </button>
                    <button @click="updatePigDetails" type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                      Update Pig
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enhanced Vaccination Records Modal -->
            <div v-if="showVaccinationModal" class="fixed inset-0 z-50 overflow-y-auto">
              <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="closeVaccinationModal"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                
                <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full border border-gray-100">
                  <!-- Modal Header -->
                  <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                      <h3 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.414-4.414a2 2 0 112.828 2.828L12 20.414 5.586 14a2 2 0 012.828-2.828L10 12.586" />
                        </svg>
                        Vaccination Records - Pig ID: {{ selectedPigId }}
                      </h3>
                      <button @click="closeVaccinationModal" class="text-emerald-200 hover:text-white transition-colors duration-200">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                      </button>
                    </div>
                  </div>
                  
                  <!-- Modal Body -->
                  <div class="bg-white px-6 py-6 max-h-[70vh] overflow-y-auto">
                    <div class="mb-6">
                      <button @click="showAddVaccinationForm = true" 
                              class="flex items-center gap-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white px-4 py-2 rounded-lg hover:from-emerald-700 hover:to-emerald-800 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add Vaccination Record
                      </button>
                    </div>

                    <!-- Vaccination Records Table or Add Form -->
                    <!-- Enhanced Add Vaccination Form Modal -->
                    <div v-if="showAddVaccinationForm" class="fixed inset-0 z-60 overflow-y-auto">
                      <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 backdrop-blur-sm transition-opacity" aria-hidden="true" @click="closeAddVaccinationForm"></div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        
                        <div class="relative inline-block bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100">
                          <!-- Modal Header -->
                          <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                            <div class="flex justify-between items-center">
                              <h3 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Vaccination Record
                              </h3>
                              <button @click="closeAddVaccinationForm" class="text-emerald-200 hover:text-white transition-colors duration-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                              </button>
                            </div>
                          </div>
                          
                          <!-- Modal Body -->
                          <div class="bg-white px-6 py-6">
                            <form @submit.prevent="submitVaccinationForm" class="space-y-6">
                              <!-- Vaccine Name Field -->
                              <div>
                                <label for="vaccineName" class="block text-sm font-medium text-gray-700 mb-2">Vaccine Name</label>
                                <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                                    </svg>
                                  </div>
                                  <input type="text" id="vaccineName" v-model="vaccinationForm.vaccineName" 
                                         class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                         placeholder="Enter vaccine name" required>
                                </div>
                              </div>

                              <!-- Vaccine Type Field -->
                              <div>
                                <label for="vaccineType" class="block text-sm font-medium text-gray-700 mb-2">Vaccine Type</label>
                                <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                  </div>
                                  <input type="text" id="vaccineType" v-model="vaccinationForm.vaccineType" 
                                         class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" 
                                         placeholder="Enter vaccine type" required>
                                </div>
                              </div>

                              <!-- Date Administered Field -->
                              <div>
                                <label for="dateAdministered" class="block text-sm font-medium text-gray-700 mb-2">Date Administered</label>
                                <div class="relative">
                                  <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                  </div>
                                  <input type="date" id="dateAdministered" v-model="vaccinationForm.dateAdministered" 
                                         class="block w-full pl-10 pr-3 py-3 border border-emerald-300 rounded-lg bg-emerald-100 text-gray-700 focus:ring-emerald-500 focus:border-emerald-500 transition-colors sm:text-sm" required>
                                </div>
                              </div>
                            </form>
                          </div>

                          <!-- Modal Footer -->
                          <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end sm:space-x-3 space-y-3 space-y-reverse sm:space-y-0">
                            <button @click="closeAddVaccinationForm" type="button" 
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-colors duration-200">
                              Cancel
                            </button>
                            <button @click="submitVaccinationForm" type="submit" 
                                    class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 border border-transparent shadow-sm text-sm font-medium rounded-lg text-white bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-700 hover:to-emerald-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition-all duration-200">
                              Add Record
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Enlarged Image Modal -->
            <div v-if="showEnlargedImageModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-75">
              <div class="relative max-w-4xl w-full mx-4">
                <button 
                  @click="closeEnlargedImage" 
                  class="absolute -top-10 right-0 text-white hover:text-gray-300 transition-colors"
                >
                  <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
                <div class="bg-white rounded-lg overflow-hidden">
                  <img 
                    :src="enlargedImageUrl" 
                    :alt="enlargedImageTitle" 
                    class="w-full h-auto max-h-[80vh] object-contain"
                  >
                  <div class="p-4 bg-white">
                    <h3 class="text-lg font-semibold text-gray-700">{{ enlargedImageTitle }}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </AuthenticatedLayout>
  </div>
</template>
<script setup>
import { ref, reactive, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const pigs = ref([]);
const showModal = ref(false);
const showEditModal = ref(false);
const showVaccinationModal = ref(false);
const showAddVaccinationForm = ref(false);
const selectedPigId = ref(null);
const vaccinationRecords = ref([]);
const noVaccinationRecordsMessage = ref(''); 
const form = reactive({
  weight: '',
  date_of_birth: '',
  gender: '',
  breed: '',
  status: 'healthy', 
  image: null,
  mark: null,
  price_per_kilo: '', 
});
const editForm = reactive({
  weight: '',
  price_per_kilo: '', 
  status: 'healthy', // default to healthy
  breed: '',
  image: null
});
const vaccinationForm = reactive({
  vaccineName: '',
  vaccineType: '',
  dateAdministered: '',
  vaccineImage: null
});

// Add new refs for enlarged image modal
const showEnlargedImageModal = ref(false);
const enlargedImageUrl = ref('');
const enlargedImageTitle = ref('');

const fetchPigFarmID = async () => {
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
    form.pigfarmID = data.pigfarmID;
  } catch (error) {
    console.error('Error fetching pig farm ID:', error);
  }
};
const handleEditImageUpload = (event) => {
  const file = event.target.files[0];
  editForm.image = file;
};
const handlePigImageUpload = (event) => {
  const file = event.target.files[0];
  form.image = file;
};
const handleMarkImageUpload = (event) => {
  const file = event.target.files[0];
  form.mark = file;
};
const handleImageUpload = (event) => {
  const file = event.target.files[0];
  vaccinationForm.vaccineImage = file;
};
const submitForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();

    formData.append('weight', form.weight);
    formData.append('date_of_birth', form.date_of_birth);
    formData.append('gender', form.gender);
    formData.append('breed', form.breed);
    formData.append('status', form.status); // Ensure status is included
    formData.append('image', form.image);
    formData.append('mark', form.mark);
    formData.append('price_per_kilo', form.price_per_kilo);

    console.log('Submitting form with data:', {
      weight: form.weight,
      date_of_birth: form.date_of_birth,
      gender: form.gender,
      breed: form.breed,
      status: form.status,
      image: form.image,
      mark: form.mark,
      price_per_kilo: form.price_per_kilo
    });

    const response = await fetch('/api/pigs', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: formData
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      throw new Error('Response is not JSON');
    }

    const data = await response.json();
    console.log('Response data:', data);
    pigs.value.push(data);
    showModal.value = false;
    form.weight = '';
    form.date_of_birth = '';
    form.gender = '';
    form.breed = '';
    form.status = 'healthy'; // Reset status to default
    form.image = null;
    form.price_per_kilo = '';
    window.location.reload();
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};

const fetchPigs = async () => {
  try {
    const response = await fetch('/api/pigs', {
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
    pigs.value = data;
  } catch (error) {
    console.error('Error fetching pigs:', error);
  }
};
const viewVaccinationRecords = async (pigId) => {
  
  selectedPigId.value = pigId;
  showVaccinationModal.value = true;
  try {
    const response = await fetch(`/api/pigs/${pigId}/vaccination-records`, {
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    if (!response.ok) {
      if (response.status === 404) {
        vaccinationRecords.value = [];
        noVaccinationRecordsMessage.value = 'No vaccination records found';
      } else {
        throw new Error('Network response was not ok');
      }
    } else {
      const data = await response.json();
      vaccinationRecords.value = data;
      noVaccinationRecordsMessage.value = '';
    }
  } catch (error) {
    console.error('Error fetching vaccination records:', error);
  }
};

const submitVaccinationForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();
    formData.append('vaccineName', vaccinationForm.vaccineName);
    formData.append('vaccineType', vaccinationForm.vaccineType);
    formData.append('dateAdministered', vaccinationForm.dateAdministered);
    if (vaccinationForm.vaccineImage) {
      formData.append('vaccineImage', vaccinationForm.vaccineImage);
    }

    const response = await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: formData
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    vaccinationRecords.value.push(data);
    showAddVaccinationForm.value = false;
    vaccinationForm.vaccineName = '';
    vaccinationForm.vaccineType = '';
    vaccinationForm.dateAdministered = '';
    vaccinationForm.vaccineImage = null; // Clear image file input
    window.location.reload();
  } catch (error) {
    console.error('Error adding vaccination record:', error);
  }
};

const deleteVaccinationRecord = async (recordId) => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records/${recordId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    vaccinationRecords.value = vaccinationRecords.value.filter(record => record.id !== recordId);
    window.location.reload();
  } catch (error) {
    console.error('Error deleting vaccination record:', error);
  }
};

const updatePigDetails = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();
    formData.append('weight', editForm.weight);
    formData.append('price_per_kilo', editForm.price_per_kilo);
    formData.append('status', editForm.status);
    formData.append('breed', editForm.breed);
    if (editForm.image) {
      formData.append('image', editForm.image);
    }

    console.log('Sending request to:', `/api/pigs/update/${selectedPigId.value}`);
    
    // Log FormData entries
    for (let [key, value] of formData.entries()) {
      console.log(`${key}:`, value);
    }

    const response = await fetch(`/api/pigs/update/${selectedPigId.value}`, {
      method: 'POST', // Change to POST
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: formData
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    console.log('Updated pig details:', data);
    const pigIndex = pigs.value.findIndex(pig => pig.pigId === selectedPigId.value);
    if (pigIndex !== -1) {
      pigs.value[pigIndex].weight = data.pig.weight;
      pigs.value[pigIndex].status = data.pig.status;
      pigs.value[pigIndex].breed = data.pig.breed;
      if (data.pig.image) {
        pigs.value[pigIndex].image = data.pig.image;
      }
    }
    showEditModal.value = false;
    window.location.reload();
  } catch (error) {
    console.error('Error updating pig details:', error);
  }
};
const openEditModal = (pigId, currentWeight, currentPrice, currentStatus, currentBreed) => {
  selectedPigId.value = pigId;
  editForm.weight = currentWeight;
  editForm.price_per_kilo = currentPrice;
  editForm.status = currentStatus;
  editForm.breed = currentBreed;
  showEditModal.value = true;
};

const closeModal = () => {
  showModal.value = false;
  form.weight = '';
  form.date_of_birth = '';
  form.gender = '';
  form.breed = '';
  form.image = null;
};

const closeVaccinationModal = () => {
  showVaccinationModal.value = false;
  showAddVaccinationForm.value = false;
  vaccinationForm.vaccineName = '';
  vaccinationForm.vaccineType = '';
  vaccinationForm.dateAdministered = '';
};

const closeAddVaccinationForm = () => {
  showAddVaccinationForm.value = false;
  vaccinationForm.vaccineName = '';
  vaccinationForm.vaccineType = '';
  vaccinationForm.dateAdministered = '';
};

// Add new methods for enlarged image handling
const showEnlargedImage = (imageUrl, title) => {
  enlargedImageUrl.value = imageUrl;
  enlargedImageTitle.value = title;
  showEnlargedImageModal.value = true;
};

const closeEnlargedImage = () => {
  showEnlargedImageModal.value = false;
  enlargedImageUrl.value = '';
  enlargedImageTitle.value = '';
};

onMounted(() => {
  fetchPigFarmID();
  fetchPigs();
});
</script>
<style scoped>
/* Enhanced Modal Styles */
.modal {
  display: block;
  position: fixed;
  z-index: 50;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.5);
  backdrop-filter: blur(4px);
  animation: fadeIn 0.3s ease-out;
}

.modal-content {
  background-color: #ffffff;
  margin: 5% auto;
  padding: 0;
  border: none;
  border-radius: 16px;
  width: 90%;
  max-width: 600px;
  box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  animation: slideIn 0.3s ease-out;
  overflow: hidden;
}

.modal-content::-webkit-scrollbar {
  width: 6px;
}

.modal-content::-webkit-scrollbar-track {
  background: #f1f5f9;
  border-radius: 3px;
}

.modal-content::-webkit-scrollbar-thumb {
  background: #10b981;
  border-radius: 3px;
}

.modal-content::-webkit-scrollbar-thumb:hover {
  background: #059669;
}

.close {
  color: rgba(255, 255, 255, 0.7);
  float: right;
  font-size: 24px;
  font-weight: bold;
  padding: 8px;
  border-radius: 6px;
  transition: all 0.2s ease;
}

.close:hover,
.close:focus {
  color: #ffffff;
  background-color: rgba(255, 255, 255, 0.1);
  text-decoration: none;
  cursor: pointer;
  transform: scale(1.1);
}

/* Dark mode styles */
.dark .modal-content {
  background-color: #1f2937;
  color: #f9fafb;
}

.dark .modal-content::-webkit-scrollbar-track {
  background: #374151;
}

.dark .modal-content::-webkit-scrollbar-thumb {
  background: #10b981;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateY(-20px) scale(0.95);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}

/* Enhanced form styles */
.form-input {
  transition: all 0.2s ease;
}

.form-input:focus {
  transform: translateY(-1px);
  box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.1);
}

/* Button hover effects */
.btn-primary {
  transition: all 0.2s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px -8px rgba(16, 185, 129, 0.3);
}

/* Table styles */
table {
  border-collapse: separate;
  border-spacing: 0;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

thead th {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  font-size: 0.875rem;
}

tbody tr {
  transition: all 0.2s ease;
}

tbody tr:hover {
  background-color: rgba(16, 185, 129, 0.05);
  transform: translateX(2px);
}

tbody td {
  border-bottom: 1px solid #e5e7eb;
}

tbody tr:last-child td {
  border-bottom: none;
}

/* Card styles */
.pig-card {
  transition: all 0.3s ease;
  background: linear-gradient(135deg, #ffffff, #f8fafc);
}

.pig-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Status badges */
.status-healthy {
  background: linear-gradient(135deg, #10b981, #059669);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-sick {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-sold {
  background: linear-gradient(135deg, #3b82f6, #2563eb);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.status-dead {
  background: linear-gradient(135deg, #6b7280, #4b5563);
  color: white;
  padding: 4px 12px;
  border-radius: 20px;
  font-size: 0.75rem;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Responsive adjustments */
@media (max-width: 640px) {
  .modal-content {
    margin: 2% auto;
    width: 95%;
  }
  
  .pig-card {
    padding: 1rem;
  }
}

/* Loading animations */
@keyframes pulse {
  0%, 100% {
    opacity: 1;
  }
  50% {
    opacity: 0.5;
  }
}

.loading {
  animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>
