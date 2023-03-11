<template>
  <RouterLink activeClass="bg-blue-600 text-white" :to="to" class="hover:bg-blue-600 hover:text-white cursor-pointer w-full p-2 capitalize">
    {{ name }}
  </RouterLink>
</template>

<script setup>
defineProps({
  to: String,
  name: String
})
</script>