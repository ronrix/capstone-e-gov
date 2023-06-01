<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import Loading from '../../components/Loading.vue'
import { useProgEventsStore } from '../../stores/prog-events-store'
import { fetchData } from '../../utils/axios-instance'
import HeroEvents from './HeroEvents.vue'
import ProgEventsCard from './ProgEventsCard.vue'
import { ref, onMounted, onUnmounted } from 'vue'

const store = useProgEventsStore()
const loading = ref(true)
const progEvents = ref([])
const isError = ref()

const axiosCall = () => {
  fetchData('/programs-and-events')
    .then((data) => {
      progEvents.value = data.programsEvents
      loading.value = false // set the loading to false
      store.setProgEvents(data.programsEvents)
      localStorage.setItem('proge', JSON.stringify(progEvents.value))
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
  document.title = 'Program and Events | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection />

  <div>
    <HeroEvents />
    <WrapperContainer class="mt-5 sm:px-3">
      <h4 class="text-sm font-bold mb-3 text-dark dark:text-bggray">All programs and events</h4>
      <div v-if="isError && !loading">
        <h4 class="font-bold text-3xl text-center text-dark dark:text-bggray">
          {{ isError.msg }}
        </h4>
        <p class="text-lg text-center text-dark dark:text-bggray">Error has occured.</p>
      </div>
      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
        <h4 v-if="!loading && !progEvents.length" class="text-3xl text-center">No data found</h4>
        <ProgEventsCard v-for="event in progEvents" v-else :key="event.id" :event="event" />
      </div>
    </WrapperContainer>
  </div>

  <FooterSection />
</template>