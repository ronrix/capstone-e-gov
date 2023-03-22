<template>
  <div class="relative overflow-hidden flex flex-col md:flex-row shadow-lg bg-white border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 ">
 
    <!-- delete button this will delete the programs and events --> 
    <div class="z-10"> <!-- adding z-10 to put this delete component at the top/front -->
      <Delete :handleDelete="handleDelete" :id="data.id" />
    </div>

    <!-- image -->
    <div :style="{ backgroundImage: `url(${imgSrc})` }" class="bg-no-repeat bg-cover bg-center h-[350px] max-h-[400px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm after:block md:after:hidden "> </div>
    <!-- content -->
    <div class="flex-1 px-5 pt-5 flex flex-col justify-between">
      <h3 class="font-bold capitalize text-xl tracking-wide">{{ data.title }}</h3>
      <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
      <p class="mt-5 text-sm h-[100px] overflow-hidden">
        {{ data.description }}
        <span v-if="data.description.length > 100">...</span>
      </p>
      <button @click="showPreviewModal(data)" class="mb-2 rounded-md bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">view </button>
    </div>
  </div>
</template>

<script setup>
import Delete from '../../../Components/Delete.vue';
import { dateFormat } from '../../../utils/dateFormat';
import { validURL } from '../../../utils/validUrl';
import { be_url } from '../../../config/config';

const imgSrc = validURL(data.img_link) ? data.img_link : be_url + "/" + data.img_link; // : "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png";
const date = dateFormat(data.created_at);

const { data } = defineProps({
  showPreviewModal: Function,
  data: Object,
  handleDelete: Function,
});
</script>