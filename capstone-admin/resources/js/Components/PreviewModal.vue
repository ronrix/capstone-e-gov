<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col md:flex-row items-start">
      <!-- close modal btn -->
      <i @click="showPreviewModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!-- image preview -->
      <ImgPreview v-if="isImgPreview" :imgSrc="selectedData?.img_link" :closeImgPreview="closeImgPreview" />

      <!-- left -->
      <!-- news thumbnail -->
      <div class="overflow-hidden mt-5 group relative h-[100px] md:h-auto w-full md:w-1/2">
        <!-- hover design -->
        <div class="absolute top-0 bottom-0 right-0 left-0 flex items-center justify-center bg-black/10 text-white font-bold opacity-0 group-hover:opacity-100 duration-100">
          <span @click="showImgPreview" class="uppercase border p-2 bg-black/30 cursor-pointer text-xs md:text-base hover:bg-white/30">view</span>
        </div>
        <img :src="selectedData?.img_link" alt="this is the thumbnail of news">
      </div>

      <!-- right -->
      <div class="flex-1 p-3 w-full">
        <!-- title -->
        <textarea v-model="title" class="capitalize w-full overflow-scroll no-scrollbar text-xl font-bold max-h-[71px]">{{ title }}</textarea>
        <!-- date -->
        <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
        <!-- content -->
        <!-- <p @click="startEditing" class="text-sm mt-5 cursor-pointer overflow-scroll no-scrollbar h-[200px]">
          {{ selectedData?.content }}
        </p> -->
        <textarea v-model="content" class="capitalize py-3 w-full overflow-scroll h-[200px] max-h-[200px] no-scrollbar text-sm">{{ content }}</textarea>

        <div class="flex items-center justify-end">
          <button class="px-4 hover:text-blue-600">cancel</button>
          <button class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold">save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { dateFormat } from '../utils/dateFormat';
import ImgPreview from './ImgPreview.vue';

const { selectedData } = defineProps({
  showPreviewModal: Function,
  selectedData: {}
});

const content = selectedData?.description;
const title = selectedData?.title;
const date = dateFormat(selectedData?.created_at);

// show image preview
const isImgPreview = ref(false);
function showImgPreview() {
  isImgPreview.value = true;
}
function closeImgPreview() {
  isImgPreview.value = false;
}

// add scroll hidden on mount
onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});

</script>

<style scroped>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>