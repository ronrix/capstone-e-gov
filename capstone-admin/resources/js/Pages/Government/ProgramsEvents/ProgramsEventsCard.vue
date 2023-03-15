<template>
  <div class="relative bg-white p-5 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden">
    
    <!-- delete button this will delete the programs and events -->
    <Delete />

    <div class="flex-1 flex flex-col">
      <p class="text-gray-500 text-sm">
        <span class="font-bold text-blue-600">
          <i class="uil uil-archive"></i>
          Featured
        </span> 
        {{ data.date }}
      </p>
      <h5 class="font-bold my-2">{{ data.title }}</h5>

      <p class="my-2 text-sm">
        {{ data.location }}
      </p>
      <p class="text-sm text-gray-700 h-[200px] overflow-hidden">
        {{ data.content }}
        {{ data.content }}
        {{ data.content }}
        {{ data.content }}
        {{ data.content }}
      </p>
      <button @click="showPreviewModal(data)" class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">view </button>
    </div>

    <div class="flex-1 mt-5 max-w-[500px] h-[320px] max-h-[500px] overflow-hidden rounded-md md:mx-5">
      <img :src="data.img" alt="this is the program image">
    </div>
  </div>
</template>

<script setup>
import Delete from "../../../Components/Delete.vue";

defineProps({
  showPreviewModal: Function,
  data: Object
});
</script>