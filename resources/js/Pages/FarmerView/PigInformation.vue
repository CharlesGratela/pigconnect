<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Pig Information</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-[75%]">
            <div class="flex justify-between items-center mb-6">
              <h2 class="text-2xl font-bold text-[#543434]">Pig Inventory</h2>
              <button 
                @click="showModal = true" 
                class="flex items-center gap-2 bg-[#281c11] text-white px-4 py-2.5 rounded-lg hover:bg-[#3a2a1a] transition-colors duration-200 focus:ring-4 focus:ring-[#c58a61] focus:ring-opacity-50"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Pig
              </button>
            </div>
            
            <!-- Table View for Desktop -->
            <div class="hidden md:block bg-white rounded-lg shadow-md overflow-hidden mb-6">
              <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-[#543434] flex items-center gap-2">
                  <svg class="w-5 h-5 text-[#c58a61]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                  </svg>
                  Pig Inventory
                </h3>
              </div>
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
                        <div class="text-sm font-medium text-[#543434]">{{ pig.pigId }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-[#543434]">{{ pig.weight }} kg</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-[#543434]">{{ pig.date_of_birth }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-[#543434] capitalize">{{ pig.gender }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-[#543434]">{{ pig.breed }}</div>
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
                        <div class="text-sm text-[#543434]">₱{{ pig.price_per_kilo }}</div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                          <button 
                            @click="viewVaccinationRecords(pig.pigId)" 
                            class="bg-[#a7674d] text-white px-3 py-2 rounded-lg hover:bg-[#8b5a43] transition-colors duration-200 focus:ring-2 focus:ring-[#c58a61] focus:ring-opacity-50"
                          >
                            Vaccination
                          </button>
                          <button 
                            @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" 
                            class="bg-[#c58a61] text-white px-3 py-2 rounded-lg hover:bg-[#b37a50] transition-colors duration-200 focus:ring-2 focus:ring-[#c58a61] focus:ring-opacity-50"
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
                      <h3 class="text-lg font-semibold text-[#543434]">ID: {{ pig.pigId }}</h3>
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
                      <p class="text-sm text-[#543434]">{{ pig.weight }} kg</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Price per Kilo</p>
                      <p class="text-sm text-[#543434]">₱{{ pig.price_per_kilo }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Date of Birth</p>
                      <p class="text-sm text-[#543434]">{{ pig.date_of_birth }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Gender</p>
                      <p class="text-sm text-[#543434] capitalize">{{ pig.gender }}</p>
                    </div>
                    <div>
                      <p class="text-sm font-medium text-gray-500">Breed</p>
                      <p class="text-sm text-[#543434]">{{ pig.breed }}</p>
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
                      class="flex-1 bg-[#a7674d] text-white px-3 py-2 rounded-lg hover:bg-[#8b5a43] transition-colors duration-200 focus:ring-2 focus:ring-[#c58a61] focus:ring-opacity-50"
                    >
                      Vaccination
                    </button>
                    <button 
                      @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" 
                      class="flex-1 bg-[#c58a61] text-white px-3 py-2 rounded-lg hover:bg-[#b37a50] transition-colors duration-200 focus:ring-2 focus:ring-[#c58a61] focus:ring-opacity-50"
                    >
                      Edit
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- Add Pig Modal -->
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span class="close" @click="showModal = false">&times;</span>
                <form @submit.prevent="submitForm">
                  <div class="mb-4">
                    <label for="weight" class="block text-sm font-medium text-[#543434]">Weight(kg)</label>
                    <input type="number" step="0.01" id="weight" v-model="form.weight" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="price_per_kilo" class="block text-sm font-medium text-[#543434]">Price per Kilogram</label>
                    <input type="number" step="0.01" id="price_per_kilo" v-model="form.price_per_kilo" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-[#543434]">Date of Birth</label>
                    <input type="date" id="date_of_birth" v-model="form.date_of_birth" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-[#543434]">Gender</label>
                    <select id="gender" v-model="form.gender" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="breed" class="block text-sm font-medium text-[#543434]">Breed</label>
                    <select id="breed" v-model="form.breed" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      <option value="Large White (Yorkshire)">Large White (Yorkshire)</option>
                      <option value="Landrace">Landrace</option>
                      <option value="Duroc">Duroc</option>
                      <option value="Hampshire">Hampshire</option>
                      <option value="Pietrain">Pietrain</option>
                      <option value="Berkshire">Berkshire</option>
                      <option value="Chester White">Chester White</option>
                      <option value="Tamworth">Tamworth</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-[#543434]">Image</label>
                    <input type="file" id="image" @change="handlePigImageUpload" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="mark" class="block text-sm font-medium text-[#543434]">Mark</label>
                    <input type="file" id="mark" @change="handleMarkImageUpload" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]">
                  </div>
                  <button type="submit" class="w-full bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Submit</button>
                </form>
              </div>
            </div>

            <!-- Edit Pig Modal -->
            <div v-if="showEditModal" class="modal">
              <div class="modal-content">
                <span class="close" @click="showEditModal = false">&times;</span>
                <form @submit.prevent="updatePigDetails">
                  <div class="mb-4">
                    <label for="editWeight" class="block text-sm font-medium text-[#543434]">Weight(kg)</label>
                    <input type="number" step="0.01" id="editWeight" v-model="editForm.weight" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="price_per_kilo" class="block text-sm font-medium text-[#543434]">Price per Kilogram</label>
                    <input type="number" step="0.01" id="price_per_kilo" v-model="editForm.price_per_kilo" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                  </div>
                  <div class="mb-4">
                    <label for="editStatus" class="block text-sm font-medium text-[#543434]">Status</label>
                    <select id="editStatus" v-model="editForm.status" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      <option value="healthy">Healthy</option>
                      <option value="sick">Sick</option>
                      <option value="sold">Sold</option>
                      <option value="dead">Dead</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="editBreed" class="block text-sm font-medium text-[#543434]">Breed</label>
                    <select id="editBreed" v-model="editForm.breed" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      <option value="Large White (Yorkshire)">Large White (Yorkshire)</option>
                      <option value="Landrace">Landrace</option>
                      <option value="Duroc">Duroc</option>
                      <option value="Hampshire">Hampshire</option>
                      <option value="Pietrain">Pietrain</option>
                      <option value="Berkshire">Berkshire</option>
                      <option value="Chester White">Chester White</option>
                      <option value="Tamworth">Tamworth</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="editImage" class="block text-sm font-medium text-[#543434]">Image (optional)</label>
                    <input type="file" id="editImage" @change="handleEditImageUpload" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]">
                  </div>
                  <button type="submit" class="w-full bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Update</button>
                </form>
              </div>
            </div>

            <!-- Vaccination Records Modal -->
            <div v-if="showVaccinationModal" class="modal">
              <div class="modal-content">
                <span class="close" @click="closeVaccinationModal">&times;</span>
                <h3 class="text-lg leading-6 font-medium text-[#543434]">Vaccination Records for Pig ID: {{ selectedPigId }}</h3>
                <button @click="showAddVaccinationForm = true" class="mb-4 bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Add Vaccination Record</button>

                <!-- Add Vaccination Record Form -->
                <div v-if="showAddVaccinationForm" class="modal">
                  <div class="modal-content">
                    <span class="close" @click="closeAddVaccinationForm">&times;</span>
                    <h3 class="text-lg leading-6 font-medium text-[#543434]">Add Vaccination Record</h3>
                    <form @submit.prevent="addVaccinationRecord">
                      <div class="mb-4">
                        <label for="vaccineName" class="block text-sm font-medium text-[#543434]">Vaccine Name</label>
                        <input type="text" id="vaccineName" v-model="vaccinationForm.vaccineName" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      </div>
                      <div class="mb-4">
                        <label for="vaccineType" class="block text-sm font-medium text-[#543434]">Vaccine Type</label>
                        <input type="text" id="vaccineType" v-model="vaccinationForm.vaccineType" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      </div>
                      <div class="mb-4">
                        <label for="dateAdministered" class="block text-sm font-medium text-[#543434]">Date Administered</label>
                        <input type="date" id="dateAdministered" v-model="vaccinationForm.dateAdministered" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" required>
                      </div>
                      <div class="mb-4">
                        <label for="vaccineImage" class="block text-sm font-medium text-[#543434]">Vaccine Image</label>
                        <input type="file" id="vaccineImage" @change="handleImageUpload" class="mt-1 block w-full p-2.5 bg-[#c58a61] border border-[#c59461] text-[#543434] rounded-lg focus:ring-[#c58a61] focus:border-[#c58a61]" accept="image/*" required>
                      </div>
                      <button type="submit" class="w-full bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Submit</button>
                    </form>
                  </div>
                </div>

                <!-- Vaccination Records Table -->
                <div v-if="vaccinationRecords.length > 0">
                  <div class="overflow-x-auto hidden md:block">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-[#281c11]">
                        <tr>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#fefefe] uppercase tracking-wider">Vaccine Name</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#fefefe] uppercase tracking-wider">Vaccine Type</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#fefefe] uppercase tracking-wider">Date Administered</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#fefefe] uppercase tracking-wider">Vaccine Image</th>
                          <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-[#fefefe] uppercase tracking-wider">Actions</th>
                        </tr>
                      </thead>
                      <tbody class="bg-[#fefefe] divide-y divide-gray-200">
                        <tr v-for="record in vaccinationRecords" :key="record.id">
                          <td class="px-6 py-4 whitespace-nowrap text-[#543434]">{{ record.vaccineName }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-[#543434]">{{ record.vaccineType }}</td>
                          <td class="px-6 py-4 whitespace-nowrap text-[#543434]">{{ record.dateAdministered }}</td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <div v-if="record.vaccine_image">
                              <img :src="`/storage/${record.vaccine_image}`" alt="Vaccine Image" class="w-32 h-32 object-cover">
                            </div>
                          </td>
                          <td class="px-6 py-4 whitespace-nowrap">
                            <button @click="deleteVaccinationRecord(record.id)" class="bg-red-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-red-300">Delete</button>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <!-- Vaccination Records Cards for Mobile -->
                  <div class="md:hidden">
                    <div v-for="record in vaccinationRecords" :key="record.id" class="bg-[#fefefe] p-4 mb-4 rounded-lg shadow-md">
                      <div class="mb-2">
                        <span class="block text-sm font-medium text-[#543434]">Vaccine Name:</span>
                        <span class="block text-sm text-[#543434]">{{ record.vaccineName }}</span>
                      </div>
                      <div class="mb-2">
                        <span class="block text-sm font-medium text-[#543434]">Date Administered:</span>
                        <span class="block text-sm text-[#543434]">{{ record.dateAdministered }}</span>
                      </div>
                      <div class="mb-2" v-if="record.vaccine_image">
                        <span class="block text-sm font-medium text-[#543434]">Vaccine Image:</span>
                        <img :src="`/storage/${record.vaccine_image}`" alt="Vaccine Image" class="w-full h-32 object-cover mt-2">
                      </div>
                      <button @click="deleteVaccinationRecord(record.id)" class="bg-red-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-red-300 mt-2">Delete</button>
                    </div>
                  </div>
                </div>
                <p v-else class="text-[#543434]">{{ noVaccinationRecordsMessage }}</p>
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
                    <h3 class="text-lg font-semibold text-[#543434]">{{ enlargedImageTitle }}</h3>
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

const addVaccinationRecord = async () => {
  
  try {
    console.log(selectedPigId.value);
    console.log(vaccinationForm);
    const formData = new FormData();
    formData.append('vaccineName', vaccinationForm.vaccineName);
    formData.append('vaccineType', vaccinationForm.vaccineType);
    formData.append('dateAdministered', vaccinationForm.dateAdministered);
    formData.append('vaccineImage', vaccinationForm.vaccineImage);

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: formData
    });

    if (!response.ok) {
      console.error('Response status:', response.status);
      console.error('Response status text:', response.statusText);
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    vaccinationRecords.value.push(data);
    showAddVaccinationForm.value = false;
    vaccinationForm.vaccineName = '';
    vaccinationForm.vaccineType = '';
    vaccinationForm.dateAdministered = '';
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
  color: #000;
}
.dark .modal-content {
  background-color: #333;
  color: #fff;
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
.hidden-mobile {
  display: table;
}
.block-mobile {
  display: none;
}
@media (max-width: 768px) {
  .hidden-mobile {
    display: none;
  }
  .block-mobile {
    display: block;
  }
}

/* Add styles for enlarged image modal */
.enlarged-image-modal {
  display: flex;
  align-items: center;
  justify-content: center;
}

.enlarged-image-container {
  position: relative;
  max-width: 90vw;
  max-height: 90vh;
}

.enlarged-image {
  max-width: 100%;
  max-height: 90vh;
  object-fit: contain;
}
</style>