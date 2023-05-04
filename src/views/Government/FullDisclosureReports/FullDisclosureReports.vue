<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HotlinesTable from '../../../components/Hotlines/HotlinesTable.vue'
import { ref, onMounted } from 'vue'
import { useHotlineStore } from '../../../stores/hotlines-store'

const store = useHotlineStore()
const hotlines = ref()

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  if (store.getHotlines()) {
    hotlines.value = store.getHotlines()
  } else {
    hotlines.value = JSON.parse(localStorage.getItem('hotlines'))
  }
})
</script>
<template>
  <HeaderSection></HeaderSection>

  <div class="mt-5 mb-5 dark:bg-dark bg-bggray">
    <WrapperContainer>
      <h1 class="text-5xl pt-4 pb-3 border-b-2 dark:text-white">Annual Budget</h1>
      <div class="flex flex-col gap-2 pb-5 pt-4 w-fit dark:text-white">
        <a class="hover:text-primary" href="" target="_blank">2010 Annual Budget</a>
        <a class="hover:text-primary" href target="_blank">2015 Annual Budget</a>
        <a class="hover:text-primary" href="" target="_blank">2018 Annual Budget</a>
        <a class="hover:text-primary" href="" target="_blank">2020 Annual Budget</a>
      </div>
    </WrapperContainer>
  </div>

  <WrapperContainer class="p-5">
    <div class="flex items-center mb-8">
      <h2 class="text-5xl dark:text-white">Emergency Hotlines</h2>
      <div class="ml-2 border-t-[2px] flex-1 w-full"></div>
    </div>

    <HotlinesTable :hotlines="hotlines" />
  </WrapperContainer>

  <FooterSection></FooterSection>
</template>
<style>
</style>