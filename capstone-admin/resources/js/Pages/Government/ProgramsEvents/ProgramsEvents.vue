<template>
  <WrapperContent>
   <!-- filter -->
    <div class="w-full flex items-center">
      <label class="flex items-center rounded-lg p-2 text-sm bg-white">
        <i class="uil uil-search-alt pr-3"></i>
        <input type="search" v-model="search" placeholder="search news" class="bg-transparent outline-none" />
      </label> 
    </div>

    <div class="flex flex-col gap-3 mt-5">
      <ProgramsEventsCard v-for="data in filteredData" :data="data" />
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
    date: new Date(),
  },
  {
    title: "Great Yoga",
    location: "1651 Rolims Road. Beech Grove, IN 46203",
    content: "second Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit at, possimus dignissimos dicta sequi nostrum officia? Harum asperiores ipsa officiis consectetur impedit quisquam, commodi blanditiis cumque, maiores, eaque dolorem nihil?",
    imgSrc: "https://images.unsplash.com/photo-1588681664899-f142ff2dc9b1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80",
    date: new Date(),
  },
  {
    title: "WordCamp Pawnee",
    location: " Spring haven Trail, Indianpols, IN 07901",
    content: "third Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odit at, possimus dignissimos dicta sequi nostrum officia? Harum asperiores ipsa officiis consectetur impedit quisquam, commodi blanditiis cumque, maiores, eaque dolorem nihil?",
    imgSrc: "https://images.unsplash.com/photo-1526470608268-f674ce90ebd4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80",
    date: new Date(),
  },
]

// search filter
const search = ref("");
const filteredData = computed(() => searchFilter(sample_data, search));

</script>

<style scoped></style>