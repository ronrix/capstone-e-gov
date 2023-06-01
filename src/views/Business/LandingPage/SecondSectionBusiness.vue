<script setup>
import Apartment from './Apartment.vue'
import { ref, onMounted } from 'vue'
import { useApartmentStore } from '../../../stores/apartments-store'
import { fetchData } from '../../../utils/axios-instance'
import Loading from '../../../components/Loading.vue'

const store = useApartmentStore()
const apartments = ref([])
const loading = ref(true)

const axiosCall = () => {
  fetchData('/apartments')
    .then((data) => {
      apartments.value = data.apartments.slice(0, 3)
      store.setApartments(data.apartments)
      localStorage.setItem('apt', JSON.stringify(apartments.value))
      loading.value = false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  if (store.getApartments()) {
    apartments.value = store.getApartments().slice(0, 3)
    loading.value = false
  } else {
    axiosCall()
  }
})
</script>

<template>
  <div class="flex items-center gap-5 mt-24 mb-5">
    <div class="flex-1 border border-gray-600 dark:border-white"></div>
    <h1 class="text-2xl lg:text-3xl text-primary sm:text-dark dark:text-white font-bold">
      Looking for apartment?
    </h1>
  </div>
  <Loading v-if="loading" class="w-10 h-10 mx-auto" />
  <h4 v-if="!apartments.length && !loading" class="text-3xl text-center font-bold mt-3">
    No apartments yet!
  </h4>
  <div v-else>
    <Apartment
      v-for="(apartment, idx) in apartments"
      :key="idx"
      :apartment="apartment"
      :idx="idx"
    />

    <div class="flex flex-col items-center mt-12">
      <h2 class="text-primary dark:text-white text-base md:text-xl font-bold">
        Find more Apartments
      </h2>
      <RouterLink
        to="/business/apartments"
        class="bg-primary rounded-md px-2 py-1 text-white text-sm mt-2 hover:bg-primarylight"
      >
        Find here
        <i class="uil uil-angle-right"></i>
      </RouterLink>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>