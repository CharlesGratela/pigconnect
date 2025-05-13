<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-[#543434] leading-tight">Pig Information</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-[75%]">
            <button @click="showModal = true" class="mb-4 bg-[#281c11] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">Add Pig</button>
            
            <!-- Table View for Desktop -->
            <table class="min-w-full bg-white hidden-mobile">
              <thead>
                <tr>
                  <th class="py-2 text-left text-[#543434]">ID</th>
                  <th class="py-2 text-left text-[#543434]">Weight</th>
                  <th class="py-2 text-left text-[#543434]">Date of Birth</th>
                  <th class="py-2 text-left text-[#543434]">Gender</th>
                  <th class="py-2 text-left text-[#543434]">Breed</th>
                  <th class="py-2 text-left text-[#543434]">Status</th>
                  <th class="py-2 text-left text-[#543434]">Image</th>
                  <th class="py-2 text-left text-[#543434]">Mark</th>
                  <th class="py-2 text-left text-[#543434]">Price per Kilo</th>
                  <th class="py-2 text-left text-[#543434]">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="pig in pigs" :key="pig.pigId">
                  <td class="py-2 text-left text-[#543434]">{{ pig.pigId }}</td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.weight }}</td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.date_of_birth }}</td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.gender }}</td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.breed }}</td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.status }}</td>
                  <td class="py-2 text-left text-[#543434]">
                    <img :src="`/storage/${pig.image}`" alt="Pig Image" class="w-16 h-16 rounded-full">
                  </td>
                  <td class="py-2 text-left text-[#543434]">
                    <template v-if="pig.mark">
                      <img :src="`/storage/${pig.mark}`" alt="Pig Mark" class="w-16 h-16 rounded-full">
                    </template>
                    <template v-else>
                      <span class="text-[#543434]">No Mark</span>
                    </template>
                  </td>
                  <td class="py-2 text-left text-[#543434]">{{ pig.price_per_kilo }}</td>
                  <td class="py-2 text-left text-[#543434]">
                    <button @click="viewVaccinationRecords(pig.pigId)" class="bg-[#a7674d] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">View Vaccination Records</button>
                    <button @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" class="bg-[#c58a61] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61] ml-2">Edit</button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Card View for Mobile -->
            <div class="block-mobile">
              <div v-for="pig in pigs" :key="pig.pigId" class="mb-4 p-4 bg-white rounded-lg shadow-md">
                <div class="flex items-center mb-4">
                  <img :src="`/storage/${pig.image}`" alt="Pig Image" class="w-16 h-16 rounded-full mr-4">
                  <div>
                    <h3 class="text-lg font-semibold text-[#543434]">{{ pig.pigId }}</h3>
                  </div>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Weight:</span>
                  <span class="text-[#543434]">{{ pig.weight }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Date of Birth:</span>
                  <span class="text-[#543434]">{{ pig.date_of_birth }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Gender:</span>
                  <span class="text-[#543434]">{{ pig.gender }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Breed:</span>
                  <span class="text-[#543434]">{{ pig.breed }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Status:</span>
                  <span class="text-[#543434]">{{ pig.status }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Price per kilo:</span>
                  <span class="text-[#543434]">{{ pig.price_per_kilo }}</span>
                </div>
                <div class="mb-2">
                  <span class="font-semibold text-[#543434]">Mark:</span>
                  <template v-if="pig.mark">
                    <img :src="`/storage/${pig.mark}`" alt="Pig Mark" class="w-16 h-16 mr-4">
                  </template>
                  <template v-else>
                    <span class="text-[#543434]">No Mark</span>
                  </template>
                </div>
                <button @click="viewVaccinationRecords(pig.pigId)" class="w-full bg-[#a7674d] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61]">View Vaccination Records</button>
                <button @click="openEditModal(pig.pigId, pig.weight, pig.price_per_kilo, pig.status, pig.breed)" class="w-full bg-[#c58a61] text-white p-2.5 rounded-lg focus:ring-4 focus:ring-[#c58a61] mt-2">Edit</button>
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
</style>