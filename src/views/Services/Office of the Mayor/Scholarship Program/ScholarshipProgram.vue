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
  description: 'Educational Assistance Program is a government-provided social protection program that helps students in crisis. The program provides financial assistance to students in elementary, high school, senior high school, and vocational/college levels'
}]
</script>

<template>
  <head>
    <title>Scholarship Program | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- hero section -->

 
  <WrapperContainer>
     <!-- <HeroScholar /> -->
  <Hero v-for="(data, index) in scholar" :key="index" :data="data"/>
  
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
  </WrapperContainer>

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>