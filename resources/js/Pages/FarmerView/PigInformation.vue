<template>
  <div>
    <AuthenticatedLayout>
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Pig Information</h2>
      </template>
      <main>
        <div class="flex justify-center">
          <div class="w-[75%]">
            <button @click="showModal = true" class="mb-4 bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Add Pig</button>
            <table class="min-w-full bg-white dark:bg-gray-800">
              <thead>
                <tr>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">ID</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Pig Farm ID</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Weight</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Date of Birth</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Gender</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Status</th>
                  <th class="py-2 text-left text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="pig in pigs" :key="pig.pigId">
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.pigId }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.pigfarmID }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.weight }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.date_of_birth }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.gender }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">{{ pig.status }}</td>
                  <td class="py-2 text-left text-gray-700 dark:text-gray-300">
                    <button @click="viewVaccinationRecords(pig.pigId)" class="bg-green-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-green-300 dark:bg-green-600 dark:focus:ring-green-800">View Vaccination Records</button>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- Add Pig Modal -->
            <div v-if="showModal" class="modal">
              <div class="modal-content">
                <span class="close" @click="showModal = false">&times;</span>
                <form @submit.prevent="submitForm">
                  <div class="mb-4">
                    <label for="pigfarmID" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Pig Farm ID</label>
                    <input type="number" id="pigfarmID" v-model="form.pigfarmID" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div class="mb-4">
                    <label for="weight" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Weight</label>
                    <input type="number" step="0.01" id="weight" v-model="form.weight" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div class="mb-4">
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date of Birth</label>
                    <input type="date" id="date_of_birth" v-model="form.date_of_birth" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <div class="mb-4">
                    <label for="gender" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Gender</label>
                    <select id="gender" v-model="form.gender" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                  <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <input type="text" id="status" v-model="form.status" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                  </div>
                  <button type="submit" class="w-full bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Submit</button>
                </form>
              </div>
            </div>

            <!-- Vaccination Records Modal -->
            <div v-if="showVaccinationModal" class="modal">
              <div class="modal-content">
                <span class="close" @click="closeVaccinationModal">&times;</span>
                <h3>Vaccination Records for Pig ID: {{ selectedPigId }}</h3>
                <button @click="showAddVaccinationForm = true" class="mb-4 bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Add Vaccination Record</button>

                <!-- Add Vaccination Record Form -->
                <div v-if="showAddVaccinationForm" class="modal">
                  <div class="modal-content">
                    <span class="close" @click="closeAddVaccinationForm">&times;</span>
                    <h3>Add Vaccination Record</h3>
                    <form @submit.prevent="addVaccinationRecord">
                      <div class="mb-4">
                        <label for="vaccineName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vaccine Name</label>
                        <input type="text" id="vaccineName" v-model="vaccinationForm.vaccineName" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                      </div>
                      <div class="mb-4">
                        <label for="vaccineType" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Vaccine Type</label>
                        <input type="text" id="vaccineType" v-model="vaccinationForm.vaccineType" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                      </div>
                      <div class="mb-4">
                        <label for="dateAdministered" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date Administered</label>
                        <input type="date" id="dateAdministered" v-model="vaccinationForm.dateAdministered" class="mt-1 block w-full p-2.5 bg-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                      </div>
                      <button type="submit" class="w-full bg-blue-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:focus:ring-blue-800">Submit</button>
                    </form>
                  </div>
                </div>

                <!-- Vaccination Records List -->
                <ul>
                  <li v-for="record in vaccinationRecords" :key="record.id">
                    <span>{{ record.vaccineName }} - {{ record.vaccineType }} - {{ record.dateAdministered }}</span>
                    <button @click="deleteVaccinationRecord(record.id)" class="bg-red-500 text-white p-2.5 rounded-lg focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:focus:ring-red-800">Delete</button>
                  </li>
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
import { ref, reactive, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const pigs = ref([]);
const showModal = ref(false);
const showVaccinationModal = ref(false);
const showAddVaccinationForm = ref(false);
const selectedPigId = ref(null);
const vaccinationRecords = ref([]);
const form = reactive({
  pigfarmID: '',
  weight: '',
  date_of_birth: '',
  gender: '',
  status: ''
});
const vaccinationForm = reactive({
  vaccineName: '',
  vaccineType: '',
  dateAdministered: ''
});

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

const submitForm = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch('/api/pigs', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(form)
    });

    if (!response.ok) {
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    pigs.value.push(data);
    showModal.value = false;
    form.pigfarmID = '';
    form.weight = '';
    form.date_of_birth = '';
    form.gender = '';
    form.status = '';
  } catch (error) {
    console.error('Error submitting form:', error);
  }
};

const viewVaccinationRecords = async (pigId) => {
  selectedPigId.value = pigId;
  showVaccinationModal.value = true;
  await fetchVaccinationRecords();
};

const fetchVaccinationRecords = async () => {
  try {
    const response = await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records`, {
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
    vaccinationRecords.value = data;
  } catch (error) {
    console.error('Error fetching vaccination records:', error);
  }
};

const addVaccinationRecord = async () => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const response = await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records`, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      body: JSON.stringify(vaccinationForm)
    });

    // Log the response for debugging
    console.log('Response:', response);

    if (!response.ok) {
      const errorData = await response.json();
      console.error('Error data:', errorData);
      throw new Error('Network response was not ok');
    }

    const data = await response.json();
    vaccinationRecords.value.push(data);
    closeAddVaccinationForm();
  } catch (error) {
    console.error('Error adding vaccination record:', error);
  }
};

const deleteVaccinationRecord = async (id) => {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    await fetch(`/api/pigs/${selectedPigId.value}/vaccination-records/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${localStorage.getItem('token')}`
      },
      credentials: 'include'
    });
    vaccinationRecords.value = vaccinationRecords.value.filter(record => record.id !== id);
  } catch (error) {
    console.error('Error deleting vaccination record:', error);
  }
};

const closeVaccinationModal = () => {
  showVaccinationModal.value = false;
  vaccinationRecords.value = [];
};

const closeAddVaccinationForm = () => {
  vaccinationForm.vaccineName = '';
  vaccinationForm.vaccineType = '';
  vaccinationForm.dateAdministered = '';
  showAddVaccinationForm.value = false;
};

onMounted(() => {
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
</style>