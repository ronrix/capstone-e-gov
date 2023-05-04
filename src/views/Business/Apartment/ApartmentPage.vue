<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSectionVue from '../../../components/FooterSection/FooterSection.vue'
import HeroApartment from './HeroApartment.vue'
import Filter from './Filter.vue'
import { ref, onMounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import BusinessesCard from '../BusinessesCard.vue'
import DisplayModal from '../DisplayModal.vue'
import Loading from '../../../components/Loading.vue'

const UNMODIFIABLE_APARTMENTS = ref([])
const apartments = ref([])
const barangays = ref([])
const selectedData = ref()
const loading = ref(true)

// category filtering
function barangayFilter(e) {
  apartments.value = UNMODIFIABLE_APARTMENTS.value.filter((b) => b.location.includes(e.target.id))
}

const isShowDisplay = ref(false)
function showDisplayModal(data) {
  isShowDisplay.value = !isShowDisplay.value
  selectedData.value = data
}

const axiosCall = () => {
  fetchData('/apartments')
    .then((data) => {
      apartments.value = data.apartments
      UNMODIFIABLE_APARTMENTS.value = data.apartments
      barangays.value = data.apartments.map((d) => d.location)
      loading.value = false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  axiosCall()
})
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>Apartments | Pililla Rizal</title>
  </head>
  <HeaderSection />
  <!-- hero section -->
  <HeroApartment />

  <DisplayModal
    :class="{ 'translate-y-[110%]': !isShowDisplay, 'translate-y-0': isShowDisplay }"
    :close-modal="showDisplayModal"
    :selected-data="selectedData"
  />
  <WrapperContainer>
    <!-- filter by -->
    <Filter :barangay-filter="barangayFilter" :barangays="barangays" />
    <h4 v-if="!apartments.length && !loading" class="text-3xl text-center font-bold mt-3">
      No apartments yet!
    </h4>
    <Loading v-if="loading" class="w-10 h-10 mx-auto" />
    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-2">
      <BusinessesCard
        v-for="data in apartments"
        :key="data.id"
        :data="data"
        :show-display-modal="showDisplayModal"
      />
    </div>
  </WrapperContainer>
  <FooterSectionVue />
</template>
