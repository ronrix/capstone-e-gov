<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import { onMounted, ref } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import PopulationTable from './PopulationTable.vue'
import Loading from '../../../components/Loading.vue'

const selectedCensus = ref()
const loading = ref(true)
const populationSize = ref()
const householdSize = ref()
const censusYear = ref()
const populations = ref([])

function handleSelectCensusYear(e) {
  selectedCensus.value = populations.value.find((p) => p.census_year === e.target.value)
  populationSize.value = populations.value.barangays.map((a, id) => {
    const sum = a.male + a.female
    return {
      id,
      average: (sum / selectedCensus.value.total_population) * 100,
      barangay: a.barangay
    }
  })
  householdSize.value = populations.value.barangays.map((a, id) => {
    return {
      id,
      average: (a.household / selectedCensus.value.total_population) * 100,
      barangay: a.barangay
    }
  })

  sortPopulationsNHousehold()
}

// sorting populations and households
function sortPopulationsNHousehold() {
  populationSize.value = populationSize.value.sort((a, b) => {
    return a.average < b.average
  })
  householdSize.value = householdSize.value.sort((a, b) => {
    return a.average < b.average
  })
}

const axiosCall = () => {
  fetchData('/populations')
    .then((data) => {
      selectedCensus.value = data.populations[0] // current population
      loading.value = false
      populations.value = data.populations // get all populations

      //   calculat the percentage of the populations size each barangay and sort them
      populationSize.value = JSON.parse(selectedCensus.value.barangays).map((a, id) => {
        const sum = a.male + a.female
        return {
          id,
          average: (sum / selectedCensus.value.total_population) * 100,
          barangay: a.barangay
        }
      })

      //   household size
      householdSize.value = JSON.parse(selectedCensus.value.barangays).map((a, id) => {
        return {
          id,
          average: (a.household / selectedCensus.value.total_population) * 100,
          barangay: a.barangay
        }
      })

      //   sort population size and household size
      sortPopulationsNHousehold()
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
    <title>News | Pililla Rizal</title>
  </head>
  <HeaderSection />
  <WrapperContainer class="mt-14">
    <div class="flex flex-col gap-3">
      <h1 class="text-base font-bold text-primarylight">Demographics</h1>
      <h3 class="text-5xl font-bold w-1/2">The Population of Pililla, Rizal</h3>
      <p class="text-dark">
        The total population of Pililla has been rising and falling between 1995 and 2015. There was
        2.03 percent increase between 1995 and 2000 but there was also a steep drop of -3% between
        2007 and 2010. The simple average of the population figure shows a mere 0.23% increase over
        the five year span from 2010 to 2015.
      </p>
    </div>

    <!-- select the census year -->
    <select
      class="mt-14 px-3 py-1 bg-slate-100 text-sm capitalize border"
      @change="handleSelectCensusYear"
    >
      <option value="latest census year" selected disabled>
        select for census year (default latest)
      </option>
      <option v-for="year in censusYear" :key="year" :value="year">{{ year }}</option>
    </select>

    <!-- current population -->
    <h4 class="font-bold text-2xl mb-2 text-dark">Census of {{ selectedCensus?.census_year }}</h4>
    <Loading v-if="loading" class="w-14 h-14 mx-auto" />
    <PopulationTable v-else :population="selectedCensus" table-type="census" />
    <!-- population size -->
    <h4 class="font-bold text-2xl mt-14">The population size</h4>
    <p class="mb-3">
      According to the latest PSA Census, Pililla had
      {{ new Intl.NumberFormat().format(selectedCensus?.total_population) }} inhabitants in
      {{ selectedCensus?.census_year }}.
    </p>
    <ul class="list-disc ml-3">
      <li v-for="size in populationSize" :key="size.id">
        <span class="font-[600] capitalize">{{ size.barangay }}</span> accounted for
        <span class="font-[600] text-primarylight">{{ size.average.toFixed(2) }}%</span> of the
        total population
      </li>
    </ul>

    <!-- household -->
    <div class="mt-14">
      <h4 class="font-bold text-2xl mb-2 text-dark">Household</h4>
      <p v-if="householdSize" class="mb-2">
        In {{ selectedCensus?.census_year }},
        <span class="capitalize font-[600]">{{ householdSize[0]?.barangay }}</span> had the most
        number of households representing {{ householdSize[0].average.toFixed(2) }}% of the total,
        followed by <span class="capitalize font-[600]">{{ householdSize[1].barangay }}</span> at
        {{ householdSize[1].average.toFixed(2) }}%,
        <span class="capitalize font-[600]">{{ householdSize[2].barangay }}</span> at
        {{ householdSize[2].average.toFixed(2) }}% and
        <span class="capitalize font-[600]">{{ householdSize[3].barangay }}</span> at
        {{ householdSize[3].average.toFixed(2) }}7%. In terms of average household size, while the
        remaining 5 barangays had average household size of
        {{ householdSize[4].average.toFixed(2) }}% and below.
      </p>
      <Loading v-if="loading" class="w-14 h-14 mx-auto" />
      <PopulationTable
        v-if="selectedCensus && !loading"
        :population="selectedCensus"
        table-type="household"
      />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>