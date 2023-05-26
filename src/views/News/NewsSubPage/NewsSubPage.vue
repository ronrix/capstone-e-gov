<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import SuggestionCard from './Suggestions/SuggestionCard.vue'

import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { ref, onMounted, computed, onUnmounted } from 'vue'
import { useRoute } from 'vue-router'
import moment from 'moment'
import { useNewsStore } from '../../../stores/news-store'
import { formatImgs } from '../../../utils/imgFormat'

const store = useNewsStore()

// paremeter :title
const route = useRoute()
const newsTitle = computed(() => route.params.title.replace(/_/g, ' ').toLowerCase())
const news = ref()
const description = ref('')
const imgURL = ref()
const suggestionNews = ref()

const loadNews = () => {
  if (store.getNews()) {
    news.value = store.getOneNews(newsTitle.value)
    suggestionNews.value = store
      .getNews()
      .filter((a) => a.id !== news.value.id)
      .slice(0, 3)
  } else {
    store.setNews(JSON.parse(localStorage.getItem('hnd')))
    const newsData = JSON.parse(localStorage.getItem('hnd'))
    news.value = newsData.find((n) => n.title.toLowerCase() == newsTitle.value)
    suggestionNews.value = newsData.filter((a) => a.id !== news.value.id).slice(0, 3)
  }

  description.value = DOMPurify.sanitize(marked.parse(news.value.description))
  imgURL.value = formatImgs(news.value.img_link.split(','))[0]
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'News | Pililla Rizal'

  loadNews()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection />

  <WrapperContainer>
    <div class="mt-10 flex flex-col md:flex-row gap-5">
      <!-- 404 not found -->
      <div v-if="!news" class="flex-1 text-center">
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
          <span>{{ moment(news?.created_at).fromNow() }}</span>
        </p>
        <h3 class="font-bold text-2xl text-dark dark:text-bggray sm:w-1/2 capitalize">
          {{ news?.title }}
        </h3>

        <img class="w-full" :src="imgURL" :alt="news?.title" />

        <div
          class=":text-dark dark:text-bgLightyBlue text-justify leading-loose mardown"
          :innerHTML="description"
        ></div>
      </div>

      <!-- suggestions -->
      <div class="flex-1">
        <h4 class="font-bold text-sm text-dark dark:text-bggray mb-5">Suggestions</h4>
        <SuggestionCard v-for="a in suggestionNews" :key="a.id" :news="a" />
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