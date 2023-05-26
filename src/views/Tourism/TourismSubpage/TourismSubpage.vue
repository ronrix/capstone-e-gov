<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { onMounted, ref, computed, onUnmounted } from 'vue'
import { formatImgs } from '../../../utils/imgFormat'
import { useRoute } from 'vue-router'
import { useTourism } from '../../../stores/tourisms-store'
import TourismSuggestionCard from '../TourismSuggestions/TourismSuggestionCard.vue'
import { useFestivalStore } from '../../../stores/festival-store'
import { fetchData } from '../../../utils/axios-instance'

const storeTourism = useTourism()
const storeFestival = useFestivalStore()
const route = useRoute()
const dataTitle = computed(() => route.params.title.replace(/_/g, ' ').toLowerCase())
const data = ref()
const description = ref('')
const imgURL = ref()
const suggestionData = ref()
const typeOfData = ref(route.path.split('/')[2])

const store = useTourism()

const axiosTourisms = () => {
  if (typeOfData.value === 'festivals') {
    fetchData('/festivals')
      .then((data) => {
        storeFestival.setFestivals(data.festivals)
        localStorage.setItem('fest', JSON.stringify(data.festivals))
      })
      .catch((err) => console.log(err))
  } else {
    fetchData('/tourist-attractions')
      .then((data) => {
        store.setTourism(data.tourism)
        localStorage.setItem('tourisms', JSON.stringify(data.tourism))
      })
      .catch((err) => console.log(err))
  }
}

const loadTourisms = () => {
  // find which data should be rendered
  if (typeOfData.value === 'festivals') {
    if (storeFestival.getFestivals()) {
      data.value = storeFestival.getOneFestival(dataTitle.value)
      suggestionData.value = storeFestival
        .getFestivals()
        .filter((a) => a.id !== data.value.id)
        .slice(0, 3)
    } else {
      storeFestival.setFestivals(JSON.parse(localStorage.getItem('fest')))
      const festivalData = JSON.parse(localStorage.getItem('fest'))
      data.value = festivalData.find((n) => n.title.toLowerCase() == dataTitle.value)
      suggestionData.value = festivalData.filter((a) => a.id !== data.value.id).slice(0, 3)
    }
  } else {
    if (storeTourism.getTourism()) {
      data.value = storeTourism.getOneTourism(dataTitle.value)
      suggestionData.value = storeTourism
        .getTourism()
        .filter((a) => a.id !== data.value.id)
        .slice(0, 3)
    } else {
      storeTourism.setTourism(JSON.parse(localStorage.getItem('tourisms')))
      const tourismData = JSON.parse(localStorage.getItem('tourisms'))
      data.value = tourismData.find((n) => n.title.toLowerCase() == dataTitle.value.toLowerCase())
      suggestionData.value = tourismData.filter((a) => a.id !== data.value.id).slice(0, 3)
    }
  }
  description.value = DOMPurify.sanitize(marked(data.value?.description))
  imgURL.value = formatImgs(data.value.img_link.split(','))[0]
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosTourisms()

  // add tab title
  document.title = 'Tourism | Pililla Rizal'

  // call the data
  loadTourisms()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
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
      <p class="text-dark dark:text-bggray">{{ data?.category }}</p>
      <h1 class="text-3xl font-semibold md:w-1/2 text-dark dark:text-bggray capitalize">
        {{ data?.title }}
      </h1>
      <h5 class="text-dark dark:text-bggray mb-3">
        Posted by <span class="font-[600]">{{ data?.authors }}</span>
      </h5>
      <img :src="imgURL" :alt="'this is an image of' + data?.title" class="w-full" />
      <div
        class=":text-dark dark:text-bgLightyBlue text-justify leading-loose markdown"
        :innerHTML="description"
      ></div>
    </div>
    <!-- suggestions -->
    <div class="flex-1">
      <h4 class="font-bold text-sm text-dark dark:text-bggray mb-5">Suggestions</h4>
      <TourismSuggestionCard
        v-for="a in suggestionData"
        :key="a.id"
        :tourist="a"
        :type-of-data="typeOfData"
      />
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
.markdown a {
  font-size: 1em;
  text-decoration: underline;
}
.markdown a:hover {
  color: #cd4945;
}
</style>