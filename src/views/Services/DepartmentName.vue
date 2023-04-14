<script setup>
defineProps({
  name: { type: String, required: true }
})
</script>

<template>
  <div
    class="flex flex-row justify-between items-center border border-gray-400 p-1 rounded-sm pointer-events-none"
  >
    <p class="text-lg px-2 text-gray-700">{{ name }}</p>
    <i class="uil uil-angle-down mr-4 text-gray-600 hover:text-gray-400"></i>
  </div>
</template>

<style lang="scss" scoped>
</style>