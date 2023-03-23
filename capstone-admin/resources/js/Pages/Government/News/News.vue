<template>
  <HeadTitle title="News"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search news" class="bg-transparent outline-none" />
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

    <!-- news card -->
    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <CardNews :handleDelete="handleDelete" v-for="data in group.items" :data="data" :showPreviewModal="showPreviewModal" />
      <!-- no result  -->
      <div v-if="!group.items.length" class="font-bold text-gray-800">No results found!</div>
    </div>
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" :handleSubmit="handleSubmit" />

    <!-- add new news btn -->
    <AddBtn :showAddModal="showAddNewModal" />

    <!-- add modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" :handleCreateSubmit="handleCreateSubmit" />
  </WrapperContent>
</template>

<script setup>
import Notifcation from "../../../Components/Notifcation.vue";
import SelectTag from '../../../Components/SelectTag.vue';
import CardNews from './CardNews.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';

import { ref, computed, onMounted } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import { searchFilter } from '../../../utils/searchFilter';
import { be_url } from "../../../config/config";
import { dateFormat } from '../../../utils/dateFormat';
import axios from 'axios';
import AddBtn from "../../../Components/AddModal/AddBtn.vue";

const resMsg = ref();
// delete a news data based on the passed id
function handleDelete(id, deleteRef) {
  axios.post(be_url + "/delete-news/" + id, { id }).then(({data}) => {
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
    originalDataNews.value = data.news;
    dataNews.value = data.news;
  });
}

// handle the submit function to update the new news
function handleSubmit(id, formData) {
  // const form = new FormData();
  // form.append('id', selectedData.id);
  // form.append('title', formData.title);
  // form.append('description', formData.description);
  // form.append('imgFile', formData?.imgFile);

  axios.post(be_url + "/news/edit", { id, title: formData.title, description: formData.description, imgFile: formData.imgFile }, { headers: { "Content-Type": "multipart/form-data" }})
  .then(response => {
    originalDataNews.value = response.data.news;
    dataNews.value = response.data.news;

    // set the response msg
    resMsg.value = response.data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
  })
  .catch(err => console.log(err));
}

// submit form
function handleCreateSubmit(formData) {
  axios.post(be_url + "/news/create", { title: formData.title, description: formData.content, imgFile: [...formData.imgFile] }, { headers: { "Content-Type": "multipart/form-data" }})
  .then(response => {
    originalDataNews.value = response.data.news;
    dataNews.value = response.data.news;

    // set the response msg
    resMsg.value = response.data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
  })
  .catch(err => console.log(err));
}

// sort/filter function for select and input year
const filterMonth = ref("All");
const filterYear= ref("All");
const filterMonths = ["All", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const filterYears = [ "All", 2023, 2022, 2021, 2020, 2019, 2018, 2017, ];

function filterBy(type, value) {
  if(type === "month") {
    // update the value of filterMonth with the selected one
    filterMonth.value = value;

    // if value is "all" select all the data
    if(value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataNews.value = originalDataNews.value;
      return;
    }

    // filter by month
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) || date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    }); 
    dataNews.value = groups;
  }
  else {
    // update the value of filterYear selected one
    filterYear.value = value;

    // if value is "all" select all the data
    if(value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataNews.value = originalDataNews.value;
      return;
    }

    // filter by year
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) || date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    }); 
    dataNews.value = groups;
  }
 
}

const isPreviewModal = ref(false); // this state is for toggling/showing preview modal
const selectedData = ref(); // this state for vieing the data in the preview modal
const dataNews = ref([]); // this state is going to be used for modifying like filter or search function
const originalDataNews = ref([]); // this state will act as the original data that don't change

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// fetch the news data from backend
onMounted(() => {
  // requesting data from /news
  axios.get(be_url + "/news").then(({data}) => {
      dataNews.value = data.news; 
      originalDataNews.value = data.news; 
  });
});

function showPreviewModal(data) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}

// data filtering for search input 
const search = ref("");
const groupData = computed(() => {
  let groups = {};

  // this will group data by month
  dataNews?.value?.forEach((item) => {
    const month = new Date(item.created_at).toLocaleString('default', { month: 'short', year: "numeric" });
    // group item by month
    if (!groups[month]) {
      groups[month] = { month, items: [] };
    }
    groups[month].items.push(item);
  });

  // converting the object to array of objects;
  // from {jan: [], feb: []} -> [{jan: [], feb: []}]
  // to make it iterable
  groups = Object.values(groups);

  // after making the 'groups' iterable we can now sort them by date
  // latest -> oldest
  groups.sort((a, b) => {
    const dateA = new Date(a.items[0].date);
    const dateB = new Date(b.items[0].date);
    return dateB - dateA;
  });

  const newGroup = convertToObjectArray(groups);
  return newGroup;
}, [dataNews]);

// then this function will turn the array of objects to an object of array
// from [{jan: [], feb: []}] -> {jan: [], feb: []} 
function convertToObjectArray(groups) {
  return groups.reduce((acc, group) => {
    acc[group.month] = group;
    return acc;
  }, {});
}

const searchData = ref([{ month: "Search Results", items: []}]);
const dataToLoop = computed(() => {
  if(search.value.length) {
    searchData.value[0].items = searchFilter(dataNews.value, search);
    return searchData;
  }
  return groupData;
}, [search, filterMonth, filterYear, dataNews, originalDataNews]);


</script>

<style lang="scss" scoped>

</style>