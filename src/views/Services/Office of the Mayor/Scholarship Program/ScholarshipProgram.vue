<script setup>
import HeaderSection from '../../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../../components/FooterSection/FooterSection.vue'
import FirstSection from '../../Services Components/FirstSection.vue'
import RequirementsWrapper from '../../Services Components/RequirementsWrapper.vue'
import SecondSection from '../../Services Components/SecondSection.vue'
import TableSteps from '../../Services Components/TableSteps.vue'
import Hero from '../../Services Components/Hero.vue'



const scholar = [{
  name:'educational assistance for students',
  imgSrc:'./images/scholar.jpg'
}]
</script>

<template>
  <head>
    <title>Scholarship Program | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- hero section -->

  <!-- <HeroScholar /> -->
  <Hero v-for="(data, index) in scholar" :key="index" :data="data"/>
  <div class="mx-10">
    <!-- content -->
    <!-- first section -->
    <FirstSection name="Office of the Mayor" />
    <!-- second section -->
    <RequirementsWrapper>
      <SecondSection name="ID Xerox" />
          <SecondSection name="Barangay Indigency" />
          <SecondSection name="2x2 Pictures" />
          <SecondSection name="Proofed of Enrollment" />
          <SecondSection name="Latest Grades" />
    </RequirementsWrapper>
        

      <!-- table -->
    <TableSteps />
  </div>

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>