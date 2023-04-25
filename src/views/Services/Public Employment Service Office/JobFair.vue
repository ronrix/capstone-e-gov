<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import FirstSection from '../Services Components/FirstSection.vue'
import RequirementsWrapper from '../Services Components/RequirementsWrapper.vue'
import SecondSection from '../Services Components/SecondSection.vue'
import TableSteps from '../Services Components/TableSteps.vue'
import Hero from '../Services Components/Hero.vue'

const mayor = [{
  name:'job fair',
  description:'is an employment facilitation strategy aimed to fast-track the meeting of jobseekers and employers/overseas recruitment agencies in one venue at a specific date to reduce cost, time and effort particularly on the part of the applicants.'
}]
</script>

<template>
  <HeaderSection />
  <WrapperContainer>
  <!-- hero section -->
  <Hero v-for="(data, id) in mayor" :key="id" :data="data"/>
    <!-- content -->
    <!-- first section -->
    <FirstSection name="Office of the Mayor" />
    <!-- second section -->
   <RequirementsWrapper>
      <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
        <SecondSection name="Example requirements" />
   </RequirementsWrapper>
       

    <!-- table -->
    <TableSteps />
  </WrapperContainer>

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>

<style lang="scss" scoped>
</style>