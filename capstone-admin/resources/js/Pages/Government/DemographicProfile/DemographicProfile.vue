<template>
  <HeadTitle title="Demographic Profile"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <h4 class="font-bold text-xl text-gray-800">Demographic Profile</h4>

    <!-- demographic form modal -->
    <DemographicProfileModal :showModal="showModal" v-if="isShowModal" :handleCreate="handleCreateNewCensus" />

    <!-- delete verfication modal -->
    <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="filteredData.id"
      :handleDelete="handleDeleteCensus" />
    <!-- edit verification modal -->
    <EditVerification :close-modal="showEditVerification" v-if="isEditVerification" :data="editedInput"
      :handle-edit="handleEdit" />

    <!-- hotlines table -->
    <div class="w-full flex flex-col">
      <!-- census year -->
      <h5 class="font-bold text-xl text-gray-800 mt-5">
        <i class="uil uil-chart-pie-alt"></i>
        {{ filteredData.census_year }} Census
      </h5>
      <h6 class="font-semibold my-2 text-blue-600">
        Total population: {{ new Intl.NumberFormat("en-US").format(filteredData.total_population) }}
      </h6>

      <!-- filter options -->
      <div class="mb-5 flex items-center justify-between">
        <div class="flex items-center">
          <span class="text-sm text-gray-700 font-bold mr-3">
            <i class="uil uil-filter"></i>
            Filter by
          </span>
          <SelectTag type="cencus" :filterFn="filterBy" :filterArray="years" :value="selectedYear" />
        </div>

        <!-- add new btn -->
        <button @click="showModal" class="bg-blue-600 py-2 px-3 rounded-lg text-white font-bold capitalize">add
          census</button>
      </div>
      <button @click="showDeleteVerificiationModal"
        class="self-end px-3 bg-red-300 rounded-md text-red-600 mb-2 hover:bg-red-400 hover:text-red-200">
        <i class="uil uil-times-circle"></i>
        delete this census
      </button>

      <table class="text-left w-full">
        <thead>
          <tr class="bg-neutral-200 text-xs md:text-sm">
            <th class="px-2 text-center"><i class="uil uil-list-ui-alt"></i></th>
            <th class="pl-2 py-2 text-neutral-600">
              Barangay
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Male
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Female
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Religion
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Number of Household
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
          </tr>
        </thead>
        <tbody v-if="filteredData?.barangays">
          <tr v-for="a, idx in JSON.parse(filteredData?.barangays)" :key="idx"
            class="text-xs md:text-sm font-medium border">
            <td class="bg-white text-center">{{ idx + 1 }}</td>
            <td class="bg-white border pl-2 border-l-0">
              <input v-model="a.barangay"
                @change.capture="(e) => showEditVerification(e.target.value, a.barangay + '|barangay', filteredData.id, idx)"
                class="focus:outline-blue-500 py-2 w-full m-0 text-sm capitalize scrollbar">
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <input v-model="a.male" type="number"
                @change.capture="(e) => showEditVerification(e.target.value, a.barangay + '|male', filteredData.id, idx)"
                class="focus:outline-blue-500 py-2 w-full overflow-scroll m-0 text-sm">
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <input v-model="a.female" type="number"
                @change.capture="(e) => showEditVerification(e.target.value, a.barangay + '|female', filteredData.id, idx)"
                class="focus:outline-blue-500 py-2 w-full overflow-scroll m-0 text-sm">
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <div class="overflow-y-scroll scrollbar h-[50px]">
                <div v-for="rel, relId in JSON.parse(filteredData.religion)[idx]" :key="relId">
                  <span class="capitalize font-semibold">{{ rel.religion }}</span>
                  <input type="number" v-model="rel.count"
                    @change.capture="(e) => showEditVerification(e.target.value, 'religion|' + rel.religion, filteredData.id, relId)"
                    class="focus:outline-blue-500 overflow-scroll no-scrollbar m-0 text-sm w-full">
                </div>
              </div>
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <input v-model="a.household" type="number"
                @change.capture="(e) => showEditVerification(e.target.value, a.barangay + '|household', filteredData.id, idx)"
                class="focus:outline-blue-500 py-2 w-full overflow-scroll m-0 text-sm">
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </WrapperContent>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import DemographicProfileModal from './DemographicProfileModal.vue';
import Notifcation from "../../../Components/Notifcation.vue"
import SelectTag from '../../../Components/SelectTag.vue';
import axios from 'axios';
import { be_url } from '../../../config/config';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import EditVerification from '../../../Components/EditVerification.vue';

const isShowModal = ref(false);
const selectedYear = ref();
const years = ref([]) // ["current", "2015", "2010", "2000", "1995", "1990"];
const filteredData = ref([]);
const originalData = ref([]);
const resMsg = ref();
const isVerificationModal = ref(false);

// function to show the add modal
function showModal() {
  isShowModal.value = !isShowModal.value;
}

// function to filter out the census years
function filterBy(type, value) {
  selectedYear.value = value;
  filteredData.value = originalData.value.filter(orig => parseInt(orig.census_year) === parseInt(value))[0];
}

// save verification on edit
const isEditVerification = ref(false);
const editedInput = ref({ value: "", id: null, type: "", idx: null });
function showEditVerification(inputValue, type, id, idx) {
  editedInput.value.value = inputValue;
  editedInput.value.type = type;
  editedInput.value.id = id;
  editedInput.value.idx = idx;

  isEditVerification.value = !isEditVerification.value;
}
// function to update the population data on change.capture event
// when done typing it will update the data automatically
function handleEdit(value, id, type, idx) {
  axios.post(be_url + "/populations/edit", {
    id,
    type,
    idx,
    value
  })
    .then(({ data }) => {
      isEditVerification.value = false;

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      filteredData.value = data.populations[0];
      originalData.value = data.populations;
      filteredData.value = originalData.value.filter(orig => parseInt(orig.census_year) === parseInt(selectedYear.value))[0];
    })
    .catch(err => {

      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// create new census
async function handleCreateNewCensus(formData) {
  // TODO: split barangays and religions from the formData.barangays
  const barangays = formData.barangays.map(b => b.census);
  const religions = formData.barangays.map(b => b.religion);

  // TODO: calculate the sum of the total population with male and female only
  let total_population = 0;
  formData.barangays.forEach(b => {
    total_population += parseInt(b.census?.male) + parseInt(b.census?.female);
  })

  return await axios.post(be_url + "/population/add", {
    census_year: formData.census_year,
    total_population: total_population,
    barangays,
    religions,
  })
    .then(({ data }) => {
      filteredData.value = data.populations[0];
      originalData.value = data.populations;
      years.value = data.populations.map(a => a.census_year); // get the years to display in the select tag

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      return data;
    })
    .catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// function to show the delete modal
function showDeleteVerificiationModal() {
  isVerificationModal.value = !isVerificationModal.value;
}

// delete by id, this function is used for delete request
function handleDeleteCensus(id) {
  axios.post(be_url + "/delete-population", {
    id
  })
    .then(({ data }) => {
      filteredData.value = data.populations[0];
      originalData.value = data.populations;

      years.value = data.populations.map(a => a.census_year);
      selectedYear.value = years.value[0];

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      // close the verification delete modal
      isVerificationModal.value = false;
    })
    .catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// this function will get all the populations data from the server
// and store that to originalData where all data will be kepts
// and the filteredData will get the one data only, that will be used for filtering
onMounted(() => {
  axios.get(be_url + "/populations")
    .then(({ data }) => {
      filteredData.value = data.populations[0];
      originalData.value = data.populations;

      years.value = data.populations.map(a => a.census_year);
      selectedYear.value = years.value[0];
    })
    .catch(err => console.log(err));
});

</script>