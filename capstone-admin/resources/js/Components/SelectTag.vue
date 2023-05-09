<template>
  <div class="text-gray-600 text-sm relative font-[500]">
    <!-- button to toggle the dropdown -->
    <div ref="selectDiv" @click="toggleDropdown"
      class="flex items-center justify-between bg-white px-3 rounded-md cursor-pointer hover:bg-blue-600 hover:text-white capitalize">
      <select :value="value" :id="type" class="hidden">
        <option v-for="filter, idx in filterArray" :key="idx" :value="filter">{{ filter }}</option>
      </select>
      {{ value ? value : 'none' }}
      <i class="uil uil-angle-down pointer-events-none"></i>
    </div>
    <!-- dropdown -->
    <div :class="addedClass" id="dd-select"
      class="backdrop-blur-lg flex flex-col gap-2 rounded-lg absolute top-full bg-white/50 z-50 mt-1 shadow-lg h-0 duration-75 overflow-y-auto origin-top w-full md:w-auto min-w-[100px] scrollbar">
      <span @click="handleSelect" v-for="filter, idx in filterArray" :id="filter" :key="idx"
        class="cursor-pointer hover:bg-blue-600 hover:text-white text-black px-3 capitalize">{{ filter }}</span>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const selectDiv = ref(null);
function toggleDropdown(e) {
  document.querySelectorAll("#dd-select").forEach(el => {
    // remove other opened select dropdowns with their corresponding styles
    if (el.classList.contains("!h-[200px]") && el !== e.target.nextElementSibling) {
      el.classList.remove("!h-[200px]");
      el.previousElementSibling.classList.toggle("bg-blue-600");
    }
    // add opened select dropdowns with their corresponding styles
    if (el === e.target.nextElementSibling) {
      e.currentTarget.classList.toggle("bg-blue-600");
      el.classList.toggle("!h-[200px]");
    }
  });
}

function handleSelect(e) {
  filterFn(type, e.target.id);

  selectDiv.value.click();
}

const { type, filterFn } = defineProps({
  type: String,
  filterFn: Function,
  value: String,
  filterArray: Array,
  addedClass: String,
});
</script>