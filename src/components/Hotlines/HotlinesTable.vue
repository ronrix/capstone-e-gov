<script setup>
defineProps({
  hotlines: { type: Array, required: true }
})
</script>
<template>
  <div v-if="!hotlines">
    <h4 class="font-bold text-3xl text-center">No emergency hotlines available</h4>
  </div>
  <div v-else>
    <!-- mobile view -->
    <ul class="w-full border text-dark dark:text-bggray block sm:hidden">
      <li class="flex font-bold">
        <p class="border border-y-0 flex-1 p-2">Departments | Barangays</p>
        <p class="border border-y-0 flex-1 p-2">Mobile Numbers</p>
      </li>
      <li v-for="n in hotlines" :key="n.id" class="flex">
        <p class="border flex-1 p-2 capitalize">{{ n.department }}</p>
        <div class="border flex-1 p-2 flex flex-col">
          <p class="capitalize">{{ n.mobile_number }}</p>
        </div>
      </li>
    </ul>
    <!-- tablet and desktop view -->
    <ul class="w-full border text-dark dark:text-bggray hidden sm:block">
      <li class="flex font-bold">
        <p class="border border-y-0 flex-1 p-2">Departments | Barangays</p>
        <p class="border border-y-0 flex-1 p-2">Mobile numbers</p>
      </li>
      <li v-for="n in hotlines" :key="n.id" class="flex">
        <p class="border flex-1 p-2 capitalize">{{ n.department }}</p>
        <p class="border flex-1 p-2">{{ n.mobile_number }}</p>
      </li>
    </ul>
  </div>
</template>