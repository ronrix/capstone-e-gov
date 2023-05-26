<script setup>
defineProps({
  data: { type: Object, required: true }
})
</script>

<template>
  <div
    class="flex items-center justify-between bg-white dark:bg-dark rounded-lg border py-5 px-3 border-gray-300 shadow-sm mb-1"
  >
    <h4
      class="flex-1 text-dark dark:text-white text-sm md:text-base lg:text-lg font-bold capitalize"
    >
      {{ data.title }}
    </h4>
    <RouterLink
      :to="'/business/business-permit-and-licensing-office/' + data.id"
      class="flex items-center gap-1 bg-gray-100 hover:bg-gray-200 rounded-full ml-2 py-1 px-4 md:px-5 lg:px-6 text-xs sm:text-sm text-gray-500 hover:text-gray-600 uppercase font-bold"
    >
      view
      <i
        class="uil uil-angle-right-b text-gray-500 hover:text-gray-600 text-lg md:text-xl font-bold"
      ></i>
    </RouterLink>
  </div>
</template>


<style lang="scss" scoped>
</style>