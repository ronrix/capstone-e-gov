<script setup>
import HeaderSection from '../../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../../components/FooterSection/FooterSection.vue'
import FirstSection from '../../Services Components/FirstSection.vue'
import RequirementsWrapper from '../../Services Components/RequirementsWrapper.vue'
import SecondSection from '../../Services Components/SecondSection.vue'
import TableSteps from '../../Services Components/TableSteps.vue'
import Hero from '../../Services Components/Hero.vue'

const mayor = [{
  name:'Mayors Clearance',
  imgSrc:'/images/mayor.jpg'
}]
</script>

<template>
  <HeaderSection />
  <!-- hero section -->
  <Hero v-for="(data, id) in mayor" :key="id" :data="data"/>

  <div class="sm:mx-2 md:mx-10">
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
  </div>

  <FooterSection />
</template>

<style lang="scss" scoped>
</style>

<style lang="scss" scoped>
</style>