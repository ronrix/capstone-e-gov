<template>
  <HeadTitle title="Festval"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">

    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">
      <SearchInput placeholder="search a festival" class="mr-2 w-auto mb-3 md:mb-0" @searchFn="searchFn" />
    </div>

    <div v-for="data in dataFestival" :key="category" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5 capitalize">
          <h3>{{ category }}</h3>
        </span>
        <div class="flex-1 border"></div>
      </div>

      <!-- TouristSpotCard -->
      <TourismCard :data="data" :key="data.id" :showTourismModal="showTourismModal"
        :handleDelete="handleDeleteFestival" />
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

// init variables
const isFestivalPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();
const dataFestival = ref([]);
const originalDataFestival = ref([]);

const resMsg = ref();

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
async function handleDeleteFestival(id, deleteRef) {
  return await axios.post(be_url + '/delete-festival', { id })
    .then(({ data }) => {
      // this will remove the displaying of the delete modal
      deleteRef.classList.remove("!translate-y-0");
      deleteRef.classList.remove("!translate-x-0");

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
      console.log(dataFestival);
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

// function to handle create request
async function handleCreateFestival(formData) {
  return await axios.post(be_url + "/festival/add", {
    title: formData.title,
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
      console.log(data);
      dataFestival.value = data.festivals;
      originalDataFestival.value = data.festivals;
    })
    .catch(err => console.log(err));

});

</script>