<script setup>
import { onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import { axiosInstance } from '../../utils/axios-instance'
import { ref } from 'vue'
import moment from 'moment'
import { be_url } from '../../assets/config/config'

const time = ref()

const axiosRequestTime = () => {
  axiosInstance()
    .get(be_url + '/server-time', { withCredentials: true })
    .then(({ data }) => {
      time.value = data?.time?.date
    })
    .catch((err) => console.log(err))
}

onMounted(() => {
  axiosRequestTime()
})
</script>

<template>
  <div class="w-full sm:mt-5 h-[300px] sm:h-[400px] relative overflow-x-hidden">
    <!-- img -->
    <img
      src="/images/hero.png"
      alt="this is a hero picture"
      class="absolute mx-auto -z-10 left-0 right-0 w-screen h-full"
    />
    <!-- img-1 -->
    <img
      src="/images/hero-2.png"
      alt="this is a hero picture 2. mayor and a child hugging  together"
      class="absolute bottom-0 -right-1/4 sm:right-0 xl:right-72 w-[280px] sm:w-[350px] -z-10 opacity-75"
    />

    <WrapperContainer class="flex flex-col gap-3 items-center">
      <h1 class="text-5xl sm:text-8xl text-primary font-bold capitalize font-['display']">
        better pililla
      </h1>
      <h2
        class="font-bold text-xl sm:text-3xl flex flex-col items-center capitalize dark:text-bggray"
      >
        <span>A <span class="text-dark dark:text-white">better</span> Community</span>
        <span>A <span class="text-dark dark:text-white">better</span> home</span>
      </h2>
      <h3 class="textsm sm:text-base text-dark dark:text-bggray">
        Get to know the places in pililla
      </h3>
      <RouterLink
        to="/tourist-attractions"
        class="text-sm sm:text-base capitalize bg-primary rounded-md text-white px-3 py-1 cursor-pointer hover:bg-primarylight font-bold"
      >
        <i class="uil uil-map-marker-question mr-2" />
        Tourists Spots
      </RouterLink>

      <!-- datetime -->
      <p
        class="text-base sm:text-lg font-bold text-dark dark:text-bggray absolute bottom-2 left-10"
      >
        {{ moment(time).format('dddd, MMMM Do YYYY, h:mm:ss a') }}
      </p>
    </WrapperContainer>
  </div>
</template>
