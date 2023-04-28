<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue';
import FooterSection from '../../../components/FooterSection/FooterSection.vue';
import SearchAndFilter from './SearchAndFilter.vue';
import Businesses from './Businesses.vue';
import HeroBusinessEstablishment from './HeroBusinessEstablishment.vue';

const businesses = [{
  name: '7 eleven',
  branch: 'Imatong Pililla, Rizal',
  location: 'J.P. Rizal St, Pililla, Rizal',
  imgSrc:'images/businesses/7-11.jpg'
},
{
  name: 'BDO',
  branch: 'Bagumbayan Pililla, Rizal',
  location: 'A. Paz Street, Pililla, Rizal',
  imgSrc:'images/businesses/bdo.jpg'
},
{
  name: 'Bulawan floating restaurant',
  branch: 'Halayhayin Pililla, Rizal',
  location: 'Km. 59 National Highway, Pililla, 1910 Rizal',
  imgSrc:'images/businesses/bulawan.jpg'
},
{
  name: 'Generika',
  branch: 'Takungan Pililla, Rizal',
  location: 'J.P. Rizal St, Pililla, Rizal',
  imgSrc:'images/businesses/generika.jpg'
},
{
  name: 'raskies kainan',
  branch: 'Bagumbayan Pililla, Rizal',
  location: 'A. Paz Street, Pililla, Rizal',
  imgSrc:'images/businesses/raskies.jpg'
},
]
</script>

<template>
    <HeaderSection />
  <WrapperContainer>
    <!-- search and filter by -->
    <HeroBusinessEstablishment />
    <SearchAndFilter />
    <!-- businesses card -->
    <div class="w-full grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3  gap-3 mt-7">
      <Businesses v-for="(data, index) in businesses" :key="index" :data="data"  />
    </div>
   
  </WrapperContainer>
    <FooterSection />
</template>

<style lang="scss" scoped>

</style>