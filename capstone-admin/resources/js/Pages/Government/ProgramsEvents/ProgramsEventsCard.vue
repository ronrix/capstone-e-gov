<template>
  <div class="relative bg-white p-5 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden">
    
    <!-- delete button this will delete the programs and events -->
    <Delete />

    <div>
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
      <p class="text-sm text-gray-700">{{ data.content }}</p>
    </div>

    <div class="mt-5 w-full sm:mt-0 sm:w-3/4 h-[220px] overflow-hidden">
      <img :src="data.imgSrc" alt="this is the program image">
    </div>
  </div>
</template>

<script setup>
import Delete from "../../../Components/Delete.vue";

defineProps({
  data: Object
});
</script>