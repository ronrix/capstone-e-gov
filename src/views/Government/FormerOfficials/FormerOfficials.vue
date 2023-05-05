<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import Loading from '../../../components/Loading.vue'
import OfficialsCard from '../../../components/Officials/OfficialsCard.vue'
import { ref, onMounted, computed } from 'vue'
import { fetchData } from '../../../utils/axios-instance'

const loading = ref(true)
const mayor = computed(() => {
  return officials.value.find((a) => a.position.toLowerCase() == 'mayor')
})
const viceMayor = computed(() => {
  return officials.value.find((a) => a.position.toLowerCase() == 'vice mayor')
})

// this variable is used to get the officials of the seletedYear
const officials = computed(() =>
  originalOfficials.value.filter((a) => new Date(a.end_term).getFullYear() == selectedYear.value)
)

// this variable is used to display all the sangguiang barangay officials
const sanggunianBayanOfficials = computed(() =>
  officials.value.filter((a) => !a.position.includes('mayor'))
)
const originalOfficials = ref([])
const getYears = ref([])
const selectedYear = ref()

const axiosCall = () => {
  fetchData('/former-officials')
    .then((data) => {
      getYears.value = [
        ...new Set([...data.formerOfficials.map((a) => new Date(a.end_term).getFullYear())])
      ]
      selectedYear.value = getYears.value[0] // select the first year
      originalOfficials.value = data.formerOfficials // store the original executives
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

    <!-- select year -->
    <p class="text-sm text-secondary font-bold text-center">Select a year</p>
    <select
      v-model="selectedYear"
      class="px-4 mx-auto block border border-secondary mb-16 rounded-md"
    >
      <option v-for="year in getYears" :key="year" :value="year">{{ year }}</option>
    </select>

    <section class="flex flex-col justify-center items-center w-full gap-y-16">
      <h4 v-if="!loading && !officials.length" class="text-3xl text-center">No data found</h4>
      <!-- loading animation -->
      <Loading v-if="loading" class="w-14 h-14 mx-auto" />
      <!-- no data found -->
      <section
        v-if="!loading && officials.length"
        class="flex flex-col justify-center items-center w-full gap-y-16"
      >
        <!-- mayor -->
        <OfficialsCard v-if="mayor" :official="mayor" />

        <!-- vice mayor -->
        <OfficialsCard v-if="viceMayor" :official="viceMayor" />

        <!-- subodinates -->
        <div class="flex flex-wrap gap-y-16">
          <OfficialsCard
            v-for="official in sanggunianBayanOfficials"
            :key="official.id"
            :official="official"
          />
        </div>
      </section>
    </section>
  </WrapperContainer>

  <FooterSection />
</template>