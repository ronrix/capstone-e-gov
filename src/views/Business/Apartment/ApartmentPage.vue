<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSectionVue from '../../../components/FooterSection/FooterSection.vue'
import HeroApartment from './HeroApartment.vue'
import Filter from './Filter.vue'
import Apartments from './Apartments.vue'

const house = [{
 barangay: 'Bagumbayan Pililla Rizal',
 address: 'M.A. ROxas St. Bagumbayan',
 imgSrc: 'images/apartment-1.png'
},
{
 barangay: 'Halayahayin Pililla, Rizal',
 address: 'A. Paz St. Bonifacio ',
 imgSrc: 'images/apartment-2.png'
},
{
 barangay: 'Quisao Pililla, RIzal',
 address: 'San Antonio St.',
 imgSrc: 'images/apartment-3.jpg'
},
]
</script>

<template>
  <HeaderSection />
  <!-- hero section -->
  <HeroApartment />
  <WrapperContainer>
    <!-- filter by -->
    <Filter />
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
      <Apartments v-for="(data, idx) in house" :key="idx" :data="data"/>
    </div>
  </WrapperContainer>
  <FooterSectionVue />
</template>

<style lang="scss" scoped>
</style>