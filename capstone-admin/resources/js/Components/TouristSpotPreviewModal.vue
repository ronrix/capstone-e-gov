<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
      <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col md:flex-row items-start">
        <!-- close modal btn -->
        <i @click="showTouristSpotPreviewModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
  
        <!-- image preview -->
        <ImgPreview v-if="isImgPreview" :imgSrc="selectedData?.img" :closeImgPreview="closeImgPreview" />
  
        <!-- left -->
        <!-- news thumbnail -->
        <div class="overflow-hidden mt-5 group relative h-[50px] md:h-auto w-full md:w-1/2">
          <!-- hover design -->
          <div class="absolute top-0 bottom-0 right-0 left-0 flex items-center justify-center bg-black/10 text-white font-bold opacity-0 group-hover:opacity-100 duration-100">
            <span @click="showImgPreview" class="uppercase border p-2 bg-black/30 cursor-pointer text-xs md:text-base hover:bg-white/30">view</span>
          </div>
            <img :src="selectedData?.img">
            <div class="flex">
          <i style="margin-top: 2px;" class="ml-2 uil uil-location-point text-cyan-400"></i>
            <p class="text-ellipsis overflow-hidden pt-1" style="font-size: 12px;">{{ address }}</p>
          </div>
        </div>
  
        <!-- right -->
        <div class="flex-1 p-3 w-full">
          <!-- title -->
          <textarea v-model="placeName" class="capitalize w-full py-3 overflow-scroll no-scrollbar text-xl font-bold h-[40px] max-h-[40ppx]">{{ placeName }}</textarea>
          <!-- date -->
          <h5 class="text-xs text-gray-500 font-bold">{{ new Date() }}</h5>
          <!-- content -->
          <!-- <p @click="startEditing" class="text-sm mt-5 cursor-pointer overflow-scroll no-scrollbar h-[200px]">
            {{ selectedData?.content }}
          </p> -->
          <textarea v-model="content" class="capitalize py-3 w-full overflow-scroll h-[200px] max-h-[200px] no-scrollbar text-sm">{{ content }}</textarea>
  
          <div class="flex items-center justify-end">
            <button class="px-4 border border-blue-600 hover:bg-blue-600 hover:text-white">cancel</button>
            <button class="px-4 bg-blue-600 ml-3 text-white">save</button>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import ImgPreview from './ImgPreview.vue';
  
  const { selectedData } = defineProps({
    showTouristSpotPreviewModal: Function,
    selectedData: {}
  });
  
  const content = selectedData?.content;
  const placeName = selectedData?.placeName;
  const address = selectedData?.address;
  
  // show image preview
  const isImgPreview = ref(false);
  function showImgPreview() {
    isImgPreview.value = true;
  }
  function closeImgPreview() {
    isImgPreview.value = false;
  }
  
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