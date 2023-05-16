<script setup>
import { onMounted, ref, computed } from 'vue'
import { useBusinessStore } from '../../../stores/business-store'

const store = useBusinessStore()

// Define the counts as refs
const restaurantCount = ref(0)
const departmentStoreCount = ref(0)
const gasStationCount = ref(0)
const pharmacyCount = ref(0)
const bankCount = ref(0)

onMounted(() => {
  if (store.getBusiness()) {
    setTimeout(() => {
      store.getBusiness().forEach((a) => {
        if (a.category.includes('restaurant')) {
          restaurantCount.value++
        }
        if (a.category.includes('department store')) {
          departmentStoreCount.value++
        }
        if (a.category.includes('gas')) {
          gasStationCount.value++
        }
        if (a.category.includes('pharmacy')) {
          pharmacyCount.value++
        }
        if (a.category.includes('bank')) {
          bankCount.value++
        }
      })
    }, 0)
  }
})

// Define computed properties to automatically update the counts
const restaurant = computed(() => restaurantCount.value)
const departmentStore = computed(() => departmentStoreCount.value)
const gasStation = computed(() => gasStationCount.value)
const pharmacy = computed(() => pharmacyCount.value)
const bank = computed(() => bankCount.value)
</script>

<template>
  <div class="w-full flex flex-col gap-3 items-center pb-10 bg-bggray dark:bg-darkgray">
    <h1
      class="text-center font-['display'] text-4xl md:text-6xl text-darkgray mt-5 dark:text-bggray"
    >
      Do you want to feature <span class="block">your business?</span>
    </h1>
    <p class="text-sm text-dark dark:text-white">Let us help you to promote your business</p>
    <RouterLink
      to="/apply-your-business"
      class="text-sm md:text-base px-3 py-2 mt-5 bg-primary font-bold hover:bg-primarylight text-white rounded-md shadow-lg shadow-primarylight/50"
      >Apply your business <i class="uil uil-angle-right"></i
    ></RouterLink>
  </div>
  <!-- businesses with icons -->
  <div
    class="flex flex-col md:flex-row items-center mt-5 md:mt-16 justify-center md:justify-between w-full py-5 relative"
  >
    <h1
      class="text-center md:text-left text-3xl md:text-4xl lg:sm:text-5xl ml-0 lg:ml-16 mb-12 md:mb-0 md:text-dark dark:text-white font-[display]"
    >
      Businesses in
      <span class="inline-block md:block"> <span class="text-primary">Partnership</span> with</span>
      <span class="block sm:inline-block md:block">the Municipality of Pililla, Rizal</span>
    </h1>
    <div class="grid grid-cols-3 gap-0 lg:gap-3 mr-0 lg:mr-16">
      <!-- single item -->
      <div class="flex flex-col items-center mb-5">
        <i
          class="uil uil-restaurant text-4xl sm:sm:text-5xl lg:text-6xl text-dark dark:text-white"
        ></i>
        <h2
          class="text-center text-normal md:text-lg font-bold text-dark dark:text-white hover:hover:text-gray-950 dark:hover:text-gray-200"
        >
          Restaurant
        </h2>
        <span class="text-lg text-dark dark:text-white font-normal">{{ restaurant }}</span>
      </div>
      <!-- single item -->
      <div class="flex flex-col items-center">
        <i
          class="uil uil-shopping-cart-alt text-4xl sm:sm:text-5xl lg:text-6xl text-dark dark:text-white"
        ></i>
        <h2
          class="text-center text-normal md:text-lg font-bold text-dark dark:text-white hover:text-gray-950 dark:hover:text-gray-200"
        >
          Department Stores
        </h2>
        <span class="text-lg text-dark dark:text-white font-normal">{{ departmentStore }}</span>
      </div>
      <!-- single item -->
      <div class="flex flex-col items-center">
        <i class="uil uil-pump text-4xl sm:text-5xl lg:text-6xl text-dark dark:text-white"></i>
        <h2
          class="text-center text-normal md:text-lg font-bold text-dark dark:text-white hover:hover:text-gray-950 dark:hover:text-gray-200"
        >
          Gas Station
        </h2>
        <span class="text-lg text-dark dark:text-white font-normal">{{ gasStation }}</span>
      </div>
      <!-- single item -->
      <div class="flex flex-col items-center">
        <i
          class="uil uil-medical-square text-4xl sm:text-5xl lg:text-6xl text-dark dark:text-white"
        ></i>
        <h2
          class="text-center text-normal md:text-lg font-bold text-dark dark:text-white hover:text-gray-950 dark:hover:text-gray-200"
        >
          Pharmacy
        </h2>
        <span class="text-lg text-dark dark:text-white font-normal">{{ pharmacy }}</span>
      </div>
      <!-- single item -->
      <a href="" class="flex flex-col items-center">
        <i
          class="uil uil-university text-4xl sm:text-5xl lg:text-6xl text-dark dark:text-white"
        ></i>
        <h2
          class="tex-center text-normal md:text-lg font-bold text-dark dark:text-white hover:hover:text-gray-950 dark:hover:text-gray-200"
        >
          Bank
        </h2>
        <span class="text-lg text-dark dark:text-white font-normal">{{ bank }}</span>
      </a>
    </div>
    <div
      class="absolute w-0 md:w-[340px] h-[340px] bg-primary opacity-10 -z-10- -left-52 lg:-left-32 rounded-full"
    ></div>
  </div>
</template>

<style lang="scss" scoped>
</style>