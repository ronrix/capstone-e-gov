<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  service: { type: Object, required: true }
})
</script>
<template>
  <!-- Serrvices name -->
  <RouterLink :to="service.path" class="px-2 hover:bg-gray-300 block text-md text-gray-700 mb-1">
        {{ service.name }}
  </RouterLink>
</template>



<style lang="scss" scoped></style>