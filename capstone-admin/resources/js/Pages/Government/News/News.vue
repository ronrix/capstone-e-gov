<template>
  <HeadTitle title="News"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">
    <!-- response message -->
    <Notifcation :msg="resMsg" class="z-[1000]" />

    <!-- filter -->
    <div class="w-full flex flex-col gap-3 md:flex-row md:items-center">
      <label class="flex-1 flex items-center rounded-lg p-2 text-sm bg-slate-100">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search news" class="bg-transparent outline-none" />
      </label>

      <div class="flex-1 flex items-center">
        <!-- filter by date -->
        <!-- month -->
        <span class="text-gray-500 font-bold text-sm mx-2 capitalize"> month: </span>
        <SelectTag type="month" :filterFn="filterBy" :value="filterMonth" :filterArray="filterMonths"
          added-class="!w-[300px]" />
        <!-- year -->
        <span class="text-gray-500 font-bold text-sm mx-2 capitalize"> year: </span>
        <SelectTag type="year" :filterFn="filterBy" :value="filterYear" :filterArray="filterYears"
          added-class="!w-[200px]" />

        <!-- filter the deleted data -->
        <span class="text-gray-500 font-bold text-sm mx-2 capitalize"> active: </span>
        <SelectTag type="active" :filterFn="filterDelete" :value="activeData" :filterArray="['active', 'deleted']"
          added-class="!w-[200px]" />
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

    <!-- news card -->
    <div v-else v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <CardNews :handle-restore="handleRestore" :handleDelete="handleDelete" v-for="data in group.items" :data="data"
        :key="data.id" :showPreviewModal="showPreviewModal" />
      <!-- no result  -->
      <div v-if="!group.items.length" class="font-bold text-gray-800">No results found!</div>
    </div>
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal"
      :handleSubmit="handleUpdateSubmit" />

    <!-- add new news btn -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />

    <!-- add modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
      :handleCreateSubmit="handleCreateSubmit" title="Headline" :location="false" />
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
import Loading from "../../../Components/Loading.vue";

// filter deleted data
const activeData = ref("active");
function filterDelete(type, value) {
  activeData.value = value;
  isLoading.value = true;

  // get request for deleted data
  if (activeData.value === 'deleted') {
    axios.get(be_url + '/news/deleted')
      .then(({ data }) => {
        isLoading.value = false;
        // add deleted data to dataNews and originalDataNews
        if (data.news.length) {
          dataNews.value = data.news;
          originalDataNews.value = data.news;
          isEmpty.value = false;
          return;
        }
        // else just render "empty collection" text
        isEmpty.value = true; // set the isEmpty to true, so there would be an indication that data is empty
        dataNews.value = data.news;
        originalDataNews.value = data.news;
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
  axios.get(be_url + '/news')
    .then(({ data }) => {
      isLoading.value = false;
      isEmpty.value = false;
      if (data.news) {
        dataNews.value = data.news;
        originalDataNews.value = data.news;
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

const resMsg = ref();
// delete a news data based on the passed id
function handleDelete(id) {
  axios.post(be_url + "/delete-news", { id }).then(({ data }) => {

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);


    // this will update the state variable of the news
    originalDataNews.value = data.news;
    dataNews.value = data.news;
  }).catch(err => {
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
  return await axios.post(be_url + "/news/restore", { id }).then(({ data }) => {
    if (data.news) {
      dataNews.value = data.news;
      originalDataNews.value = data.news;
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

// handle the submit function to update the new news
function handleUpdateSubmit(id, formData) {
  axios.post(be_url + "/news/edit", {
    id,
    title: formData.title,
    description: formData.description,
    authors: formData.authors,
    imgFile: formData.imgFile,
    newImgs: formData.newImgs,
    deletedImgs: formData.deletedImgIds,
    defaultThumbnailId: formData.defaultThumbnailId
  },
    { headers: { "Content-Type": "multipart/form-data" } })
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
    .catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// submit form
async function handleCreateSubmit(formData) {
  return await axios.post(be_url + "/news/create", {
    title: formData.title,
    description: formData.content,
    authors: formData.authors,
    imgFile: [...formData.imgFile]
  },
    { headers: { "Content-Type": "multipart/form-data" } })
    .then(response => {
      originalDataNews.value = response.data.news;
      dataNews.value = response.data.news;

      // set the response msg
      resMsg.value = response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      return response.data;
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

// sort/filter function for select and input year
const filterMonth = ref("All");
const filterYear = ref("All");
const filterMonths = ["All", "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const filterYears = ["All", 2023, 2022, 2021, 2020, 2019, 2018, 2017,];

function filterBy(type, value) {
  if (type === "month") {
    // update the value of filterMonth with the selected one
    filterMonth.value = value;

    // if value is "all" select all the data
    if (value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataNews.value = originalDataNews.value;
      return;
    }

    // filter by month
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      if (filterYear.value === "All") { // check if the filterYear is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase());
      }
      if (filterMonth.value === "All") { // check if the filterMonth is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
      }
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) && date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    });
    dataNews.value = groups;
  }
  else {
    // update the value of filterYear selected one
    filterYear.value = value;

    // if value is "all" select all the data
    if (value === "All" && filterMonth.value === "All" && filterYear.value === "All") {
      dataNews.value = originalDataNews.value;
      return;
    }

    // filter by year
    // and set the new value to dataNews to re-render the filtered news
    const groups = originalDataNews.value.filter(group => {
      const date = dateFormat(group.created_at);
      if (filterMonth.value === "All") { // check if the filterMonth is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
      }
      if (filterYear.value === "All") { // check if the filterYear is all, then return only the data with filterMonth
        return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase());
      }
      // return the group if month exists 
      return date.toLocaleLowerCase().includes(filterMonth.value.toLowerCase()) && date.toLocaleLowerCase().includes(filterYear.value.toLowerCase());
    });
    dataNews.value = groups;
  }

}

const isPreviewModal = ref(false); // this state is for toggling/showing preview modal
const selectedData = ref(); // this state for vieing the data in the preview modal
const dataNews = ref([]); // this state is going to be used for modifying like filter or search function
const originalDataNews = ref([]); // this state will act as the original data that don't change
const isEmpty = ref(false);
const isLoading = ref(true);

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// fetch the news data from backend
onMounted(() => {
  // requesting data from /news
  axios.get(be_url + "/news").then(({ data }) => {
    dataNews.value = data.news;
    originalDataNews.value = data.news;
    if (!dataNews.value.length) isEmpty.value = true;
    isLoading.value = false;
  }).catch(err => {
    // set the response msg
    resMsg.value = err.response.data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);
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
});

// then this function will turn the array of objects to an object of array
// from [{jan: [], feb: []}] -> {jan: [], feb: []} 
function convertToObjectArray(groups) {
  return groups.reduce((acc, group) => {
    acc[group.month] = group;
    return acc;
  }, {});
}

const searchData = ref([{ month: "Search Results", items: [] }]);
const dataToLoop = computed(() => {
  if (search.value.length) {
    searchData.value[0].items = searchFilter(dataNews.value, search);
    return searchData;
  }
  return groupData;
});

</script>