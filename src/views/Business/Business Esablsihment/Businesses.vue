<script setup>
defineProps ({
    data : { type : Object, required: true}
})
</script>

<template>
    <div class="flex flex-col gap-3 md:gap-4 mt-3 bg-white dark:bg-dark px-0 pt-0 pb-3 border dark:border-gray-500 shadow-sm">
      <img :src="data?.imgSrc" alt="" class="h-[330px] md:h-[290px] lg:h-[300px]" />
      <div class="flex items-center gap-2 p-3">
        <h1 class="text-sm sm:text-xl lg:text-lg text-dark dark:text-white font-bold capitalize">{{ data?.name }}</h1>
        <div class="bg-dark flex-1 w-full h-0.5 dark:bg-white"></div>
      </div>
      <div class="flex flex-col sm:flex-row md:flex-col items-start sm:items-center md:items-start gap-2 sm:gap-5 md:gap-1 px-2">
        <div class="flex items-center gap-1">
          <i class="uil uil-code-branch  text-xl md:text-3xl text-gray-700 dark:text-white"></i>
          <span class= "text-lg text-dark dark:text-white font-semibold">Branch of: </span>
          <p class="text-sm text-dark  dark:text-white ml-1 capitalize">{{ data?.branch }}</p>
        </div>
        <div class="flex items-center gap-1">
          <i class="uil uil-map-marker text-xl md:text-3xl text-gray-700 dark:text-white"></i>
          <span class="text-lg text-dark dark:text-white font-semibold ml-0 md:ml-1.5">Address: </span>
          <p class="text-sm text-dark dark:text-white ml-1 capitalize">{{ data?.location }}</p>
        </div>
      </div>
      <div>
        <button
        class="w-full sm:w-24 lg:w-28 ml-0 sm:ml-2 text-sm text-white bg-primary dark:bg-primarylight hover:bg-primarylight dark:hover:bg-primary rounded-md py-2 px-1 mt-3"
      >
        View
        <i class="uil uil-angle-right"></i>
      </button>
      </div>
      
    </div>
</template>

<style lang="scss" scoped>
</style>