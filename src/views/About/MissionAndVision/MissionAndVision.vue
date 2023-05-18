<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import { onMounted, onUnmounted } from 'vue'

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Mission and Vision | Pililla Rizal'
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <head>
    <title>Mission & Vision | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <div class="w-full mt-10 flex flex-col items-center mb-20">
    <h1
      class="text-center text-primary dark:text-primarylight font-bold text-3xl md:text-4xl mb-5 md:mb-10"
    >
      Our Mission & Vision
    </h1>
    <div class="flex flex-col mx-16 md:mx-32 lg:mx-44 gap-10">
      <div class="flex flex-col">
        <h2
          class="text-center text-dark dark:text-white text-xl md:text-2xl font-bold mb-2 md:mb-3 font-display"
        >
          Mission
        </h2>
        <p class="text-base lg:text-lg text-dark dark:text-white text-center font-normal">
          “To improve the economic condition of the people of Pililla through the introduction of
          better economic opportunities, enhancement of revenue generation and better accessibility
          of basic services and needs.”
        </p>
      </div>
      <div class="flex flex-col">
        <h2
          class="text-center text-dark dark:text-white text-xl md:text-2xl font-bold mb-3 md:mb-5 font-display"
        >
          Vision
        </h2>
        <p class="text-base lg:text-lg text-dark dark:text-white text-center font-normal">
          “We envision Pililla as the alternative energy capital of the Philippines, with a
          God-fearing, peaceful, disaster resilient community, conducive to sustainable development
          and efficient management of natural and land resources through active, participative,
          responsive and committed leadership.”
        </p>
      </div>
    </div>
  </div>
  <WrapperContainer> </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>