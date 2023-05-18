<template>
  <HeadTitle title="Apartments"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!--Remember to add filter for both type and title-->
    <!-- search filter and select filtering -->
    <div class="w-full flex flex-col md:flex-row md:self-center items-center mb-5">
      <SearchInput class="flex-1 w-1/2 mr-3" @searchFn="searchFn" placeholder="Search for apartments" />

      <div class="flex-1 flex w-full flex-col md:flex-row">
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


    <div v-else class="flex flex-wrap gap-3">
      <CardApartment v-for="data in filteredData" :key="data.id" :data="data" :showPreviewModal="showPreviewModal"
        :handle-delete="handleDeleteApartment" :handle-restore="handleRestore" />
    </div>

    <!-- preview the whole information of apartments using PreviewModal -->
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal"
      :handleSubmit="handleUpdateApartment" :is-apartment="true" />

    <button @click="showAddModal"
      class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text 2xl text-white"></i>
    </button>

    <AddModal :showAddModal="showAddModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
      :handleCreateSubmit="handleCreateApartment" title="Aartment" :category="true" :location="true"
      :is-apartment="true" />
  </WrapperContent>
</template>

<script setup>
import CardApartment from './CardApartment.vue';
import Notifcation from "../../../Components/Notifcation.vue";
import SelectTag from "../../../Components/SelectTag.vue";

import { ref, onMounted } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue'
import SearchInput from '../../../Components/SearchInput.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';
import axios from 'axios';
import { be_url } from '../../../config/config';
import Loading from '../../../Components/Loading.vue';

const isEmpty = ref(false);
const isLoading = ref(true);
const isPreviewModal = ref(false);
const selectedData = ref();
const dataApartments = ref([]);
const resMsg = ref();

// filter deleted data
const activeData = ref("active");
function filterDelete(type, value) {
  activeData.value = value;
  isLoading.value = true;

  // get request for deleted data
  if (activeData.value === 'deleted') {
    axios.get(be_url + '/apartments/deleted')
      .then(({ data }) => {
        isLoading.value = false;
        // add deleted data 
        if (data.apartments.length) {
          dataApartments.value = data.apartments;
          filteredData.value = [...data.apartments];
          isEmpty.value = false;
          return;
        }

        // else just render "empty collection" text
        isEmpty.value = true; // set the isEmpty to true, so there would be an indication that data is empty
        dataApartments.value = data.apartments;
        filteredData.value = [...data.apartments];
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
  axios.get(be_url + '/apartments')
    .then(({ data }) => {
      isLoading.value = false;
      isEmpty.value = false;
      if (!data.apartments.length) isEmpty.value = true;
      if (data.apartments) {
        dataApartments.value = data.apartments;
        filteredData.value = [...data.apartments];
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

const isAddNewModal = ref(false);
function showPreviewModal(data) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}


// to show the add modal when add button was clicked
function showAddModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// Should Add data filtering search input
const filteredData = ref(searchFilter(""));
function searchFilter(value) {
  const first_option = dataApartments.value.filter(data => {
    return data.title?.toLowerCase().includes(value?.toLowerCase());
  });

  const second_option = dataApartments.value.filter(data => {
    return data.description.toLowerCase().includes(value?.toLowerCase());
  });
  const third_option = dataApartments.value.filter(data => {
    return data.category.toLowerCase().includes(value?.toLowerCase());
  });

  if (first_option.length) {
    return first_option;
  }
  else if (third_option.length) {
    return third_option;
  }
  return second_option;
}

function searchFn(value) {
  filteredData.value = searchFilter(value);
}

// this function is for updating one tourist attraction
async function handleUpdateApartment(id, formData) {
  return await axios.post(be_url + '/apartment/edit', {
    id,
    title: formData.title,
    authors: formData.title,
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

      dataApartments.value = data.apartments;
      filteredData.value = [...data.apartments];
      return data;
    })
    .catch(err => {
      // set the response msg
      console.log(err);
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

    });
}

// function to handle the delete request
async function handleDeleteApartment(id) {
  return await axios.post(be_url + '/delete-apartment', { id })
    .then(({ data }) => {

      if (!data.apartments.length) isEmpty.value = true; // display "empty collection" if apartments is empty

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataApartments.value = data.apartments;
      filteredData.value = [...data.apartments];
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
  return await axios.post(be_url + "/apartment/restore", { id }).then(({ data }) => {

    if (!data.apartments.length) isEmpty.value = true; // display "empty collection" if apartments is empty
    if (data.apartments) {
      dataApartments.value = data.apartments;
      filteredData.value = [...data.apartments];
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
async function handleCreateApartment(formData) {
  return await axios.post(be_url + "/apartment/add", {
    title: formData.title,
    authors: formData.title,
    description: formData.content,
    location: formData.location,
    category: formData.category,
    imgFile: formData.imgFile,
  },
    { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {

      // set isEmpty to false if since there would be a new data created
      if (isEmpty.value) isEmpty.value = false;

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataApartments.value = data.apartments;
      filteredData.value = [...data.apartments];
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

// get all data from the server
onMounted(() => {
  axios.get(be_url + "/apartments")
    .then(({ data }) => {
      isLoading.value = false;

      if (!data.apartments.length) {
        isEmpty.value = true;
      }

      dataApartments.value = data.apartments;
      filteredData.value = [...data.apartments];
    })
    .catch(err => console.log(err));
});

</script>