<script setup>

</script>

<template>
  <div class="border dark:border-gray-400 pb-5 px-5 shadow-sm relative">
    <h1 class="text-xl md:text-2xl font-bold text-dark dark:text-white mt-6 mb-5">Checklist of Requirement</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
       <slot></slot>
    </div>
    <div class="absolute top-0 left-0 w-1 h-full bg-green-600"></div>
  </div>
</template>

<style lang="scss" scoped>
</style>