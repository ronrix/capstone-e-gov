<script setup>
import Dropdown from './Dropdown.vue'

const departments = [
  {
    name: 'Office of the Mayor',
    services: [
      { path: '/scholarship-program', name: 'Scholarship Program' },
      { path: '/scholarship-program', name: 'Scholarship Program' },
      { path: '/scholarship-program', name: 'Scholarship Program' }
    ]
  },
  {
    name: 'HR Department',
    services: [
      { path: '/scholarship-program', name: 'Scholarship Program' },
      { path: '/scholarship-program', name: 'Scholarship Program' },
      { path: '/scholarship-program', name: 'Scholarship Program' }
    ]
  }
]
</script>

<template>
  <div class="flex items-center justify-center mt-10 p-5 h-[100px]">
    <h1 class="text-center text-4xl font-bold text-gray-800">
      What we can offer in <span class="block">every department.</span>
    </h1>
  </div>
  <!-- departments with services -->
  <h2
    class="text-2xl font-semibold text-gray-700 mb-2 border-gray-500 border-x-0 border-t-0 border-b-2 w-[170px] ml-32"
  >
    Departments
  </h2>
  <Dropdown v-for="(department, id) in departments" :key="id" :department="department" />
</template>



<style lang="scss" scoped>
</style>