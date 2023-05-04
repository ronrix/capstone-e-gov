<script setup>
import Apartment from './Apartment.vue'
const apartments = [
  {
    location: 'M.A Roxas St. Bagumbayan Pililla, Rizal',
    imgSrc: 'images/apartment.jpg'
  },
  {
    location: 'M.A Roxas St. Bagumbayan Pililla, Rizal',
    imgSrc: 'images/apartment.jpg'
  }
]
</script>

<template>
  <div class="flex items-center gap-5 mt-24 mb-5">
    <div class="flex-1 border border-gray-600 dark:border-white"></div>
    <h1 class="text-2xl lg:text-3xl text-primary sm:text-dark dark:text-white font-bold">
      Looking for apartment?
    </h1>
  </div>
  <Apartment v-for="(apartment, idx) in apartments" :key="idx" :apartment="apartment" :idx="idx" />

  <div class="flex flex-col items-center mt-12">
    <h2 class="text-primary dark:text-white text-base md:text-xl font-bold">
      Find more available apartments
    </h2>
    <button class="bg-primary rounded-md px-2 py-1 text-white text-sm mt-2 hover:bg-primarylight">
      Find here
      <i class="uil uil-angle-right"></i>
    </button>
  </div>
</template>

<style lang="scss" scoped>
</style>