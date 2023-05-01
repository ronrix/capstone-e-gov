<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import FirstSection from './Services Components/FirstSection.vue'
import Requirements from './Services Components/Requirements.vue'
import TableSteps from './Services Components/TableSteps.vue'
import Hero from './Services Components/Hero.vue'
import { ref, onMounted } from 'vue'
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
  axiosCall()
})
</script>

<template>
  <head>
    <title>Scholarship Program | Pililla Rizal</title>
  </head>

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
  </WrapperContainer>

  <FooterSection />
</template>

<style lang="scss" scoped></style>