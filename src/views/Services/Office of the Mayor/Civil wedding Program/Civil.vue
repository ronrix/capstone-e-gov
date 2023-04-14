<script setup>
import HeaderSection from '../../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../../components/FooterSection/FooterSection.vue'
import HeroCivil from './HeroCivil.vue'
import FirstSection from "../Scholarship Program/FirstSection.vue"
import SecondSection from "../Scholarship Program/SecondSection.vue"
import TableSteps from "../Scholarship Program/TableSteps.vue"
</script>

<template>
  <HeaderSection />
  <!-- hero section -->
  
   <HeroCivil />
   <div class="mx-10">
  <!-- content -->
  <!-- first section -->
  <FirstSection name="Office of the Mayor" />
  <!-- second section -->
  <div class="bg-gray-50 p-10 rounded-2xl shadow-sm mt-5">
   <h1 class="text-2xl font-bold text-gray-700  mb-5">Checklist of Requirement</h1>
  <div class="grid grid-cols-2 gap-2">
    <SecondSection name="Example requirements" />
    <SecondSection name="Example requirements" />
    <SecondSection name="Example requirements" />
    <SecondSection name="Example requirements" />
    <SecondSection name="Example requirements" />
  </div>
  </div>
  
  <!-- table -->
  <h1 class="text-2xl font-bold text-gray-700 ml-10 mt-10 mb-0">What's the process?</h1>
   <TableSteps />
  </div>
  

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>