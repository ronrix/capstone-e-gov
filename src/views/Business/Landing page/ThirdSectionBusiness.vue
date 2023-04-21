<script setup>
import Permit from './Permit.vue';
const permits = [{
 name: 'Business Registration',
 department: 'Business Permit and Licensing Office'
},
{
 name: 'Issuance of MOA certification',
 department: 'Agriculture Department'
},
{
 name: 'Mayors Clearance',
 department: 'Office of the mayor'
}
]
</script>

<template>
    <div class="w-full bg-gray-700 dark:bg-gray-500 h-28 mt-10 flex items-center px-5 gap-2 mb-5" >
        <h1 class="text-2xl text-white font-bold capitalize">Businesses permit</h1>
        <i class="uil uil-file-check-alt text-4xl text-white"></i>
    </div>
        <!-- business permits -->
    <Permit v-for="(data, id) in permits" :id="id" :key="id" :data="data" />
    <button class="bg-primary hover:bg-primarylight text-sm rounded-md text-white ml-16 mt-10 py-3 px-5 mb-10">
       View all businesses permits
       <i class="uil uil-angle-right ml-2"></i>
    </button>
</template>

<style lang="scss" scoped>

</style>