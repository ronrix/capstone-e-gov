<script setup>
defineProps({
  name: { type: String, required: true }
})
</script>

<template>
  <div
    class="flex flex-row justify-between items-center border border-secondary p-1 rounded-sm pointer-events-none"
  >
    <p class="text-sm sm:text-lg px-2 text-dark">{{ name }}</p>
    <i class="uil uil-angle-down mr-4 text-dark"></i>
  </div>
</template>

<style lang="scss" scoped>
</style>