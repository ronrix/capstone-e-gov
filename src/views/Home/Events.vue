<script setup>
import { onMounted, ref } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import DOMPurify from 'dompurify'
import { marked } from 'marked'
import { formatImgs } from '../../utils/imgFormat'
import Loading from '../../components/Loading.vue'

const loading = ref(true)
const events = ref([])

const axiosCall = () => {
  fetchData('/programs-and-events')
    .then((data) => {
      events.value = data.programsEvents
      loading.value = false // set the loading to false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
      // display soomething is error
    })
}

onMounted(() => {
  axiosCall()
})
</script>
<template>
  <!-- programs and events -->
  <section class="my-16 flex flex-col px-3">
    <h4 class="font-bold text-dark dark:text-bggray text-sm">Events</h4>
    <div class="grid items-center grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
      <Loading v-if="loading" class="w-10 h-10 mx-auto self-center" />

      <!-- display only the latest 3 events -->
      <RouterLink
        v-for="event in events.slice(0, 3)"
        v-else
        :key="event.id"
        :to="
          '/government/programs-events/' +
          event.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
        "
        class="flex gap-3 p-2 w-full h-[150px] border dark:border-secondary hover:bg-primarylight duration-100 hover:text-bggray rounded-md text-dark dark:text-bggray overflow-hidden"
      >
        <img
          :src="formatImgs(event.img_link.split(','))[0]"
          alt="featuring the fiesta in pililla rizal"
          class="w-1/2 object-cover h-full"
        />
        <div class="flex-1">
          <h6 class="text-2xl font-bold">
            {{ event.title }}
          </h6>
          <div
            class=":text-dark dark:text-bgLightyBlue line-clamp-3"
            :class="{ markdown: useCustomStyles }"
            :innerHTML="DOMPurify.sanitize(marked.parse(event.description))"
          ></div>
        </div>
      </RouterLink>
    </div>
    <RouterLink
      to="/government/programs-events"
      class="text-sm font-bold text-center text-primary dark:text-bggray mt-5block border border-primary dark:border-bggray rounded-lg px-3 self-center w-fit hover:text-bggray hover:bg-primarylight duration-75 items-center gap-2 mt-5"
    >
      more
      <i class="fa-solid fa-arrow-right text-sm"></i>
    </RouterLink>
  </section>
</template>

<style>
.markdown h3,
h4,
h5 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>
