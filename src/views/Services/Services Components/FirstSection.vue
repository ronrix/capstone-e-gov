<script setup>
defineProps({
    name : {type: String, required: true}
})
</script>
<template>
    <div class="rounded-e-lg bg-white border dark:border-gray-400 shadow-sm dark:bg-dark mt-5 relative mb-5">
    <div class="flex flex-col items-center sm:items-start py-4 pt-5 lg:pb-10 justify-center">
      <div class="ml-0 sm:ml-5 mb-4 md:mb-7">
        <h1
        class="text-dark dark:text-white font-bold mr-10 text-2xl md:text-3xl"
      >
        Where to go?
      </h1>
      </div>
      <div class="flex items-center ml-0 sm:ml-5">
        <i class="uil uil-map-marker text-red-600  text-2xl md:text-3xl"></i>
        <h2 class="text-red-600 text-xl md:text-2xl font-bold ml-1">{{ name }}</h2>
      </div>
        <div class="absolute top-0 left-0 w-1 h-full bg-red-500"></div>
      </div>
      <!-- <i class="uil uil-corner-down-right text-7xl text-red-500 dark:text-white absolute top-10 -left-3"></i> -->
      
      
   
  </div>
</template>



<style lang="scss" scoped>

</style>