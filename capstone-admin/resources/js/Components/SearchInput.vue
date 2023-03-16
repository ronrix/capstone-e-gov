<template>
  <!-- filter -->
  <div class="w-full flex items-center">
    <label class="flex items-center rounded-lg p-2 text-sm bg-white">
      <i class="uil uil-search-alt pr-3"></i>
      <input type="search" @change="$emit('searchFn', $event.target.value)" placeholder="search news" class="bg-transparent outline-none" />
    </label>
  </div>
</template>

<script setup>
</script>