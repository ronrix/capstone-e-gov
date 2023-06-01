<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { ref, onMounted, onUnmounted } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import Loading from '../../components/Loading.vue'
import { useFestivalStore } from '../../stores/festival-store'
import { formatImgs } from '../../utils/imgFormat'
import { Carousel, Slide, Navigation } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

const store = useFestivalStore()
const festivals = ref()
const loading = ref(true)
const isError = ref()

const axiosCall = () => {
  fetchData('/festivals')
    .then((data) => {
      store.setFestivals(data.festivals)
      festivals.value = data.festivals.slice(0, 3)
      localStorage.setItem('fest', JSON.stringify(festivals.value))
      loading.value = false // set the loading to false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
      // display soomething is error
      isError.value = err.response?.data?.res?.err?.msg
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Festivals | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
const texthover = ref(false)
function hoverover() {
  texthover.value = true
}
function hoverout() {
  texthover.value = false
}
</script>
<template>
  <head>
    <title>Festival | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>

  <div class="sm:flex justify-end items-center h-[600px]">
    <div
      class="group items-center hover:rounded-none hover:w-full duration-500 contrast-150 h-full rounded-none sm:rounded-bl-full sm:w-3/5 object-cover bg-no-repeat bg-cover"
      style="background-image: url('/images/magsolangtan-festival.jpg')"
      @mouseover="hoverover"
      @mouseout="hoverout"
    ></div>
  </div>
  <p
    :class="{
      '!text-white': texthover,
      'text-white  sm:!text-dark dark:!text-bggray': !texthover
    }"
    class="drop-shadow-md sm:pl-10 text-7xl md:text-7xl lg:text-8xl font-bold absolute top-52 sm:top-60 -bottom-48"
  >
    Pililla Rizal
    <span
      class="block font-['display'] italic"
      :class="{
        '!text-white': texthover,
        'text-white  sm:!text-primarylight dark:!text-bggray': !texthover
      }"
      >Festival</span
    >
  </p>
  <WrapperContainer class="mt-20 md:px-3">
    <h5 class="font-bold text-4xl text-dark dark:text-bggray px-3">
      Festivals that we celebrate in Pililla
    </h5>
    <div class="w-full h-[2px] bg-dark dark:bg-secondary mt-5"></div>
    <Loading v-if="loading" class="w-10 h-10 mx-auto" />
    <div
      v-for="fest in festivals"
      v-else
      :key="fest.id"
      class="flex flex-col md:flex-row justify-evenly gap-5 mt-10 sm:px-3"
    >
      <div class="flex-1 flex flex-col justify-evenly order-2 sm:order-1">
        <h2 class="text-3xl font-semibold text-dark dark:text-bggray mb-3">
          {{ fest.title }}
        </h2>
        <div
          class=":text-dark dark:text-bgLightyBlue leading-loose mardown line-clamp-5"
          :innerHTML="DOMPurify.sanitize(marked.parse(fest.description))"
        ></div>

        <div class="group flex w-fit">
          <RouterLink
            :to="
              '/tourism/festivals/' +
              fest.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
            "
            class="cursor-pointer group-hover:underline mb-8 sm:mb-0 text-primarylight pr-2"
            >Read more
          </RouterLink>
          <i
            class="group-hover:-translate-x-1 duration-75 uil uil-arrow-right text-primarylight"
          ></i>
        </div>
      </div>
      <Carousel class="overflow-hidden flex-1 order-1 sm:order-2">
        <Slide
          v-for="slide in formatImgs(fest.img_link.split(','))"
          :key="slide"
          class="flex items-center overflow-hidden min-h-[400px] max-h-[400px] w-full justify-center carousel_item"
        >
          <img
            :src="slide"
            :alt="'this is an image of ' + fest.title + ' fiesta'"
            class="w-full h-full object-cover"
          />
        </Slide>
        <template #addons>
          <Navigation />
        </template>
      </Carousel>
    </div>
  </WrapperContainer>
  <FooterSection></FooterSection>
</template>

<style>
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>