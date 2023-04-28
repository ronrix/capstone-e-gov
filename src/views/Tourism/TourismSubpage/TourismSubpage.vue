<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { onMounted, ref, computed } from 'vue'
import { formatImgs } from '../../../utils/imgFormat'
import { useRoute } from 'vue-router'
import { useTourism } from '../../../stores/tourisms-store'

const store = useTourism()
const route = useRoute()
const tourismTitle = computed(() => route.params.title.replace(/-/g, ' '))
const tourism = ref()
const description = ref('')
const imgURL = ref()
const suggestionTourism = ref()

const loadTourisms = () => {
  if (store.getTourism()) {
    tourism.value = store.getOneTourism(tourismTitle.value)
    console.log(tourism.value)
    suggestionTourism.value = store.getTourism().slice(0, 3)
  } else {
    store.setTourism(JSON.parse(localStorage.getItem('tourisms')))
    const tourismData = JSON.parse(localStorage.getItem('tourisms'))
    tourism.value = tourismData.find((n) => n.title.toLowerCase() == tourismTitle.value)
    suggestionTourism.value = tourismData.slice(0, 3)
  }
  description.value = DOMPurify.sanitize(marked(tourism.value.description))
  imgURL.value = formatImgs(tourism.value.img_link.split(','))[0]
}

onMounted(() => {
  loadTourisms()
})
</script>
<template>
  <HeaderSection />
  <div class="flex justify-between p-28 pt-5">
    <div>
      <h1 class="text-2xl font-semibold pb-5 text-dark dark:text-bggray">Tourist Attraction</h1>
      <p class="text-dark dark:text-bggray">CHURCH</p>
      <P class="text-3xl font-semibold md:w-1/2 text-dark dark:text-bggray capitalize">{{
        tourism?.title
      }}</P>
      <img :src="imgURL" alt="" />
      <p class="text-sm mt-4 text-dark dark:text-bggray markdown" :innerHTML="description"></p>
    </div>
  </div>
  <FooterSection />
</template>

<style>
.markdown p {
  margin-top: 0.5em;
}
</style>