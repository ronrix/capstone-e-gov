<script setup>
import Dropdown from './Dropdown.vue';

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
      { path: '/replacement-of-senior-citizen', name: 'Replacement of Senior Citizen' }
    ]
  },
  {
    name: 'Agriculture Department',
    services: [
      { path: '/technical-assistance-for-farmer', name: 'Technical Assistance for Farmer' },
      {
        path: '/treatment-and-vaccination-of-animals',
        name: 'Treatment and Vaccination of Animals'
      },
      {
        path: '/distributions-of-assorted-seeds-seedling',
        name: 'Distributions of Assorted Seeds or Seedling'
      },
      { path: '/delivery-of-farm-fishery-inputs', name: 'Delivery of Farm & Fishery Inputs' },
      { path: '/issuance-of-moa-certification', name: 'Issuance of MOA Certification' },
      {
        path: '/capacity-building-enhancement-training',
        name: 'Capacity Building Enhancement Training'
      }
    ]
  },
  {
    name: 'Public Employment Service Office',
    services: [
      {
        path: '/special-program-employment-for-students',
        name: 'Special Program Employment for Students'
      },
      { path: '/job-fair', name: 'Job Fair' 
      }
    ]
  }
]
</script>

<template>
  <div class="flex items-center justify-center sm:mb-5 mt-44 md:mt-52 p-2 h-[100px]">
    <h1 class="text-center text-2xl lg:text-4xl mb-0 font-bold text-dark dark:text-white">
      What we can offer in <span class="block">every department.</span>
    </h1>
  </div>
  <!-- departments with services -->
  <WrapperContainer>
    <h2 class="text-xl md:text-2xl ml-2 sm:ml-1 font-semibold  text-dark dark:text-white mb-2">Departments</h2>
    <Dropdown v-for="(department, id) in departments" :key="id" :department="department"/>
  </WrapperContainer>
</template>



<style lang="scss" scoped>
</style>