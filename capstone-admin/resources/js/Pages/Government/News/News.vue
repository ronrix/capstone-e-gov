<template>
  <HeadTitle title="News"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">
    <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search news" class="bg-transparent outline-none" />
      </label> 

      <!-- filter by date -->
      <!-- month -->
      <span class="text-gray-500 font-bold text-sm mx-2 capitalize">
        month:
      </span>
      <select id="month" @change="filterBy" :value="filterMonth" class="bg-white px-3 font-bold rounded-md text-gray-600 text-sm">
        <option v-for="month in filterMonths" :value="month">{{ month }}</option>
      </select>
      <!-- year -->
      <span class="text-gray-500 font-bold text-sm mx-2 capitalize">
        year:
      </span>
      <input id="year" @change="filterBy" :value="filterYear" type="number" min="2000" :max="new Date().getFullYear()" class="text-sm text-gray-600 font-bold px-2">
    </div>

    <!-- news card -->
    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <CardNews v-for="data in group.items" :data="data" :showPreviewModal="showPreviewModal" />
      <!-- no result  -->
      <div v-if="!group.items.length" class="font-bold text-gray-800">No results found!</div>
    </div>
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" />

    <!-- add new news btn -->
    <button @click="showAddNewModal" class="z-20 rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text-2xl text-white"></i>
    </button>

    <!-- add modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
  </WrapperContent>
</template>

<script setup>
import CardNews from './CardNews.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';

import { ref, computed, onMounted } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import { searchFilter } from '../../../utils/searchFilter';
import { be_url } from "../../../config/config";
import { dateFormat } from '../../../utils/dateFormat';


// sort/filter function for select and input year
const filterMonth = ref("All");
const filterYear= ref(new Date().getFullYear());
const filterMonths = ["All", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function filterBy(e) {
  if(e.target.id === "month") {
    filterMonth.value = e.target.value;

    // if value is "all" select all the data
    if(e.target.value === "All") {
      dataNews.value = originalDataNews.value;
      return;
    }

    // update the value of filterMonth with the selected one
    filterMonth.value = e.target.value;

    // filter by month
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase());
    }); 
    dataNews.value = groups;
  }
  else {
    // update the value of filterYear selected one
    filterYear.value = e.target.value;

    // filter by year
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
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
  fetch(be_url + "/news").then((res) => res.json()).then(data => {
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
}, [search, filterMonth, filterYear]);


</script>

<style lang="scss" scoped>

</style>