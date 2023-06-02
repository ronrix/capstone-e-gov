<script setup>
import { useApartmentStore } from '../../../stores/apartments-store'
import { onMounted, ref } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import { useBusinessStore } from '../../../stores/business-store'

const store = useApartmentStore()
const businessStore = useBusinessStore()
const apartments = ref()
const business = ref()

// fetch for data
const fetchApartments = () => {
  fetchData('/apartments')
    .then((data) => {
      apartments.value = data.apartments
      store.setApartments(data.apartments)
      localStorage.setItem('apt', JSON.stringify(apartments.value))
    })
    .catch((err) => {
      console.log(err)
    })
}

const fetchBusiness = () => {
  fetchData('/businesses')
    .then((data) => {
      business.value = data.businesses
      businessStore.setBusiness(data.businesses)
    })
    .catch((err) => {
      console.log(err)
    })
}

onMounted(() => {
  if (store.getApartments()) {
    apartments.value = store.getApartments()
  } else {
    fetchApartments()
  }
  fetchBusiness()
})
</script>

<template>
  <div class="flex flex-col">
    <div class="flex-1 flex flex-col gap-10 mt-10 mb-20 p-5">
      <h1 class="text-3xl md:text-4xl lg:text-5xl text-dark dark:text-white font-bold">
        Businesses<span class="block mt-1">in Pililla, Rizal</span>
      </h1>
      <div class="border border-gray-600 dark:border-white"></div>
      <p class="text-base md:text-lg font-normal text-dark dark:text-white">
        Pililla Rizal offers a plethora of ecotourism destinations, such as the Pililla Wind Farm
        and Hulugan Falls, making it an ideal location for businesses in the hospitality and tourism
        industry.
      </p>
    </div>
    <div
      class="flex items-center bg-primary w-full h-[80px] md:h-[95px] lg:h-[100px] justify-evenly"
    >
      <a href="/business/apartments" class="flex flex-col items-center gap-1">
        <div class="text-xl md:text-2xl text-white dark:tex-dark font-light">
          {{ apartments?.length }}
        </div>
        <p class="text-base md:text-lg text-white dark:tex-dark hover:text-gray-200">Apartment</p>
      </a>
      <div class="border border-white h-[100px]"></div>
      <a href="/business/business-establishment" class="flex flex-col items-center gap-1">
        <div class="text-xl md:text-2xl text-white dark:tex-dark font-light">
          {{ business?.length }}
        </div>
        <p class="text-base md:text-lg text-white dark:tex-dark hover:text-gray-200">Businesses</p>
      </a>
    </div>
  </div>
</template>

<style scoped>
</style>