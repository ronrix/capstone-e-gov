<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { onMounted, ref, computed } from 'vue'
import { formatImgs } from '../../../utils/imgFormat'
import { useRoute } from 'vue-router'
import { useTourism } from '../../../stores/tourisms-store'
import TourismSuggestionCard from '../TourismSuggestions/TourismSuggestionCard.vue'

const store = useTourism()
const route = useRoute()
const tourismTitle = computed(() => route.params.title.replace(/_/g, ' ').toLowerCase())
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
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // call the data
  loadTourisms()
})
</script>
<template>
  <HeaderSection />
  <WrapperContainer class="flex flex-col md:flex-row gap-5 mt-10">
    <!-- 404 not found -->
    <div v-if="is404" class="flex-1 text-center">
      <h4 class="font-bold text-5xl capitalize">404 not found</h4>
      <h5 class="text-2xl mb-3">News can't be found</h5>
      <RouterLink to="/news" class="text-bggray bg-primarylight px-3 py-1 rounded-md"
        >Go back</RouterLink
      >
    </div>
    <div class="flex-[3]">
      <h1 class="text-2xl font-semibold pb-5 text-dark dark:text-bggray">Tourist Attraction</h1>
      <p class="text-dark dark:text-bggray">{{ tourism?.category }}</p>
      <P class="text-3xl font-semibold md:w-1/2 text-dark dark:text-bggray capitalize">{{
        tourism?.title
      }}</P>
      <h5 class="text-dark dark:text-bggray mb-3">
        Posted by <span class="font-[600]">{{ tourism?.authors }}</span>
      </h5>
      <img :src="imgURL" :alt="'this is an image of' + tourism?.title" class="w-full" />
      <div
        class=":text-dark dark:text-bgLightyBlue text-justify leading-loose markdown"
        :innerHTML="description"
      ></div>
    </div>
    <!-- suggestions -->
    <div class="flex-1">
      <h4 class="font-bold text-sm text-dark dark:text-bggray mb-5">Suggestions</h4>
      <TourismSuggestionCard v-for="a in suggestionTourism" :key="a.id" :tourist="a" />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style>
.markdown p {
  margin-top: 0.5em;
  font-size: 1em;
}
.markdown h2 {
  font-size: 1.7em;
  margin-top: 0.5em;
  font-weight: bold;
}
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>