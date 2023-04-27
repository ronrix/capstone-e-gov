<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import Loading from '../../../components/Loading.vue'
import OfficialsCard from '../../../components/Officials/OfficialsCard.vue'
import { ref, onMounted } from 'vue'
import { axiosInstance } from '../../../utils/axios-instance'
import { be_url } from '../../../assets/config/config'

const loading = ref(true)
const mayor = ref()
const viceMayor = ref()
const officials = ref([])

const axiosCall = () => {
  axiosInstance()
    .get(be_url + '/former-officials', { withCredentials: true })
    .then(({ data }) => {
      officials.value = data.formerOfficials.filter(
        (official) => !official.position.includes('mayor')
      )
      //   find the mayor and vice mayor
      mayor.value = data.formerOfficials.find(
        (official) => official.position.toLowerCase() === 'mayor'
      )
      viceMayor.value = data.formerOfficials.find(
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
    <title>Former Officials | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <h3 class="font-bold text-5xl text-dark dark:text-bggray text-center mb-16">
      Former Municipal Elected Officials
    </h3>

    <section class="flex flex-col justify-center items-center w-full gap-y-16">
      <h4 v-if="!loading && !officials.length" class="text-3xl text-center">No data found</h4>
      <!-- loading animation -->
      <Loading v-if="loading" class="w-14 h-14 mx-auto" />
      <!-- no data found -->
      <section
        v-if="!loading && officials && mayor && viceMayor"
        class="flex flex-col justify-center items-center w-full gap-y-16"
      >
        <!-- mayor -->
        <OfficialsCard :official="mayor" />

        <!-- vice mayor -->
        <OfficialsCard :official="viceMayor" />

        <!-- subodinates -->
        <div class="flex flex-wrap gap-y-16">
          <OfficialsCard v-for="official in officials" :key="official.id" :official="official" />
        </div>
      </section>
    </section>
  </WrapperContainer>

  <FooterSection />
</template>