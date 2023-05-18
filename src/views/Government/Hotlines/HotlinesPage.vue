<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import HotlinesTable from '../../../components/Hotlines/HotlinesTable.vue'
import { useHotlineStore } from '../../../stores/hotlines-store'
import { onMounted, onUnmounted, ref } from 'vue'

const store = useHotlineStore()
const hotlines = ref()

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Emergency Hotines | Pililla Rizal'

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
  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <h3 class="font-bold text-2xl mb-2 text-dark dark:text-bggray">Emergency Hotlines</h3>
    <p class="mb-5 text-secondary dark:text-bggray">
      To use the emergency hotlines, simply dial the appropriate number and provide the necessary
      information to the operator. Make sure to stay calm and provide as much information as
      possible to help emergency responders quickly assess the situation and provide the necessary
      assistance.
    </p>
    <HotlinesTable :hotlines="hotlines" />
  </WrapperContainer>

  <FooterSection />
</template>