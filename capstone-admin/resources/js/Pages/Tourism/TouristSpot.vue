<template>
  <WrapperContent class="flex flex-col gap-5">
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">

      <SearchInput placeholder="search" class="mr-2 w-auto mb-3 md:mb-0" @searchFn="searchFn"/>
      <SelectTag type="category" :value="filterValue" :filterArray="filterTourism" :filterFn="filterBy" />
    </div>

    <div v-for="(group, category) in groupedItems" :key="category" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5"><h3>{{ category }}</h3></span>
        <div class="flex-1 border"></div>
      </div>

    <!-- TouristSpotCard -->
    <TouristSpotCard  v-for="data in group" :data="data" :key="data.id" :showTouristSpotPreviewModal="showTouristSpotPreviewModal" :handleDelete="handleDeleteTouristAttraction" />
    </div>
    <!-- PreviewModal -->
    <TouristSpotPreviewModal :selectedData="selectedData" :showTouristSpotPreviewModal="showTouristSpotPreviewModal"
      :handleUpdate="handleUpdateTouristAttraction"
      v-if="isTouristSpotPreviewModal" />
    <!-- add new -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />
    <!-- Add Modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
  </WrapperContent>
</template>
<script setup>
import { computed, ref, onMounted } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import TouristSpotPreviewModal from '../../Components/TouristSpotPreviewModal.vue'
import SelectTag from '../../Components/SelectTag.vue';
import TouristSpotCard from './TouristSpotCard.vue';
import AddBtn from '../../Components/AddModal/AddBtn.vue';
import Notifcation from "../../Components/Notifcation.vue";

import axios from 'axios';
import { be_url } from "../../config/config";

// props
defineProps({
  showTouristSpotPreviewModal: Function,
  data: Object
});

// init variables
const isTouristSpotPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();
const dataTourism = ref([]);
const originalDataTourism = ref([]);

const filterTourism = ['All', 'Tourist Attraction', 'Church', 'Restaurant'];
const filterValue = ref("All");
const toFilter = ref(dataTourism);
const resMsg = ref();

const groupedItems = computed(() => {
  const groups = {};
  for (const item of toFilter.value) {
    if (!groups[item.category]) {
      groups[item.category] = [];
    }
    groups[item.category].push(item);
  }
  return groups;

},[toFilter]);

function filterBy(type, value){
  filterValue.value = value;

  if(value === "All") {
    toFilter.value = originalDataTourism.value;
  }
  else {
    toFilter.value = dataTourism.value.filter(el => {
      if(el.category.toLocaleLowerCase() === value.toLowerCase()) {
        return el;
      }
    });
  }
}

function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// search filtering
function searchFilter(value) {
  // first option: will check the titlePosition match value
  const first_option = dataTourism.value.filter(d => {
    return d.name.toLowerCase().includes(value.toLowerCase());
  });

  // first option: will check the description match value
  const second_option = dataTourism.value.filter(d => {
    return d.location.toLowerCase().includes(value.toLowerCase());
  });
  
  // first option: will check the description match value
  const third_option = dataTourism.value.filter(d => {
    return d.category.toLowerCase().includes(value.toLowerCase());
  });

  // returning the data sorted by date
  if(first_option.length) {
    return first_option;
  }
  if(third_option.length) {
    return third_option;
  }
  return second_option;
}

function searchFn(value) {
  if(value.length) {
    toFilter.value = searchFilter(value);
    return;
  }
  toFilter.value = originalDataTourism.value;
}

function showTouristSpotPreviewModal(data) {
  isTouristSpotPreviewModal.value = !isTouristSpotPreviewModal.value;
  selectedData.value = data;
}

// this function is for updating one tourist attraction
async function handleUpdateTouristAttraction(formData, id) {
  return await axios.post(be_url + '/tourist-attraction/edit', {
    id,
    name: formData.name,
    description: formData.description,
    location: formData.location,
    img: formData.newImg,
  }, { headers: { "Content-Type": "multipart/form-data" }})
  .then(({data}) => {

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    dataTourism.value = data.tourism;
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

// function to handle the delete request
async function handleDeleteTouristAttraction(id, deleteRef) {
  return await axios.post(be_url + '/delete-tourist-spot', { id }) 
  .then(({data}) => {
    // this will remove the displaying of the delete modal
    deleteRef.classList.remove("!translate-y-0");
    deleteRef.classList.remove("!translate-x-0");

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    dataTourism.value = data.tourism;
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

// get the data from the server
onMounted(() => {
  axios.get(be_url + '/tourist-attractions')
  .then(({data}) => {
    dataTourism.value = data.tourism;
    originalDataTourism.value = data.tourism;
  })
  .catch(err => console.log(err));

});

</script>