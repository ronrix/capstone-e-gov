<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import BusinessPermits from './BusinessPermits.vue'

const permits = [
  {
     name: 'issuance of business permit',
     requirements: [
      "test", "Test"
     ]
  },
  {
     name: 'issuance of occupation permit'
  },
  {
    name: 'Mayors Permit'
  },
  {
    name: 'Mayors Clearance'
  },
  {
    name: 'Business Registration' 
  },
  {
    name: 'Business Renewal' 
  },
  {
    name: 'Business Permit' 
  },
]
</script>

<template>
  <HeaderSection class="relative"/>
  <WrapperContainer>
    <div class="w-full flex flex-col gap-4 items-center mt-24">
      <div class="relative mt-10">
        <h1 class="text-dark dark:text-white font-bold text-4xl md:text-5xl">
          <span class="text-primary dark:text-primarylight">Businesses permit</span> here.
        </h1>
        <div class="bg-primary dark:bg-primarylight absolute w-[45%] -bottom-1 h-1"></div>
      </div>
      <p class="text-base text-secondary dark:text-gray-100">
        See every businesses in every department.
      </p>
    </div>

    <!-- search  -->
    <div class="w-full flex flex-col items-center mt-10">
      <div
        class="w-full md:w-[450px] flex flex-row gap-3 items-center bg-white dark:bg-dark border border-gray-400 rounded-lg p-1 md:p-2"
      >
        <i class="uil uil-search text-lg text-dark dark:text-white"></i>
        <input
          class="w-full border-none outline-none bg-white dark:bg-dark text-sm text-dark dark:text-white placeholder:dark:text-white"
          type="text"
          placeholder="search business permit"
        />
      </div>
    </div>
    <!-- business permits -->
    <h2 class="w-full mt-10 text-sm font-bold text-dark dark:text-white">All businesses permits</h2>
    <!-- permits -->
    <div class="w-full mt-5">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <BusinessPermits v-for="(data, id) in permits" :key="id" :data="data" />
      </div>
      <!-- pass the data in bplo -->
      <!-- <BploModal v-for="(req, id) in permits" :key="id" :req="req" /> -->
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>