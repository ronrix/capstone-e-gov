<script setup>
defineProps({
  department: { type: String, required: true }
})
</script>
<template>
  <div class="flex flex-col items-start py-4 pt-5 justify-center mt-5 mx-1">
    <div class="mb-2">
      <h4 class="text-dark dark:text-white font-bold mr-10 text-xl sm:text-2xl">Where to go?</h4>
    </div>
    <div class="flex items-center">
      <i class="uil uil-map-marker text-red-600 text-2xl"></i>
      <h2 class="text-dark dark:text-bggray text-sm sm:text-lg ml-1 capitalize">
        {{ department }}
      </h2>
    </div>
  </div>
</template>



<style lang="scss" scoped>
</style>