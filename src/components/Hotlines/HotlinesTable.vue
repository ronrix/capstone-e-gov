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
        <p class="border border-y-0 flex-1 p-2">Department</p>
        <p class="border border-y-0 flex-1 p-2">Numbers</p>
      </li>
      <li v-for="n in hotlines" :key="n.id" class="flex">
        <p class="border flex-1 p-2 capitalize">{{ n.department }}</p>
        <div class="border flex-1 p-2 flex flex-col">
          <p class="capitalize">{{ n.smart }}</p>
          <p class="capitalize">{{ n.globe }}</p>
          <p class="capitalize">{{ n.landline }}</p>
        </div>
      </li>
    </ul>
    <!-- tablet and desktop view -->
    <ul class="w-full border text-dark dark:text-bggray hidden sm:block">
      <li class="flex font-bold">
        <p class="border border-y-0 flex-1 p-2">Department</p>
        <p class="border border-y-0 flex-1 p-2">Smart</p>
        <p class="border border-y-0 flex-1 p-2">Globe</p>
        <p class="border border-y-0 flex-1 p-2">Landline</p>
      </li>
      <li v-for="n in hotlines" :key="n.id" class="flex">
        <p class="border flex-1 p-2 capitalize">{{ n.department }}</p>
        <p class="border flex-1 p-2">{{ n.smart }}</p>
        <p class="border flex-1 p-2">{{ n.globe }}</p>
        <p class="border flex-1 p-2">{{ n.landline }}</p>
      </li>
    </ul>
  </div>
</template>