<script setup>
defineProps({
  data: { type: Object, required: true }
})
</script>

<template>
  <div class="mx-2 lg:mx-16 bg-white dark:bg-dark rounded-md shadow-sm border mt-1 p-5">
    <div class="flex items-center gap-3">
      <div class="flex flex-col gap-3 flex-1">
        <h1 class="text-xs sm:text-sm font-bold text-gray-500 dark:text-gray-200">
          Type of permit
        </h1>
        <div class="text-sm sm:text-base md:text-lg text-dark dark:text-white font-bold">
          {{ data?.name }}
        </div>
      </div>
      <div class="flex flex-col gap-3 flex-1">
        <h1 class="text-xs sm:text-sm font-bold text-gray-500 dark:text-gray-200">Department</h1>
        <div class="text-sm sm:text-base md:text-lg text-dark dark:text-white font-bold">
          {{ data?.department }}
        </div>
      </div>
      <div class="">
        <button
          class="bg-primary px-3 md:px-7 py-2 text-white rounded-md hover:bg-primarylight text-xs"
        >
          View
          <i class="uil uil-angle-right"></i>
        </button>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>