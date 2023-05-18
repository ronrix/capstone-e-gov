<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import FirstSection from './ServicesComponents/FirstSection.vue'
import Requirements from './ServicesComponents/Requirements.vue'
import TableSteps from './ServicesComponents/TableSteps.vue'
import Hero from './ServicesComponents/Hero.vue'
import ApplySection from './ServicesComponents/ApplySection.vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import { useRoute } from 'vue-router'

const route = useRoute()
const services = ref()
const axiosCall = () => {
  fetchData('/services/' + route.params.title)
    .then((data) => {
      services.value = data.services[0]
    })
    .catch((err) => console.log(err))
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Services | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>

<template>
  <HeaderSection />
  <!-- hero section -->

  <WrapperContainer>
    <!-- <HeroScholar /> -->
    <Hero :title="services?.title" :description="services?.description" />

    <!-- content -->
    <!-- first section -->
    <FirstSection :department="services?.service_department" />
    <!-- second section -->
    <Requirements :requirements="services?.service_requirements" />

    <!-- table -->
    <TableSteps :processes="services?.service_process" />

    <!-- application form -->
    <ApplySection :service="services" />
  </WrapperContainer>

  <FooterSection />
</template>

<style lang="scss" scoped></style>