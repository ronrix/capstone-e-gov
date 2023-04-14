<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  service: { type: Object, required: true }
})
</script>
<template>
  <!-- Serrvices name -->
  <RouterLink :to="service.path">
    <div class="flex flex-col justify-center">
      <div class="hover:bg-gray-300 rounded-lg">
        {{ service.name }}
      </div>
    </div>
  </RouterLink>
</template>



<style lang="scss" scoped></style>