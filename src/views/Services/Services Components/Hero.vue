<script setup>
defineProps({
  title: { type: String, required: true },
  description: { type: String, required: true }
})
</script>
<template>
  <div
    class="flex flex-col w-full gap-3 md:gap-7 mt-20 py-5 px-1 border border-x-0 border-t-0 mb-14 pb-14"
  >
    <div class="w-1/2">
      <h1 class="text-3xl text-primary dark:text-primarylight font-bold text-left capitalize">
        {{ title }}
      </h1>
      <div class="bg-primary dark:bg-primarylight mt-2 w-1/2 h-1"></div>
    </div>
    <div class="flex-1 text-sm sm:text-base text-dark dark:text-white font-light">
      {{ description }}
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>