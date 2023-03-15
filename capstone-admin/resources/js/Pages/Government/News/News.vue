<template>
  <WrapperContent class="flex flex-col gap-5">
    <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search news" class="bg-transparent outline-none" />
      </label> 
    </div>

    <!-- news card -->
    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <CardNews v-for="data in group.items" :data="data" :showPreviewModal="showPreviewModal" />
    </div>
    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" />

    <!-- add new news btn -->
    <button @click="showAddNewModal" class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text-2xl text-white"></i>
    </button>

    <!-- add modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
  </WrapperContent>
</template>

<script setup>
import CardNews from './CardNews.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';

import { ref, onUpdated, computed } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import { searchFilter } from '../../../utils/searchFilter';
const isPreviewModal = ref(false);
const selectedData = ref();

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

const sample_data = [
  {
    title: "First news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1557992260-ec58e38d363c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80",
    date: "2022-01-01",
  },
  {
    title: "Second news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80",
    date: "2020-05-01",
  },
  {
    title: "third news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80",
    date: "2021-12-01",
  },
  {
    title: "fourth news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80",
    date: "2023-02-01",
  },
];

function showPreviewModal(data) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}

// data filtering for search input 
const search = ref("");
const groupData = computed(() => {
  let groups = {};

  sample_data.forEach((item) => {
    const month = new Date(item.date).toLocaleString('default', { month: 'short', year: "numeric" });
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
    searchData.value[0].items = searchFilter(sample_data, search);
    return searchData;
  }
  return groupData;
}, [search]);

// check if modal is open and prevent the document from scrolling
onUpdated(() => {
  if(isPreviewModal.value || isAddNewModal.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});

</script>

<style lang="scss" scoped>

</style>