<script setup>
import { ref, onMounted } from 'vue'

const barangays = ref([])
const totalHousehold = ref(0)

onMounted(() => {
  // sum all the populations (male, female)
  if (props.population?.barangays) {
    barangays.value = JSON.parse(props.population.barangays).map((a) => {
      totalHousehold.value += a.household
      return {
        barangay: a.barangay,
        population: a.male + a.female,
        household: a.household
      }
    })
    // sort the barangays
    if (props.tableType === 'census') {
      barangays.value = barangays.value.sort((a, b) => {
        a.population > b.population
      })
    } else {
      barangays.value = barangays.value.sort((a, b) => {
        a.household > b.household
      })
    }
  }
})

const props = defineProps({
  population: { type: Object, required: true },
  tableType: { type: String, required: true }
})
</script>
<template>
  <ul class="w-full border text-bggray">
    <li class="flex items-center bg-primarylight">
      <p class="flex-1 border border-y-0 border-l-0 border-bggray font-bold p-3">Barangays</p>
      <p class="flex-1 font-bold p-3">
        {{ tableType === 'census' ? `Population (Census ${population.census_year})` : 'Household' }}
      </p>
    </li>
    <li
      v-for="(pop, id) in barangays"
      :key="pop?.barangay"
      class="text-dark flex items-center"
      :class="{ 'bg-slate-100': id % 2, 'bg-white': !(id % 2) }"
    >
      <p class="flex-1 p-3 border border-l-0 border-t-0 capitalize">{{ pop?.barangay }}</p>
      <p class="flex-1 p-3 border border-x-0 border-t-0">
        {{
          tableType === 'census'
            ? new Intl.NumberFormat().format(pop?.population)
            : new Intl.NumberFormat().format(pop?.household)
        }}
      </p>
    </li>
    <li class="flex items-center bg-primarylight">
      <p class="flex-1 border border-y-0 border-l-0 border-bggray font-bold p-3">Total</p>
      <p class="flex-1 font-bold p-3">
        {{
          tableType === 'census'
            ? new Intl.NumberFormat().format(population?.total_population)
            : new Intl.NumberFormat().format(totalHousehold)
        }}
      </p>
    </li>
  </ul>
</template>