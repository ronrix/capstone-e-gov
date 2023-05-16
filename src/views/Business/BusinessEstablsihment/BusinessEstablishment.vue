<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import SearchAndFilter from './SearchAndFilter.vue'
import BusinessesCard from '../BusinessesCard.vue'
import HeroBusinessEstablishment from './HeroBusinessEstablishment.vue'
import { ref, onMounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import DisplayModal from '../DisplayModal.vue'
import Loading from '../../../components/Loading.vue'

const UNMODIFIABLE_BUSINESSES = ref([])
const businesses = ref([])
const categories = ref([])
const selectedData = ref()
const loading = ref(true)

// search filtering
function searchFilter(e) {
  businesses.value = UNMODIFIABLE_BUSINESSES.value.filter((b) => b.title.includes(e.target.value))
}

// category filtering
function categoryFilter(e) {
  businesses.value = UNMODIFIABLE_BUSINESSES.value.filter((b) =>
    b.category.includes(e.target.value)
  )
}

const isShowDisplay = ref(false)
function showDisplayModal(data) {
  isShowDisplay.value = !isShowDisplay.value
  selectedData.value = data
}

const axiosCall = () => {
  fetchData('/businesses')
    .then((data) => {
      businesses.value = data.businesses
      UNMODIFIABLE_BUSINESSES.value = data.businesses
      categories.value = data.businesses.map((d) => d.category)
      loading.value = false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()
})
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>Business Establishment | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <DisplayModal
    :class="{ 'translate-y-[110%]': !isShowDisplay, 'translate-y-0': isShowDisplay }"
    :close-modal="showDisplayModal"
    :selected-data="selectedData"
  />
  <WrapperContainer>
    <!-- search and filter by -->
    <HeroBusinessEstablishment />
    <SearchAndFilter
      :categories="categories"
      :search-filter="searchFilter"
      :category-filter="categoryFilter"
    />
    <!-- businesses card -->
    <h5 v-if="!businesses.length && !loading" class="font-bold text-2xl text-center mt-7">
      No businesses found!
    </h5>
    <Loading v-if="loading" class="w-10 h-10 mx-auto mt-7" />
    <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 mt-7">
      <BusinessesCard
        v-for="(data, index) in businesses"
        :key="index"
        :data="data"
        :show-display-modal="showDisplayModal"
      />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>
