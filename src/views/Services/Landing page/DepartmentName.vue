<script setup>
defineProps({
  name: { type: String, required: true }
})
</script>

<template>
  <div
    class="flex flex-row justify-between items-center border border-secondary dark:border-white p-1 rounded-sm pointer-events-none"
  >
    <p class="text-sm sm:text-lg px-2 dark:text-white text-dark">{{ name }}</p>
    <i class="uil uil-angle-down mr-4 text-dark dark:text-white"></i>
  </div>
</template>

<style lang="scss" scoped>
</style>