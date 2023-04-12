<template>
  <RouterLink
    :to="to"
    class="capitalize hover:text-primary"
  >
    {{ title }}
    <i class="uil uil-angle-down" />
  </RouterLink>
</template>

<script setup>
defineProps({
    title: { type: String, required: true },
    to:  { type: String, 
    required: true } 
});
</script>