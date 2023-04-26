<script setup>
import { RouterLink } from 'vue-router'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import Assistance from './Assistance.vue'
import Place from './Place/Place.vue'
import Hotlines from '../../components/Hotlines.vue'
import Hero from './Hero.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import { onMounted, ref } from 'vue'
import { be_url } from '../../assets/config/config'
import { axiosInstance } from '../../utils/axios-instance'
import { useTourism } from '../../stores/tourisms-store'

const store = useTourism()
const places = ref()

const axiosTourisms = () => {
  axiosInstance()
    .get(be_url + '/tourist-attractions', { withCredentials: true })
    .then(({ data }) => {
      places.value = data.tourism.slice(0, 3)
      store.setTourism(data.tourism)
      localStorage.setItem('tourisms', JSON.stringify(data.tourism))
    })
    .catch((err) => console.log(err))
}

onMounted(() => {
  axiosTourisms()
})
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>Home | Pililla Rizal</title>
  </head>

  <!-- <WrapperContainer> -->
  <HeaderSection />
  <!-- </WrapperContainer> -->
  <Hero />
  <WrapperContainer>
    <!-- assistance section -->
    <section class="bg-bggray dark:bg-darkgray p-5 duration-200">
      <Assistance />
    </section>

    <!-- programs and events -->
    <Programs />

    <!-- top places -->
    <section class="mt-20 flex flex-col gap-5">
      <h4 class="font-['display'] text-5xl sm:w-3/4 text-center mx-auto dark:text-bggray">
        Highlights of <span class="bg-primary px-3 text-white">3</span> places you want to come and
        visit in Pililla
      </h4>

      <div class="relative mt-5 bg-gradient-to-l from-dark to-darkgray rounded-md text-white py-5">
        <!-- map icon -->
        <div
          class="absolute -top-8 left-1/2 -translate-x-1/2 rounded-full w-14 h-14 flex items-center justify-center bg-white dark:bg-dark"
        >
          <i class="uil uil-map-pin text-5xl text-gray-900 dark:text-bggray" />
        </div>

        <!-- first line -->
        <div class="h-20 w-2 bg-white dark:bg-dark mx-auto"></div>

        <!-- places -->
        <div v-for="(place, idx) in places" :key="idx">
          <!-- connected lines -->
          <div v-if="idx !== 0" class="h-20 w-2 bg-white dark:bg-dark mx-auto relative my-5">
            <!-- circles -->
            <div class="w-5 h-5 rounded-full bg-inherit absolute -top-2"></div>
            <div class="w-5 h-5 rounded-full bg-inherit absolute -bottom-2"></div>
          </div>

          <Place :place="place" :idx="idx" />
        </div>

        <div class="flex items-center justify-center flex-col mt-10 gap-2 p-5">
          <h5 class="capitalize font-['display'] text-4xl">Find out more</h5>
          <p class="text-xs sm:text-base text-center">
            Find more interesting places and destination to go to in Pililla.
          </p>
          <RouterLink
            to="/tourism"
            class="text-sm px-3 py-1 text-white bg-primary rounded-md capitalize"
          >
            Go places
            <i class="uil uil-angle-right" />
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- map location -->
    <section>
      <h4 class="font-['display'] text-5xl mt-10 font-bold text-dark dark:text-bggray">
        Here's the map of Pililla
      </h4>
      <p class="text-lg sm:textsm font-bold text-dark dark:text-bggray">Welcome to pililla!</p>
      <p class="text-sm sm:textsm text-dark dark:text-bggray">
        You can navigate the whole pililla using this
        <a
          href="https://www.google.com/maps/place/Pililla,+Rizal/@14.4469448,121.2951419,13z/data=!3m1!4b1!4m6!3m5!1s0x3397e93c8543c67f:0xc3ddaed3ef5026a0!8m2!3d14.4439278!4d121.3427262!16zL20vMDZrdGd5"
          class="text-primarylight ml-2"
        >
          <i class="uil uil-link" />
          google map
        </a>
      </p>

      <div class="mt-5">
        <iframe
          frameborder="0"
          class="w-full md:w-[800px] md:h-[400px]"
          src="https://www.bing.com/maps/embed?h=500&w=800&cp=14.5990572649647~121.08147888433678&lvl=11&typ=d&sty=h&src=SHELL&FORM=MBEDV8"
          scrolling="no"
        />
      </div>
    </section>
  </WrapperContainer>
  <!-- hotlines -->
  <section class="mt-10">
    <Hotlines />
  </section>

  <FooterSection />
</template>