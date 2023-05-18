<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import CurrentNews from './CurrentNews.vue'
import NewsCard from './NewsCard.vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import { useNewsStore } from '../../stores/news-store'
import Loading from '../../components/Loading.vue'

const store = useNewsStore()
const newsHeadlines = ref([])
const otherNews = ref([])
const loading = ref(true)
const isError = ref()

const axiosCall = () => {
  fetchData('/news')
    .then((data) => {
      newsHeadlines.value = data.news.slice(0, 3)
      otherNews.value = data.news.slice(3)
      store.setNews(data.news)
      localStorage.setItem('hnd', JSON.stringify(newsHeadlines.value))
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
  document.title = 'News | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>

<template>
  <HeaderSection />
  <!-- error occured -->
  <WrapperContainer v-if="isError">
    <h4 class="font-bold text-3xl text-center">{{ isError.msg }}</h4>
    <p class="text-lg text-center">Error has occured.</p>
  </WrapperContainer>

  <!-- content -->
  <WrapperContainer v-else class="mt-10">
    <!-- loading animation -->
    <Loading v-if="loading" class="w-10 h-10 mx-auto" />
    <CurrentNews v-else :hotnews="newsHeadlines" />
    <!-- all news -->
    <div class="mt-10 flex flex-col gap-8">
      <div class="flex items-center gap-2">
        <h4 class="font-bold capitalize text-dark dark:text-bggray">other news</h4>
        <div class="flex-1 h-[2px] bg-secondary"></div>
      </div>

      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <h4 v-if="!otherNews.length && !loading" class="font-bold text-2xl text-center">
        No other news found!
      </h4>
      <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-3 w-full">
        <NewsCard v-for="news in otherNews" :key="news.id" :news="news" />
      </div>
    </div>
  </WrapperContainer>

  <FooterSection />
</template>