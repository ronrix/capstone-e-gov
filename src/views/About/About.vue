<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
</script>

<template>
  <head>
    About
  </head>
  <HeaderSection></HeaderSection>
  <WrapperContainer>
    <div class="sm:flex justify-evenly pt-10 ">
        <div>
            <h1 class="text-dark text-3xl sm:text-5xl font-semibold">OUR MISSION <span class="block ">& Vission</span></h1>
        </div>
      <div class="grid gap-10 sm:w-1/2">
        <h2 class="grid gap-2 font-semibold">
          Mission<span class="block font-normal text-sm "
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a type specimen book. It has
            survived not only five centuries, but also the leap</span
          >
        </h2>
        <h2 class="grid gap-2 font-semibold ">
          Vission<span class="block font-normal text-sm"
            >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
            has been the industry's standard dummy text ever since the 1500s, when an unknown
            printer took a galley of type and scrambled it to make a type specimen book. It has
            survived not only five centuries, but also the leap</span
          >
        </h2>
      </div>
    </div>
    <img class="sm:w-[45%] -translate-y-0 sm:-translate-y-[30%]" src="../../../public/images/PeopleConnectedVector.png" alt="">
</WrapperContainer>

  <FooterSection></FooterSection>
</template>

<style>
</style>