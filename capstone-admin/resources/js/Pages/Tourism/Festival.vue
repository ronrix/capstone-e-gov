<template>
  <HeadTitle title="Festival"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">

    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">
      <SearchInput placeholder="search a festival" class="mr-2 w-auto mb-3 md:mb-0" @searchFn="searchFn" />

      <!-- filter the deleted data -->
      <span class="text-gray-500 font-bold text-sm mx-2 capitalize"> active: </span>
      <SelectTag type="active" :filterFn="filterDelete" :value="activeData" :filterArray="['active', 'deleted']" />
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

    <div v-for="data in dataFestival" :key="data.id" class="flex flex-col gap-3 mt-5">
      <!-- TouristSpotCard -->
      <TourismCard :data="data" :key="data.id" :showTourismModal="showTourismModal" :handleDelete="handleDeleteFestival"
        :handle-restore="handleRestore" />
    </div>
    <!-- PreviewModal -->
    <PreviewModal v-if="isFestivalPreviewModal" :selectedData="selectedData" :showPreviewModal="showTourismModal"
      :handleSubmit="handleUpdateFestival" />

    <!-- add new -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />
    <!-- Add Modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
      :handleCreateSubmit="handleCreateFestival" title="festival" />
  </WrapperContent>
</template>
<script setup>
import { ref, onMounted } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import TourismCard from './TourismCard.vue';
import AddBtn from '../../Components/AddModal/AddBtn.vue';
import Notifcation from "../../Components/Notifcation.vue";
import PreviewModal from '../../Components/PreviewModal.vue';

import axios from 'axios';
import { be_url } from "../../config/config";
import Loading from '../../Components/Loading.vue';
import SelectTag from '../../Components/SelectTag.vue';

// init variables
const isFestivalPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();
const dataFestival = ref([]);
const originalDataFestival = ref([]);

const resMsg = ref();
const isLoading = ref(true);
const isEmpty = ref(false);

// filter deleted data
const activeData = ref("active");
function filterDelete(type, value) {
  activeData.value = value;
  isLoading.value = true;

  // get request for deleted data
  if (activeData.value === 'deleted') {
    axios.get(be_url + '/festivals/deleted')
      .then(({ data }) => {
        isLoading.value = false;
        // add deleted data to dataNews and originalDataNews
        if (data.festivals.length) {
          dataFestival.value = data.festivals;
          originalDataFestival.value = data.festivals;
          isEmpty.value = false;
          return;
        }
        // else just render "empty collection" text
        isEmpty.value = true; // set the isEmpty to true, so there would be an indication that data is empty
        dataFestival.value = data.festivals;
        originalDataFestival.value = data.festivals;
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
  axios.get(be_url + '/festivals')
    .then(({ data }) => {
      isLoading.value = false;
      isEmpty.value = false;
      if (data.festivals) {
        dataFestival.value = data.festivals;
        originalDataFestival.value = data.festivals;
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

function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// search filtering
function searchFilter(value) {
  // first option: will check the titlePosition match value
  const first_option = dataFestival.value.filter(d => {
    return d.title.toLowerCase().includes(value.toLowerCase());
  });

  // first option: will check the description match value
  const second_option = dataFestival.value.filter(d => {
    return d.description.toLowerCase().includes(value.toLowerCase());
  });

  // returning the data sorted by date
  if (first_option.length) {
    return first_option;
  }
  return second_option;
}

function searchFn(value) {
  if (value.length) {
    dataFestival.value = searchFilter(value);
    return;
  }
  dataFestival.value = originalDataFestival.value;
}

function showTourismModal(data) {
  isFestivalPreviewModal.value = !isFestivalPreviewModal.value;
  selectedData.value = data;
}

// this function is for updating one tourist attraction
async function handleUpdateFestival(id, formData) {
  return await axios.post(be_url + '/festival/edit', {
    id,
    title: formData.title,
    authors: formData.authors,
    description: formData.description,
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

      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
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
async function handleDeleteFestival(id) {
  return await axios.post(be_url + '/delete-festival', { id })
    .then(({ data }) => {

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
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
  return await axios.post(be_url + "/festivals/restore", { id }).then(({ data }) => {
    if (data.festivals) {
      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
    }
    if (!data.festivals.length) {
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
async function handleCreateFestival(formData) {
  return await axios.post(be_url + "/festival/add", {
    title: formData.title,
    authors: formData.authors,
    description: formData.content,
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

      originalDataFestival.value = data.festivals;
      dataFestival.value = data.festivals;
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
  axios.get(be_url + '/festivals')
    .then(({ data }) => {
      isLoading.value = false;
      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
    })
    .catch(err => console.log(err));

});

</script>