<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import FirstSection from '../Services Components/FirstSection.vue'
import RequirementsWrapper from '../Services Components/RequirementsWrapper.vue'
import SecondSection from '../Services Components/SecondSection.vue'
import TableSteps from '../Services Components/TableSteps.vue'
import Hero from '../Services Components/Hero.vue'

const mayor = [{
  name:'Special Program Employment for Students',
  description:' is DOLE’s youth employment-bridging program which aims to provide temporary employment to poor but deserving students, out-of-school youth, and dependents of displaced or would-be displaced workers during summer and/or Christmas vacation or any time of the year to augment the family’s income to help ensure that beneficiaries are able to pursue their education.'
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