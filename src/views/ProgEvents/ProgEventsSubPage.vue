<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { ref, onMounted, computed } from 'vue'
import { useRoute } from 'vue-router'
import moment from 'moment'
import { formatImgs } from '../../utils/imgFormat'
import { useProgEventsStore } from '../../stores/prog-events-store'

const store = useProgEventsStore()
const useCustomStyles = ref(true) // Set to true if you want to apply custom styles, false otherwise

// paremeter :title
const route = useRoute()
const pogEventsTitle = computed(() => route.params.title.replace(/_/g, ' '))
const progEvents = ref()
const description = ref('')
const imgURL = ref()

const loadNews = () => {
  if (store.getProgEvents()) {
    progEvents.value = store.getOneProgEvents(pogEventsTitle.value)
  } else {
    store.setProgEvents(JSON.parse(localStorage.getItem('proge')))
    const newsData = JSON.parse(localStorage.getItem('proge'))
    progEvents.value = newsData.find((n) => n.title.toLowerCase() == pogEventsTitle.value)
  }

  description.value = DOMPurify.sanitize(marked(progEvents.value.description))
  imgURL.value = formatImgs(progEvents.value.img_link.split(','))[0]
}

onMounted(() => {
  loadNews()
})
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>News | Pililla Rizal</title>
  </head>
  <HeaderSection />

  <WrapperContainer>
    <div class="mt-10 flex flex-col md:flex-row gap-5">
      <!-- 404 not found -->
      <div v-if="is404" class="flex-1 text-center">
        <h4 class="font-bold text-5xl capitalize">404 not found</h4>
        <h5 class="text-2xl mb-3">News can't be found</h5>
        <RouterLink to="/news" class="text-bggray bg-primarylight px-3 py-1 rounded-md"
          >Go back</RouterLink
        >
      </div>
      <!-- news -->
      <div v-else class="flex flex-col gap-3 items-start flex-[3]">
        <p class="flex items-center text-xs text-secondary">
          <i class="uil uil-clock-five mr-2"></i>
          <span>{{ moment(progEvents?.created_at).fromNow() }}</span>
        </p>
        <h3 class="font-bold text-2xl text-dark dark:text-bggray sm:w-1/2 capitalize">
          {{ progEvents?.title }}
        </h3>

        <img class="w-full" :src="imgURL" alt="" />

        <div
          class=":text-dark dark:text-bgLightyBlue text-justify leading-loose"
          :class="{ markdown: useCustomStyles }"
          :innerHTML="description"
        ></div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style>
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>