<script setup>

</script>

<template>
  <div class="border rounded-xl px-5 pb-2 shadow-sm relative">
    <h1 class="text-xl md:text-2xl font-bold text-dark dark:text-white mt-2 mb-5">Checklist of Requirement</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
       <slot></slot>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>