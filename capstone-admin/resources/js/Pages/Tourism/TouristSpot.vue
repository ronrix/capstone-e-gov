<template>
  <HeadTitle title="Tourist Attractions"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">

      <SearchInput placeholder="search" class="flex-1 mr-2 w-auto mb-3 md:mb-0" @searchFn="searchFn" />
      <div class="flex-1 flex items-center">
        <span class="text-xs text-gray-600 ml-3 mr-1">filter by:</span>
        <SelectTag type="category" :value="filterValue" :filterArray="filterTourism" :filterFn="filterBy"
          addedClass="max-h-[300px] !w-[300px] overflow-y-scroll scrollbar" />

        <!-- filter the deleted data -->
        <span class="text-gray-500 font-bold text-sm mx-2 capitalize"> active: </span>
        <SelectTag type="active" :filterFn="filterDelete" :value="activeData" :filterArray="['active', 'deleted']" />
      </div>

    </div>

    <!-- empty: this will display when there is no data to display -->
    <h5 v-if="isEmpty"
      class="font-bold text-xl capitarize text-red-500 mt-5 border border-x-0 border-b-0 flex items-center">
      <i class="uil uil-folder-times text-3xl"></i>
      Empty Collection
    </h5>
    <div v-if="isLoading" class="flex items-center justify-center">
      <Loading class="w-8 h-8" />
      <p>Loading...</p>
    </div>

    <div v-for="(group, category) in groupedItems" :key="category" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5 capitalize">
          <h3>{{ category }}</h3>
        </span>
        <div class="flex-1 border"></div>
      </div>

      <!-- TouristSpotCard -->
      <TourismCard v-for="data in group" :data="data" :key="data.id" :showTourismModal="showTouristSpotPreviewModal"
        :handleDelete="handleDeleteTouristAttraction" :handle-restore="handleRestore" />
    </div>
    <!-- PreviewModal -->
    <PreviewModal v-if="isTouristSpotPreviewModal" :selectedData="selectedData"
      :showPreviewModal="showTouristSpotPreviewModal" :handleSubmit="handleUpdateTouristAttraction" />

    <!-- add new -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />
    <!-- Add Modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
      :handleCreateSubmit="handleCreateTourismAttraction" :location="true" :category="true" title="tourist attraction" />
  </WrapperContent>
</template>
<script setup>
import { computed, ref, onMounted } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import SelectTag from '../../Components/SelectTag.vue';
import TourismCard from './TourismCard.vue';
import AddBtn from '../../Components/AddModal/AddBtn.vue';
import Notifcation from "../../Components/Notifcation.vue";
import PreviewModal from '../../Components/PreviewModal.vue';

import axios from 'axios';
import { be_url } from "../../config/config";
import Loading from '../../Components/Loading.vue';

const isLoading = ref(true);
const isEmpty = ref(false);
// props
defineProps({
  showTouristSpotPreviewModal: Function,
  data: Object
});

// filter deleted data
const activeData = ref("active");
function filterDelete(type, value) {
  activeData.value = value;
  isLoading.value = true;

  // get request for deleted data
  if (activeData.value === 'deleted') {
    axios.get(be_url + '/tourist-attractions/deleted')
      .then(({ data }) => {
        isLoading.value = false;
        // add deleted data to dataNews and originalDataNews
        if (data.tourism.length) {
          dataTourism.value = data.tourism;
          originalDataTourism.value = data.tourism;
          isEmpty.value = false;
          return;
        }
        // else just render "empty collection" text
        isEmpty.value = true; // set the isEmpty to true, so there would be an indication that data is empty
        dataTourism.value = data.tourism;
        originalDataTourism.value = data.tourism;
      })
      .catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
          resMsg.value = null;
        }, 3000);
      });
    return;
  }
  // else the undeleted data
  axios.get(be_url + '/tourist-attractions')
    .then(({ data }) => {
      isLoading.value = false;
      isEmpty.value = false;
      if (data.tourism) {
        dataTourism.value = data.tourism;
        originalDataTourism.value = data.tourism;
        return;
      }
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

// init variables
const isTouristSpotPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();
const dataTourism = ref([]);
const originalDataTourism = ref([]);

const filterValue = ref("All");
const resMsg = ref();

// get all the categories
const filterTourism = ref([]);
const groupedItems = computed(() => {
  const groups = {};
  for (const item of dataTourism.value) {
    if (!groups[item.category]) {
      groups[item.category] = [];
    }
    groups[item.category].push(item);
  }
  return groups;

}, [dataTourism]);

function filterBy(type, value) {
  filterValue.value = value;

  if (value === "All") {
    dataTourism.value = originalDataTourism.value;
  }
  else {
    dataTourism.value = originalDataTourism.value.filter(el => {
      if (el.category.toLocaleLowerCase() === value.toLowerCase()) {
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
    return d.title.toLowerCase().includes(value.toLowerCase());
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
  if (first_option.length) {
    return first_option;
  }
  if (third_option.length) {
    return third_option;
  }
  return second_option;
}

function searchFn(value) {
  if (value.length) {
    dataTourism.value = searchFilter(value);
    return;
  }
  dataTourism.value = originalDataTourism.value;
}

function showTouristSpotPreviewModal(data) {
  isTouristSpotPreviewModal.value = !isTouristSpotPreviewModal.value;
  selectedData.value = data;
}

// this function is for updating one tourist attraction
async function handleUpdateTouristAttraction(id, formData) {
  return await axios.post(be_url + '/tourist-attraction/edit', {
    id,
    title: formData.title,
    authors: formData.authors,
    description: formData.description,
    location: formData.location,
    category: formData.category,
    newImgs: formData.newImgs,
    deletedImgs: formData.deletedImgIds,
    defaultThumbnailId: formData.defaultThumbnailId
  }, { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataTourism.value = data.tourism;
      originalDataTourism.value = data.tourism;
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
async function handleDeleteTouristAttraction(id) {
  return await axios.post(be_url + '/delete-tourist-spot', { id })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataTourism.value = data.tourism;
      originalDataTourism.value = data.tourism;
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

// restore a news data based on the passed id
async function handleRestore(id) {
  return await axios.post(be_url + "/tourist-attractions/restore", { id }).then(({ data }) => {
    if (data.tourism) {
      dataTourism.value = data.tourism;
      originalDataTourism.value = data.tourism;
    }
    if (!data.tourism.length) {
      isEmpty.value = true;
    }

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    activeData.value = "deleted";
    return data;
  }).catch(err => {
    // set the response msg
    resMsg.value = err.response.data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
  });
}

// function to handle create request
async function handleCreateTourismAttraction(formData) {
  return await axios.post(be_url + "/tourist-attraction/add", {
    title: formData.title,
    authors: formData.authors,
    description: formData.content,
    location: formData.location,
    category: formData.category,
    imgFile: formData.imgFile,
  },
    { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      originalDataTourism.value = data.tourism;
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
    .then(({ data }) => {
      isLoading.value = false;
      dataTourism.value = data.tourism;
      originalDataTourism.value = data.tourism;
      const categories = originalDataTourism.value.map(og => og.category);
      categories.unshift("All");
      filterTourism.value = [...new Set(categories)];
    })
    .catch(err => console.log(err));

});

</script>