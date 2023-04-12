<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
</script>
<template>
  <HeaderSection></HeaderSection>
  <div class="pt-28 grid">
    <div class="flex justify-between items-center ">
        <p class="pl-20 text-8xl pt-10">Pililla Rizal<span class="block">Festival</span> </p>
      <div class="border-2 h-[500px] flex gap-5 pr-20">
        <div class="h-[400px] w-[250px] bg-slate-300 self-end"></div>
        <div class="h-[400px] w-[250px] bg-gray-500 bottom-20"></div>
        <div class="h-[400px] w-[250px] bg-cyan-300 self-end"></div>
      </div>
    </div>
  </div>
  <FooterSection></FooterSection>
</template>
<style >
</style>