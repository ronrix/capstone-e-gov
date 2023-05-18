<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeroServices from './HeroServices.vue'
import Department from './Department.vue'
import { onMounted, onUnmounted } from 'vue'

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Services | Pililla Rizal'
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>

<template>
  <head>
    <title>Services | Pililla Rizal</title>
  </head>

  <!-- header -->
  <HeaderSection />
  <!-- hero -->
  <HeroServices />
  <!-- section -->
  <Department />
  <!-- footer -->
  <FooterSection />
</template>


<style lang="scss" scoped>
</style>