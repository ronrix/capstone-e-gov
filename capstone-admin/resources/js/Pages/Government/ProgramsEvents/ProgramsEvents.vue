<template>
  <HeadTitle title="Programs & Events"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- preview of programs and events modal using PreviewModal -->
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" :handleSubmit="handleSubmitUpdate" />

   <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search programs or events" class="bg-transparent outline-none" />
      </label> 

      <!-- filter by date -->
      <!-- month -->
      <span class="text-gray-500 font-bold text-sm mx-2 capitalize">
        month:
      </span>
      <SelectTag type="month" :filterFn="filterBy" :value="filterMonth" :filterArray="filterMonths" />
      <!-- year -->
      <span class="text-gray-500 font-bold text-sm mx-2 capitalize">
        year:
      </span>
      <SelectTag type="year" :filterFn="filterBy" :value="filterYear" :filterArray="filterYears" />
    </div>

    <!-- empty: this will display when there is no data to display -->
    <h5 v-if="isEmpty" class="font-bold text-2xl capitarize text-red-600 mt-5 border border-x-0 border-b-0">
      <i class="uil uil-folder-times text-5xl"></i>
      Empty Collection
    </h5>  
    <Loading class="w-14 h-14 mx-auto" v-if="isLoading" />

    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <ProgramsEventsCard v-for="data in group.items" :data="data" :showPreviewModal="showPreviewModal" :handleDelete="handleDelete" />
    </div>

    <!-- add modal -->
    <AddModal :showAddModal="showAddModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" title="Programs|Events" :handleCreateSubmit="handleCreateSubmit" :location="true" />
    <AddBtn :showAddModal="showAddModal" class="z-20" />
  </WrapperContent>
</template>

<script setup>
import AddModal from '../../../Components/AddModal/AddModal.vue';
import AddBtn from '../../../Components/AddModal/AddBtn.vue';
import ProgramsEventsCard from './ProgramsEventsCard.vue';
import { searchFilter } from '../../../utils/searchFilter';

import axios from 'axios';
import { computed, ref, onMounted } from 'vue';
import PreviewModal from '../../../Components/PreviewModal.vue';
import { be_url } from '../../../config/config';
import Notifcation from '../../../Components/Notifcation.vue';
import SelectTag from '../../../Components/SelectTag.vue';
import { dateFormat } from '../../../utils/dateFormat';
import Loading from '../../../Components/Loading.vue';

const isAddNewModal = ref(false);
const resMsg = ref();
const isEmpty = ref(false);
const isLoading = ref(true);

function showAddModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

const originalDataProgramsEvents = ref([]); // this is the state where to store the data that was received from the server
const dataProgramsEvents = ref([]); // this is the state where to store the data that was received from the server

// fetch the news data from backend
onMounted(() => {
  // requesting data from /news
  axios.get(be_url + "/programs-and-events").then(({data}) => {
    originalDataProgramsEvents.value = data.programsEvents;
    dataProgramsEvents.value = data.programsEvents; 
    if(!dataProgramsEvents.value.length) isEmpty.value = true;
    isLoading.value = false;
  }).catch(err => console.log(err));
});

// delete programs and events based on the passed id
function handleDelete(id, deleteRef) {
   axios.post(be_url + "/delete-programs-events/", { id }).then(({data}) => {
    // this will remove the displaying of the delete modal
    deleteRef.classList.remove("!translate-y-0");
    deleteRef.classList.remove("!translate-x-0");

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);


    // this will update the state variable of the news
    dataProgramsEvents.value = data.programsEvents;
  });
}

// functions to show the preview modal
const isPreviewModal = ref(false);
const selectedData = ref();
function showPreviewModal(data) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}

// search filter
const search = ref("");

// sort/filter function for select and input year
const filterMonth = ref("All");
const filterYear= ref("All");
const filterMonths = ["All", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const filterYears = [ "All", 2023, 2022, 2021, 2020, 2019, 2018, 2017, ];

// filter function
function filterBy(type, value) {
  if(type === "month") {
    // update the value of filterMonth with the selected one
    filterMonth.value = value;

    // if value is "all" select all the data
    if(value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataProgramsEvents.value = originalDataProgramsEvents.value;
      return;
    }

    // filter by month
    // and set the new value to dataProgramsEvents to re-render the filtered news
    const groups = originalDataProgramsEvents.value.filter(group => {
      const date = dateFormat(group.created_at);
      if(filterYear.value === "All") { // check if the filterYear is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase());
      }
      if(filterMonth.value === "All") { // check if the filterMonth is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
      }
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) && date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    }); 
    dataProgramsEvents.value = groups;
  }
  else {
    // update the value of filterYear selected one
    filterYear.value = value;

    // if value is "all" select all the data
    if(value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataProgramsEvents.value = originalDataProgramsEvents.value;
      return;
    }

    // filter by year
    // and set the new value to dataProgramsEvents to re-render the filtered news
    const groups = originalDataProgramsEvents.value.filter(group => {
      const date = dateFormat(group.created_at);
      if(filterMonth.value === "All") { // check if the filterMonth is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
      }
      if(filterYear.value === "All") { // check if the filterYear is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase());
      }
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) && date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    }); 
    dataProgramsEvents.value = groups;
  }
 
}

const groupData = computed(() => {
  let groups = {};

  dataProgramsEvents.value.forEach((item) => {
    const month = new Date(item.created_at).toLocaleString('default', { month: 'short', year: "numeric" });
    // group item by month
    if (!groups[month]) {
      groups[month] = { month, items: [] };
    }
    groups[month].items.push(item);
  });

  groups = Object.values(groups);

  groups.sort((a, b) => {
    const dateA = new Date(a.items[0].date);
    const dateB = new Date(b.items[0].date);
    return dateB - dateA;
  });

  return groups.reduce((acc, group) => {
    acc[group.month] = group;
    return acc;
  }, {});
});

const searchData = ref([{ month: "Search Results", items: []}]);
const dataToLoop = computed(() => {
  if(search.value.length) {
    searchData.value[0].items = searchFilter(dataProgramsEvents.value, search);
    return searchData;
  }
  return groupData;
}, [search, dataProgramsEvents, originalDataProgramsEvents]);

// submit function to handle update the programs and events
function handleSubmitUpdate(id, formData) {
  axios.post(be_url + "/programs-and-events/edit", { 
    id, 
    title: formData.title, 
    description: formData.description, 
    location: formData.location,
    newImgs: formData.newImgs,
    deletedImgs: formData.deletedImgIds,
    defaultThumbnailId: formData.defaultThumbnailId
  }, { headers: { "Content-Type": "multipart/form-data" }})
  .then(({ data }) => {
    dataProgramsEvents.value = data.programsEvents;

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
  })
  .catch(err => console.log(err));
}

// handle the submit function to update the new news
function handleCreateSubmit(formData) {
  axios.post(be_url + "/programs-and-events/add", { title: formData.title, location: formData.location, description: formData.content, imgFile: formData.imgFile }, { headers: { "Content-Type": "multipart/form-data" }})
  .then(({ data }) => {
    dataProgramsEvents.value = data.programsEvents;

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
  })
  .catch(err => console.log(err));
}

</script>

<style scoped></style>