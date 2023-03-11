<template>
    <span class="duration-75 font-bold pointer-events-none" :class="!isWholeSidebar ? 'opacity-0' : 'opacity-100'">{{ name }}</span>
</template>

<script setup>
defineProps({
  name: String,
  isWholeSidebar: Boolean
})
</script>
