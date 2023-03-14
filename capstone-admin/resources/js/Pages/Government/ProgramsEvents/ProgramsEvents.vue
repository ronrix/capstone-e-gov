<template>
  <WrapperContent>
   <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model.lazy="search" placeholder="search news" class="bg-transparent outline-none" />
      </label> 
    </div>

    <div v-for="group in dataToLoop.value" :key="group.month" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.month }}</span>
        <div class="flex-1 border"></div>
      </div>
      <ProgramsEventsCard v-for="data in group.items" :data="data" />
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

import { computed, ref } from 'vue';
const isAddNewModal = ref(false);

function showAddModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

// sample data
const sample_data = [
  {
    title: "Parks and Rec Committee",
    location: "City Hall 2041 Spring haven Trail, Indianpols, IN 07901",
    content: "first Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit at, possimus dignissimos dicta sequi nostrum officia? Harum asperiores ipsa officiis consectetur impedit quisquam, commodi blanditiis cumque, maiores, eaque dolorem nihil?",
    imgSrc: "https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=869&q=80",
    date: "2022-01-01",
  },
  {
    title: "Great Yoga",
    location: "1651 Rolims Road. Beech Grove, IN 46203",
    content: "second Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit at, possimus dignissimos dicta sequi nostrum officia? Harum asperiores ipsa officiis consectetur impedit quisquam, commodi blanditiis cumque, maiores, eaque dolorem nihil?",
    imgSrc: "https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80",
    date: "2020-12-02",
  },
  {
    title: "WordCamp Pawnee",
    location: " Spring haven Trail, Indianpols, IN 07901",
    content: "third Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit at, possimus dignissimos dicta sequi nostrum officia? Harum asperiores ipsa officiis consectetur impedit quisquam, commodi blanditiis cumque, maiores, eaque dolorem nihil?",
    imgSrc: "https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80",
    date: "2022-03-03",
  },
];

// search filter
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

</script>

<style scoped></style>