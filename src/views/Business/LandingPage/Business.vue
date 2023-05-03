<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeroBusinessVue from '../LandingPage/HeroBusiness.vue'
import FirstSectionBusiness from '../LandingPage/FirstSectionBusiness.vue'
import SecondSectionBusiness from '../LandingPage/SecondSectionBusiness.vue'
import ThirdSectionBusiness from './ThirdSectionBusiness.vue'
</script>

<template>
  <HeaderSection />
  <!-- hero section -->
  <HeroBusinessVue />
  <WrapperContainer>
    <!-- first section -->
    <FirstSectionBusiness />
    <!-- second section -->
    <SecondSectionBusiness />
  </WrapperContainer>
  <!-- third section -->
  <ThirdSectionBusiness />

  <FooterSection />
</template>


<style lang="scss" scoped>
</style>