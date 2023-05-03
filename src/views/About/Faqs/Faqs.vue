<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import Questions from './Questions.vue'

const questions = [
  {
    question: 'How many department in your municipal?',
    ans: 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam distinctio sunt, reiciendis fugit blanditiis repellendus similique sit facilis iste id molestias vero illum ullam voluptatum accusamus hic ratione eos? Consequatur.'
  },
  {
    question: 'How many department in your municipal?',
    ans: 'answer 2'
  },
  {
    question: 'How many department in your municipal?',
    ans: 'answer 3'
  }
]
</script>

<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="w-full flex flex-col gap-5 items-center mt-10">
      <p class="text-sm md:text-normal text-primary dark:text-primarylight font-bold uppercase">
        faq<span class="lowercase">s</span>
      </p>
      <h1 class="text-dark dark:text-white font-light text-3xl md:text-4xl">
        Frequenlty asked questions
      </h1>
      <h4 class="text-normal md:text-lg text-secondary dark:text-gray-200">
        Have questions? Were here to hep.
      </h4>
    </div>
    <!-- questions -->
    <div class="flex flex-col mt-20 mx-1 md:mx-5 lg:mx-20">
      <Questions v-for="(data, idx) in questions" :key="idx" :data="data" />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>