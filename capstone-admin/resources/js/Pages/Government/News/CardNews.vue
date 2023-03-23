<template>
  <div class="relative overflow-hidden flex flex-col md:flex-row shadow-lg bg-white border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 ">
 
    <!-- delete button this will delete the programs and events --> 
    <div class="z-10"> <!-- adding z-10 to put this delete component at the top/front -->
      <Delete :handleDelete="handleDelete" :id="data.id" />
    </div>

    <!-- image -->
    <div v-if="!firstLoad" :style="{ backgroundImage: `url(${imgSrc})` }" class="bg-no-repeat bg-cover bg-center h-[350px] max-h-[400px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm after:block md:after:hidden"></div>
    <ImgSkeleton v-if="firstLoad" class="h-[400px]" />
    <!-- content -->
    <div class="flex-1 px-5 pt-5 flex flex-col justify-between">
      <div>
        <h3 v-if="!firstLoad" class="font-bold capitalize text-xl tracking-wide">{{ data.title }}</h3>
        <TitleSkeleton v-if="firstLoad" />
        <h5 v-if="!firstLoad" class="text-xs text-gray-500 font-bold">{{ date }}</h5>
        <DateSkeleton v-if="firstLoad" />
      </div>
      <p v-if="!firstLoad" class="mt-5 text-sm h-[100px] overflow-hidden" v-bind:innerHTML="description">
        <span v-if="data.description.length > 100">...</span>
      </p>
      <DescSkeleton v-if="firstLoad" />
      <button @click="showPreviewModal(data)" class="active:-translate-y-[1px] mb-2 rounded-md bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">view </button>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Delete from '../../../Components/Delete.vue';
import { dateFormat } from '../../../utils/dateFormat';
import { validURL } from '../../../utils/validUrl';
import { be_url } from '../../../config/config';
import TitleSkeleton from '../../../Components/Skeleton/TitleSkeleton.vue';
import DateSkeleton from '../../../Components/Skeleton/DateSkeleton.vue';
import DescSkeleton from '../../../Components/Skeleton/DescSkeleton.vue';
import ImgSkeleton from '../../../Components/Skeleton/ImgSkeleton.vue';

import { marked } from "marked";
import DOMPurify from 'dompurify';
const description = DOMPurify.sanitize(marked.parse(data.description));

const firstLoad = ref(true);
onMounted(() => {
  setTimeout(() => {
    firstLoad.value = false;
  }, 1000);
});

// the first value of the img_links is a img link but it has a '"' on the first character 
// that's why i use replace method. 
// the first index of "img_link" will be the default thumbnail of the news data
const imgSrc = validURL(data.img_link.split(",")[0].replace('"', "")) ? data.img_link.split(",")[0] : be_url + "/" + data.img_link.split(",")[0].replace('"', ""); // : "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png";

const date = dateFormat(data.created_at);

const { data } = defineProps({
  showPreviewModal: Function,
  data: Object,
  handleDelete: Function,
});
</script>