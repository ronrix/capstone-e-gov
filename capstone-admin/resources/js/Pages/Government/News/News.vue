<template>
  <WrapperContent class="flex flex-col gap-5">
    <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model="search" placeholder="search news" class="bg-transparent outline-none" />
      </label> 
    </div>

    <CardNews v-for="data in searchFilter()" :data="data" :showNewsModal="showNewsModal" />
    <NewsModal :selectedData="selectedData" :showNewsModal="showNewsModal" v-if="isNewModal" />

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
import NewsModal from './NewsModal.vue';

import { ref, onUpdated } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
const isNewModal = ref(false);
const selectedData = ref();

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

const sample_data = [
  {
    title: "First news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1557992260-ec58e38d363c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80"
  },
  {
    title: "Second news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80"
  },
  {
    title: "third news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80"
  },
  {
    title: "fourth news",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img: "https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80"
  },
];

function showNewsModal(data) {
  isNewModal.value = !isNewModal.value;
  selectedData.value = data;
}

// data filtering for search input 
const search = ref("");
function searchFilter() {
  return sample_data.filter(news => {
    return news.title.toLowerCase().includes(search.value);
  })
}

// check if modal is open and prevent the document from scrolling
onUpdated(() => {
  if(isNewModal.value || isAddNewModal.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});

</script>

<style lang="scss" scoped>

</style>