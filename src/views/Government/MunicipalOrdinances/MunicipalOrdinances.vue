<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import { be_url } from '../../../assets/config/config'

const ordinances = ref([])
const axiosCall = () => {
  fetchData('/ordinances')
    .then((data) => {
      ordinances.value = data.ordinances
    })
    .catch((err) => {
      console.log(err)
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Municipal Ordinances | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection />
  <WrapperContainer class="sm:px-3">
    <div class="flex items-center">
      <h1 class="text-2xl md:text-3xl py-10 font-bold dark:text-bggray">Municipal Ordinances</h1>
    </div>
    <h5 v-if="!activeOrdinance && !ordinances.length" class="font-bold text-2xl">
      No ordinances yet!
    </h5>
    <div v-else class="flex flex-col gap-5">
      <h3 class="text-dark dark:text-bggray text-xl font-semibold border border-x-0 border-t-0">
        List of ordinances
      </h3>
      <a
        v-for="ord in ordinances"
        :key="ord.id"
        :href="be_url + '/' + ord.pdf_path"
        class="line-clamp-2 text-xs sm:text-sm dark:text-bggray hover:text-primary dark:hover:text-primary w-fit"
        target="_blank"
      >
        {{ ord.title }}
      </a>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>
