<template>
  <HeadTitle title="Programs & Events"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- preview of programs and events modal using PreviewModal -->
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" />

   <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search programs or events" class="bg-transparent outline-none" />
      </label> 
    </div>

    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <ProgramsEventsCard v-for="data in group.items" :data="data" :showPreviewModal="showPreviewModal" :handleDelete="handleDelete" />
    </div>

    <!-- add modal -->
    <AddModal :showAddModal="showAddModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
    <AddBtn :showAddModal="showAddModal" />
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

const isAddNewModal = ref(false);
const resMsg = ref();

function showAddModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

const dataProgramsEvents = ref([]); // this is the state where to store the data that was received from the server

// fetch the news data from backend
onMounted(() => {
  // requesting data from /news
  axios.get(be_url + "/programs-and-events").then(({data}) => {
    dataProgramsEvents.value = data.programsEvents; 
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
}, [search, dataProgramsEvents]);

</script>

<style scoped></style>