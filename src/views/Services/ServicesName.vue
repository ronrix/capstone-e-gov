<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  service: { type: Object, required: true }
})
</script>
<template>
  <!-- Serrvices name -->
  <RouterLink
    :to="service.path"
    class="px-2 py-1 hover:bg-gray-300 block text-md text-dark mb-1 text-sm sm:text-base"
  >
    {{ service.name }}
  </RouterLink>
</template>



<style lang="scss" scoped></style>