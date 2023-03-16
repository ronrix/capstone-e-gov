<template>
  <label class="text-sm ml-5">
    <span class="text-gray-500 font-bold">
      Filter by:
    </span>
    <select :value="sortBy" @change="sortFn" class="bg-white px-3 font-bold rounded-md">
      <option v-for="sortCat in sortCategories" :value="sortCat">{{ sortCat }}</option>
    </select>
  </label>
</template>

<script setup>
defineProps({
  sortBy: String,
  sortFn: Function,
  sortCategories: Array
})
</script>