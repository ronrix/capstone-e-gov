<script setup>
defineProps({
  data: { type: Object, required: true }
})
</script>

<template>
  <div class="w-full mt-5">
    <div
      class="flex flex-col gap-5 border bg-white dark:bg-dark dark:border dark:border-gray-500 rounded-b-md shadow-sm px-0 pt-0 pb-7"
    >
      <img class="h-[350px] md:h-[300px] lg:h-[350px]" :src="data?.imgSrc" alt="" />
      <div class="flex flex-row md:flex-col">
        <div class="flex items-center mb-2 px-1 sm:px-3">
          <i
            class="uil uil-university text-gray-700 dark:text-white text-xl sm:text-2xl mr-0 sm:mr-2"
          ></i>
          <span class="text-xs sm:text-sm md:text-lg font-bold text-dark dark:text-white">
            Barangay :
          </span>

          <h2 class="flex-1 text-xs sm:text-sm text-dark dark:text-white ml-3 md:ml-5">
            {{ data?.barangay }}
          </h2>
        </div>
        <div class="flex items-center px-1 sm:px-3">
          <i class="uil uil-map-marker text-gray-700 dark:text-white text-2xl mr-0 sm:mr-2"></i>
          <span class="text-sm md:text-lg font-bold text-dark dark:text-white"> Address : </span>
          <h2 class="flex-1 text-xs sm:text-sm text-dark dark:text-white ml-3 md:ml-5">
            {{ data?.address }}
          </h2>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>