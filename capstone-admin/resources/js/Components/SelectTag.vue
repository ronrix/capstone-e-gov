<template>
  <div class="text-gray-600 text-sm relative font-[500]">
    <!-- button to toggle the dropdown -->
    <div @click="toggleDropdown" class="flex items-center justify-between bg-white px-3 rounded-md cursor-pointer hover:bg-blue-600 hover:text-white">
      <select :value="value" :id="type" class="hidden">
        <option v-for="filter in filterArray" :value="filter">{{ filter }}</option>
      </select>
      {{ value }} 
      <i class="uil uil-angle-down"></i>
    </div>
    <!-- dropdown -->
    <div :class="{ '!scale-100' : isOpen }" class="flex flex-col gap-2 rounded-md absolute top-full bg-white z-50 mt-1 shadow-lg scale-0 duration-75 overflow-hidden origin-top">
      <span @click="handleSelect" v-for="filter in filterArray" :id="filter" class="cursor-pointer hover:bg-blue-600 hover:text-white px-3">{{ filter }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const isOpen = ref(false);
function toggleDropdown() {
  isOpen.value = !isOpen.value;
}

function handleSelect(e) {
  filterFn(type, e.target.id);

  toggleDropdown();
}

const { type, filterFn } = defineProps({
  type: String,
  filterFn: Function,
  value: String,
  filterArray: Array,
});
</script>