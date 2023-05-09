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

    <DemographicProfileModalEdit v-if="isEditModal" :handle-edit="handleEdit" :data="filteredData"
      :close-modal="showEditModal" />

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

      <h4 class="font-[600] text-xl" v-if="!originalData?.length">No census yet!</h4>
      <div v-else>
        <button @click="showEditModal"
          class="px-3 bg-blue-300 rounded-md text-blue-600 mb-2 hover:bg-blue-600 hover:text-blue-400 mr-3 text-sm">edit</button>
        <button @click="showDeleteVerificiationModal"
          class="px-3 bg-red-300 rounded-md text-red-600 mb-2 hover:bg-red-400 hover:text-red-200 text-sm">
          <i class="uil uil-times-circle"></i>
          delete this census
        </button>

        <table class="text-left w-full">
          <thead>
            <tr class="bg-neutral-200 text-xs md:text-sm">
              <th class="px-2 text-center"><i class="uil uil-list-ui-alt"></i></th>
              <th class="pl-2 py-2 text-neutral-600">
                Barangay
                <i id="barangays" @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Male
                <i id="male" @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Female
                <i id="female" @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Religion
              </th>
              <th class="pl-2 py-2 text-neutral-600">
                Number of Household
                <i id="household" @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
              </th>
            </tr>
          </thead>
          <tbody v-if="filteredData?.barangays">
            <tr v-for="a, idx in JSON.parse(filteredData?.barangays)" :key="idx"
              class="text-xs md:text-sm font-medium border">
              <td class="bg-white text-center">{{ idx + 1 }}</td>
              <td class="bg-white border pl-2 border-l-0"> {{ a.barangay }} </td>
              <td class="bg-white border pl-2 border-l-0"> {{ a.male }} </td>
              <td class="bg-white border pl-2 border-l-0"> {{ a.female }} </td>
              <td class="bg-white border pl-2 border-l-0">
                <div class="scrollbar">
                  <div v-for="rel, relId in JSON.parse(filteredData.religion)[idx]" :key="relId"
                    class="flex items-center text-sm">
                    <div class="capitalize font-semibold">{{ rel.religion }}: <span class="font-thin">{{ rel.count
                    }}</span></div>
                  </div>
                </div>
              </td>
              <td class="bg-white border pl-2 border-l-0">{{ a.household }} </td>
            </tr>
          </tbody>
        </table>
      </div>
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
import DemographicProfileModalEdit from "./DemographicProfileModalEdit.vue";

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

// function to show the edit modal
const isEditModal = ref(false)
function showEditModal() {
  isEditModal.value = !isEditModal.value;
}

// function to update the population data on change.capture event
// when done typing it will update the data automatically
async function handleEdit(formData, id) {
  // TODO: calculate the sum of the total population with male and female only
  let total_population = 0;
  formData.barangays.forEach(b => {
    total_population += parseInt(b.male) + parseInt(b.female);
  })

  return await axios.post(be_url + "/populations/edit", {
    id,
    census_year: formData.census_year,
    total_population: total_population,
    barangays: formData.barangays,
    religions: formData.religion,
  })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      filteredData.value = data.populations[0];
      originalData.value = data.populations;
      filteredData.value = originalData.value.filter(orig => parseInt(orig.census_year) === parseInt(selectedYear.value))[0];

      return data
    })
    .catch(err => {

      // set the response msg
      resMsg.value = err.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      return;
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
      if (!data.populations.length) {
        filteredData.value = [];
        originalData.value = data.populations;
        years.value = [];
        selectedYear.value = "";
      }
      else {
        filteredData.value = data.populations[0];
        originalData.value = data.populations;
        years.value = data.populations.map(a => a.census_year);
        selectedYear.value = years.value[0];
      }

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

// sort the barangays "increase" or "decrease"
const sortMale = ref(false);
const sortFemale = ref(false);
const sortBarangay = ref(false);
const sortHousehold = ref(false);
function sortFn(e) {
  const id = e.target.id;
  if (id === 'male') {
    sortMale.value = !sortMale.value;
    filteredData.value.barangays = JSON.stringify(JSON.parse(filteredData.value.barangays).sort((a, b) => {
      if (sortMale.value) {
        return a.male < b.male;
      }
      return a.male > b.male;
    }));
  }
  else if (id === 'female') {
    sortFemale.value = !sortFemale.value;
    filteredData.value.barangays = JSON.stringify(JSON.parse(filteredData.value.barangays).sort((a, b) => {
      if (sortFemale.value) {
        return a.female < b.female;
      }
      return a.female > b.female;
    }));
  }
  else if (id === 'household') {
    sortHousehold.value = !sortHousehold.value;
    filteredData.value.barangays = JSON.stringify(JSON.parse(filteredData.value.barangays).sort((a, b) => {
      if (sortHousehold.value) {
        return a.household < b.household;
      }
      return a.household > b.household;
    }));
  }
  else { // barangays
    sortBarangay.value = !sortBarangay.value;
    filteredData.value.barangays = JSON.stringify(JSON.parse(filteredData.value.barangays).sort((a, b) => {
      if (sortBarangay.value) {
        return a.barangay < b.barangay;
      }
      return a.barangay > b.barangay;
    }));
  }
}

// this function will get all the populations data from the server
// and store that to originalData where all data will be kepts
// and the filteredData will get the one data only, that will be used for filtering
onMounted(() => {
  axios.get(be_url + "/populations")
    .then(({ data }) => {
      if (data?.populations?.length) {
        filteredData.value = data?.populations[0];
        originalData.value = data?.populations;
        years.value = data?.populations?.map(a => a.census_year);
        selectedYear.value = years.value[0];
      }
    })
    .catch(err => console.log(err));
});

</script>