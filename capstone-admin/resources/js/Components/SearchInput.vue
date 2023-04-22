<template>
  <!-- filter -->
  <div class="w-full flex items-center">
    <label class="w-full flex items-center rounded-lg p-2 text-sm bg-slate-100">
      <i class="uil uil-search-alt pr-3"></i>
      <input type="search" @change="$emit('searchFn', $event.target.value)" :placeholder="placeholder"
        class="bg-transparent outline-none w-full" />
    </label>
  </div>
</template>

<script setup>
defineProps({
  placeholder: String
})
</script>