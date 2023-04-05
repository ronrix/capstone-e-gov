<template>
 <div class="relative overflow-hidden flex flex-col lg:flex-row justify-between w-full p-0 bg-white border-y-0 border-l-[6px] border-l-blue-600 mt-3"> 
  <!-- delete button this will delete the programs and events --> 
  <div class="z-10"> <!-- adding z-10 to put this delete component at the top/front -->
      <Delete :handleDelete="handleDelete" :id="data.id" />
    </div>
        <!-- image -->
    <img class="h-[300px] max-h-[400px] w-full lg:w-[400px]" :src="imgSrc" alt="this is bulawan resort">
        <!-- content -->
     <div class="flex-1 px-5 pt-5 flex flex-col justify-between">
          <h3 class="font-bold capitalize text-xl tracking-wide">{{data?.title}}</h3>
          <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
          <p v-bind:innerHTML="description" class="mt-5 text-sm h-[100px] overflow-hidden"></p>
          <!-- button view -->
          <button @click="showPreviewModal(data)"
          class="w-[70px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5 lg:mt-10">view
        </button>
      </div>
 </div>
</template>

<script setup>
import Delete from '../../../Components/Delete.vue';
import { dateFormat } from '../../../utils/dateFormat';
import { formatImgs } from '../../../utils/formatImgs';

import { marked } from "marked";
import DOMPurify from 'dompurify';

// the first value of the img_links is a img link but it has a '"' on the first character 
// that's why i use replace method. 
// the first index of "img_link" will be the default thumbnail of the news data
const imgSrc = formatImgs(data.img_link.split(","))[0];
const date = dateFormat(data.created_at);
const description = DOMPurify.sanitize(marked.parse(data.description));

const { data } = defineProps({
  showPreviewModal: Function,
  handleDelete: Function,
  data: Object,
});
</script>