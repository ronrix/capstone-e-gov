<script setup>
defineProps({
    name : {type: String, required: true}
})
</script>
<template>
    <div class="flex flex-col items-start py-4 pt-5 lg:pb-10 justify-center mt-10 mx-1">
      <div class="mb-4 ml-4 md:mb-7">
        <h1
        class="text-dark dark:text-white font-bold mr-10 text-2xl md:text-3xl"
      >
        Where to go?
      </h1>
      </div>
      <div class="flex ml-4 items-center">
        <i class="uil uil-map-marker text-red-600 text-2xl md:text-3xl"></i>
        <h2 class="text-dark dark:text-white text-lg md:text-xl font-light ml-1 capitalize">{{ name }}</h2>
      </div>
      <div class="w-full border border-gray-300 mt-10"></div>
      </div>

</template>



<style lang="scss" scoped>

</style>