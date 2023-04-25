<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import HeroEvents from './HeroEvents.vue'
</script>
<template>
  <HeaderSection />

  <div class="mt-10">
    <HeroEvents />
    <WrapperContainer class="mt-5">programs and events in here</WrapperContainer>
  </div>

  <FooterSection />
</template>