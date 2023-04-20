<script setup>
defineProps({
  name: { type: String, required: true }
})
</script>

<template>
      <div class="flex flex-row items-center gap-3 relative">
        <i class="uil uil-check text-2xl text-green-700"></i>
        <p class="text-dark dark:text-white text-sm md:text-lg font-light">{{ name }}</p>
      </div>
</template>



<style lang="scss" scoped>
</style>