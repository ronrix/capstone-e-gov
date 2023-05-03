<script setup>
defineProps({
  name: { type: String, required: true }
})
</script>

<template>
  <div
    class="mx-2 sm:mx-1 flex flex-row justify-between items-center border border-secondary dark:border-white px-1 rounded-sm pointer-events-none"
  >
    <p class="text-sm md:text-lg px-2 dark:text-white text-dark">{{ name }}</p>
    <i class="uil uil-angle-down mr-4 text-dark dark:text-white"></i>
  </div>
</template>

<style lang="scss" scoped>
</style>