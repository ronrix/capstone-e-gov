<template>
  <div class="relative bg-white flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden shadow-md">
    
    <!-- delete button this will delete the programs and events -->
    <Delete :handleDelete="handleDelete" :id="data.id"  />

    <!-- <div class="flex-1 md:max-w-[500px] h-[320px] max-h-[500px] overflow-hidden rounded-md md:mx-5 border">
      <img :src="imgSrc" alt="this is the program image" class="w-full h-full">
    </div> -->
    <div :style="{ backgroundImage: `url(${imgSrc})` }" class="bg-no-repeat bg-cover bg-center h-[350px] max-h-[400px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm after:block md:after:hidden"></div>

    <div class="flex-1 flex flex-col px-5">
      <p class="text-gray-500 text-sm">
        <span class="font-bold text-blue-600">
          <i class="uil uil-archive"></i>
          Programs and Events
        </span> 
        {{ data.date }}
      </p>
      <h5 class="font-bold mt-2 capitalize">{{ data.title }}</h5>

      <p class="mb-3 text-sm font-[500] capitalize">
        {{ data.location }}
      </p>
      <p v-bind:innerHTML="description" class="text-sm text-gray-700 h-[200px] overflow-hidden"></p>
      <button @click="showPreviewModal(data)" class="active:-translate-y-[1px] mb-2 bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase rounded-md">view </button>
    </div>
  </div>
</template>

<script setup>
import Delete from "../../../Components/Delete.vue";
import { formatImgs } from "../../../utils/formatImgs";

import { marked } from "marked";
import DOMPurify from 'dompurify';

const origImgSrc = formatImgs(data.img_link.split(","));
const imgSrc = origImgSrc[0];
const description = DOMPurify.sanitize(marked.parse(data.description));

const { data } = defineProps({
  showPreviewModal: Function,
  handleDelete: Function,
  data: Object
});
</script>