<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  service: { type: String, required: true }
})
</script>
<template>
  <!-- Serrvices name -->
  <RouterLink
    :to="'/services/' + service.replace(' ', '-')"
    class="px-4 py-1 hover:bg-gray-300 dark:hover:bg-gray-400 block text-md text-dark dark:text-white mb-1 text-sm sm:text-base capitalize"
  >
    {{ service }}
  </RouterLink>
</template>



<style lang="scss" scoped></style>