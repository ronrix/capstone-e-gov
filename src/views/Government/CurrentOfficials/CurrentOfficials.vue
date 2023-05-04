<script setup>
import { onMounted, ref } from 'vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import OfficialsCard from '../../../components/Officials/OfficialsCard.vue'
import { fetchData } from '../../../utils/axios-instance'
import Loading from '../../../components/Loading.vue'

const loading = ref(true)
const mayor = ref()
const viceMayor = ref()
const officials = ref([])

const axiosCall = () => {
  fetchData('/current-officials')
    .then((data) => {
      officials.value = data.currentOfficials.filter(
        (official) => !official.position.includes('mayor')
      )
      //   find the mayor and vice mayor
      mayor.value = data.currentOfficials.find(
        (official) => official.position.toLowerCase() === 'mayor'
      )
      viceMayor.value = data.currentOfficials.find(
        (official) => official.position.toLowerCase() === 'vice mayor'
      )

      loading.value = false // set the loading to false
    })
    .catch((err) => console.log(err))
}

onMounted(() => {
  axiosCall()
})
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>Current Officials | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <h3 class="font-bold text-5xl text-dark dark:text-bggray text-center mb-16">
      Municipal Elected Officials
    </h3>

    <h4 v-if="!loading && !officials.length" class="text-3xl text-center">No data found</h4>
    <!-- loading animation -->
    <Loading v-if="loading" class="w-14 h-14 mx-auto" />
    <!-- no data found -->
    <section v-if="!loading" class="flex flex-col justify-center items-center w-full gap-y-16">
      <!-- mayor -->
      <OfficialsCard v-if="mayor" :official="mayor" />

      <!-- vice mayor -->
      <OfficialsCard v-if="viceMayor" :official="viceMayor" />

      <!-- subodinates -->
      <div class="flex flex-wrap gap-y-16">
        <OfficialsCard v-for="official in officials" :key="official.id" :official="official" />
      </div>
    </section>
  </WrapperContainer>

  <FooterSection />
</template>