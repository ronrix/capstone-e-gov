<script setup>
import Dropdown from './Dropdown.vue'

const departments = [
  {
    name: 'Office of the Mayor',
    services: [
      { path: '/scholarship-program', name: 'Scholarship Program' },
      { path: '/civil-wedding-program', name: 'Civil Wedding Program' },
      { path: '/mayors-clearance', name: 'Mayors Clearance' }
    ]
  },
  {
    name: 'MSWD Department',
    services: [
      { path: '/government-id', name: 'Government ID' },
      { path: '/replacement-of-senior-citizen', name: 'Replacement of Senior Citizen' },
    ]
  },
  {
    name: 'Agriculture Department',
    services: [
      { path: '/technical-assistance-for-farmer', name: 'Technical Assistance for Farmer' },
      { path: '/treatment-and-vaccination-of-animals', name: 'Treatment and Vaccination of Animals' },
      { path: '/distributions-of-assorted-seeds-seedling', name: 'Distributions of Assorted Seeds or Seedling' },
      { path: '/delivery-of-farm-fishery-inputs', name: 'Delivery of Farm & Fishery Inputs' },
      { path: '/issuance-of-moa-certification', name: 'Issuance of MOA Certification' },
      { path: '/capacity-building-enhancement-training', name: 'Capacity Building Enhancement Training' },
    ]
  },
  {
    name: 'Public Employment Service Office',
    services: [
      { path: '/special-program-employment-for-students', name: 'Special Program Employment for Students' },
      { path: '/job-fair', name: 'Job Fair' },
    ]
  },
]

</script>

<template>
  <div class="flex items-center justify-center mt-10 p-5 h-[100px] relative">
    <h1 class="text-center text-4xl font-bold text-gray-800">
      What we can offer in <span class="block">every department.</span>
    </h1>
  </div>
  <!-- departments with services -->
  <h2
    class="z-100 text-2xl font-semibold text-gray-700 mb-2 border-gray-500 border-x-0 border-t-0 border-b-2 w-[170px] ml-32"
  >
    Departments
  </h2>
  <Dropdown v-for="(department, id) in departments" :key="id" :department="department"/>
</template>



<style lang="scss" scoped>
</style>