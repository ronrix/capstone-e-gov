<script setup>
defineProps ({
    data : { type : Object, required: true}
})
</script>

<template>
    <div class="flex flex-col gap-3 md:gap-4 mt-3 bg-white dark:bg-dark px-0 pt-0 pb-3 border dark:border-gray-500 shadow-sm">
      <img :src="data?.imgSrc" alt="" class="h-[330px] md:h-[290px] lg:h-[400px]" />
      <div class="flex items-center gap-2 p-3">
        <h1 class="text-sm sm:text-xl lg:text-2xl text-dark dark:text-white font-bold capitalize">{{ data?.name }}</h1>
        <div class="bg-dark flex-1 w-full h-0.5 dark:bg-white"></div>
      </div>
      <div class="flex flex-row md:flex-col items-center md:items-start gap-1 px-2">
        <div class="flex-1 flex items-center gap-1">
          <i class="uil uil-code-branch  text-xl md:text-3xl text-gray-700 dark:text-white"></i>
          <span class="w-auto md:w-[100px] text-sm sm:text-lg text-dark dark:text-white font-bold">Branch of: </span>
          <span class="text-xs sm:text-sm lg:text-lg text-dark font-light dark:text-white ml-1 capitalize">{{ data?.branch }}</span>
        </div>
        <div class="flex-1 flex items-center gap-1">
          <i class="uil uil-map-marker text-3xl text-gray-700 dark:text-white"></i>
          <span class="w-auto md:w-[100px] text-sm sm:text-lg text-dark dark:text-white font-bold">Address: </span>
          <span class="text-xs sm:text-sm lg:text-lg text-dark font-light dark:text-white ml-1 capitalize">{{ data?.location }}</span>
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