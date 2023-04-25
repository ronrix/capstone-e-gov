<script setup>
defineProps({
  data: { type: Object, required: true }
})
</script>
<template>
  <div
    class="flex flex-col w-full gap-3 md:gap-7 mt-20 py-5 px-1 border border-x-0 border-t-0 pb-10 md:pb-20"
  >
    <div class="w-1/2">
      <h1
        class="text-2xl md:text-3xl text-primary dark:text-primarylight font-bold text-left capitalize"
      >
        {{ data?.name }}
      </h1>
      <div class="bg-primary dark:bg-primarylight mt-2 w-1/2 h-1"></div>
    </div>
    <div class="flex-1 text-sm md:text-lg text-dark dark:text-white font-light lowercase">
      {{ data?.description }}
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>