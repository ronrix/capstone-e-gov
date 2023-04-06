<template>
  <HeadTitle title="Apartments"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!--Remember to add filter for both type and title-->
    <!-- search filter and select filtering -->
    <div class="w-full flex flex-col md:flex-row md:self-center items-center mb-5">
        <SearchInput class="w-1/2 mr-3" @searchFn="searchFn" placeholder="Search for apartments" />
        <SelectTag type="category" :value="filterValue" :filterFn="filterBy" :filterArray="filterApartments" addedClass="max-h-[300px] !w-[200px] overflow-y-scroll scrollbar" />
    </div>

    <div class="flex flex-wrap gap-2">
      <CardApartment v-for="data in filteredData" :data="data" :showPreviewModal="showPreviewModal" />
    </div>

    <!-- preview the whole information of apartments using PreviewModal -->
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" :handleSubmit="handleUpdateApartment" />
    
    <button @click="showAddModal" class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text 2xl text-white"></i>
    </button>

    <AddModal :showAddModal="showAddModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" :handleCreateSubmit="handleCreateApartment" title="Aartment" :category="true" :location="true" />
    </WrapperContent>
</template>

<script setup>
import CardApartment from './CardApartment.vue';
import Notifcation from "../../../Components/Notifcation.vue";
import SelectTag from "../../../Components/SelectTag.vue";

import { ref, computed, onMounted } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue'
import SearchInput from '../../../Components/SearchInput.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';
import axios from 'axios';
import { be_url } from '../../../config/config';

const isPreviewModal = ref(false);
const selectedData = ref();
const dataApartments = ref([]);
const resMsg = ref();
const filterValue = ref("All");
const filterApartments = computed(() => {
    const categories = dataApartments.value.map(og => og.category);
    categories.unshift("All");
    return new Set(categories);
});

const isAddNewModal = ref(false);
function showPreviewModal(data){
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}

// function to filter the data based on categories
function filterBy(type, value) {
    filterValue.value = value;

    if (value === "All") {
        filteredData.value = dataApartments.value;
    }
    else {
        filteredData.value = dataApartments.value.filter(el => {
            if (el.category.toLocaleLowerCase() === value.toLowerCase()) {
                return el;
            }
        });
    }
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

  if(first_option.length) {
    return first_option;
  }
  else if(third_option.length){
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
async function handleDeleteApartment(id, deleteRef) {
    return await axios.post(be_url + '/delete-apartment', { id })
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

// function to handle create request
async function handleCreateApartment(formData) {
    return await axios.post(be_url + "/apartment/add", {
        title: formData.title,
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
  .then(({data}) => {
    dataApartments.value = data.apartments;
    filteredData.value = [...data.apartments];
    filterApartments.value = data.apartments.map(apartment => apartment.category);
  })
  .catch(err => console.log(err));
});

</script>