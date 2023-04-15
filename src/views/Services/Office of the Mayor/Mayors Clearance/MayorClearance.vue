<script setup>
import HeaderSection from '../../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../../components/FooterSection/FooterSection.vue'
import HeroMayor from './HeroMayor.vue'
import FirstSection from "../Scholarship Program/FirstSection.vue"
import SecondSection from "../Scholarship Program/SecondSection.vue"
import TableSteps from "../Scholarship Program/TableSteps.vue"
</script>

<template>
  <HeaderSection />
  <!-- hero section -->

  <HeroMayor />
  <div class="mx-10">
    <!-- content -->
    <!-- first section -->
    <FirstSection name="Office of the Mayor" />
    <!-- second section -->
    <div class="rounded-lg  border-white p-5 shadow-sm relative">
      <h1 class="text-2xl font-bold text-dark dark:text-white mt-10 mb-5">Checklist of Requirement</h1>
      <div class="grid grid-cols-2 gap-2">
        <SecondSection name="ID Xerox" />
        <SecondSection name="Barangay Indigency" />
        <SecondSection name="2x2 Pictures" />
        <SecondSection name="Proofed of Enrollment" />
        <SecondSection name="Latest Grades" />
      </div>
      <div class="absolute w-[360px] h-[360px] -top-36 right-0 rounded-full bg-red-500 opacity-10 -z-10"></div>
    </div>

    <!-- table -->
    <h1 class="text-2xl font-bold text-dark dark:text-white ml-10 mt-10 mb-0">What's the process?</h1>
    <TableSteps />
  </div>

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>

<style lang="scss" scoped>
</style>