<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HotlinesTable from '../../../components/Hotlines/HotlinesTable.vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { useHotlineStore } from '../../../stores/hotlines-store'
import { fetchData } from '../../../utils/axios-instance'
import { be_url } from '../../../assets/config/config'

const store = useHotlineStore()
const hotlines = ref()

const fullDisclosures = ref([])
const axiosCall = () => {
  fetchData('/full-disclosure-reports')
    .then((data) => {
      fullDisclosures.value = data.full_disclosure
    })
    .catch((err) => {
      console.log(err)
    })
}
onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()

  // add tab title
  document.title = 'Full Disclosure Reports | Pililla Rizal'

  if (store.getHotlines()) {
    hotlines.value = store.getHotlines()
  } else {
    hotlines.value = JSON.parse(localStorage.getItem('hotlines'))
  }
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection></HeaderSection>

  <div class="mt-5 mb-5 dark:bg-dark bg-bggray">
    <WrapperContainer class="sm:px-3">
      <h1 class="text-4xl pt-4 pb-3 border-b-2 dark:text-white">Disclosure Reports</h1>
      <div class="flex flex-col gap-2 pb-5 pt-4 w-fit dark:text-white">
        <a
          v-for="reports in fullDisclosures"
          :key="reports.id"
          class="hover:text-primary"
          :href="be_url + '/' + reports.filepath"
          target="_blank"
          >2010 Annual Budget</a
        >
      </div>
    </WrapperContainer>
  </div>

  <WrapperContainer class="p-5">
    <div class="flex items-center mb-3">
      <h2 class="text-3xl dark:text-white">Emergency Hotlines</h2>
    </div>

    <HotlinesTable :hotlines="hotlines" />
  </WrapperContainer>

  <FooterSection></FooterSection>
</template>
<style>
</style>