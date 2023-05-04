<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import BusinessPermits from './BusinessPermits.vue'
import { fetchData } from '../../../utils/axios-instance'
import { onMounted } from 'vue'
import { ref } from 'vue'
import Loading from '../../../components/Loading.vue'

const permits = ref([])
const originalPermits = ref([])
const loading = ref(true)
const axiosCall = () => {
  fetchData('/permits')
    .then((data) => {
      permits.value = data.permits
      originalPermits.value = data.permits
      localStorage.setItem('bplo', JSON.stringify(data.permits))
      loading.value = false
    })
    .catch((err) => {
      loading.value = false
      console.log(err)
    })
}

function handleSearchPermits(e) {
  permits.value = originalPermits.value.filter((o) =>
    o.title.toLowerCase().includes(e.target.value.toLowerCase())
  )
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()
})
</script>

<template>
  <HeaderSection class="relative" />
  <WrapperContainer>
    <div class="w-full flex flex-col gap-4 items-center mt-24">
      <div class="relative mt-10">
        <h1 class="text-dark dark:text-white font-bold text-4xl md:text-5xl">
          <span class="text-primary dark:text-primarylight">Businesses permit</span> here.
        </h1>
        <div class="bg-primary dark:bg-primarylight absolute w-[45%] -bottom-1 h-1"></div>
      </div>
      <p class="text-base text-secondary dark:text-gray-100">
        See every businesses in every department.
      </p>
    </div>

    <!-- search  -->
    <div class="w-full flex flex-col items-center mt-10">
      <div
        class="w-full md:w-[450px] flex flex-row gap-3 items-center bg-white dark:bg-dark border border-gray-400 rounded-lg p-1 md:p-2"
      >
        <i class="uil uil-search text-lg text-dark dark:text-white"></i>
        <input
          class="w-full border-none outline-none bg-white dark:bg-dark text-sm text-dark dark:text-white placeholder:dark:text-white"
          type="search"
          placeholder="search business permit"
          @change.capture="handleSearchPermits"
        />
      </div>
    </div>
    <!-- business permits -->
    <h2 class="w-full mt-10 text-sm font-bold text-dark dark:text-white">All businesses permits</h2>
    <!-- permits -->
    <div class="w-full mt-5">
      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <BusinessPermits v-for="(data, id) in permits" :key="id" :data="data" />
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>