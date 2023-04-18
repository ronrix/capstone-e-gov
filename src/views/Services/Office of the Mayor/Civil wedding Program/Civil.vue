<script setup>
import HeaderSection from '../../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../../components/FooterSection/FooterSection.vue'
import Hero from '../../Services Components/Hero.vue'
import FirstSection from "../Scholarship Program/FirstSection.vue"
import SecondSection from "../Scholarship Program/SecondSection.vue"
import TableSteps from "../Scholarship Program/TableSteps.vue"

const civil = [{
  name:'civil wedding program',
  imgSrc:'/images/wedding.jpg'
}]
</script>

<template>
  <HeaderSection />
  <!-- hero section -->

  <Hero v-for="(data, id) in civil" :key="id" :data="data"/>
  <div class="mx-10">
    <!-- content -->
    <!-- first section -->
    <FirstSection name="Office of the Mayor" />
    <!-- second section -->
    <div class="rounded-lg  border-white p-5 shadow-sm relative">
      <h1 class="text-2xl font-bold text-dark dark:text-white mt-10 mb-5">Checklist of Requirement</h1>
      <div class="grid grid-cols-2 gap-2">
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
      </div>
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