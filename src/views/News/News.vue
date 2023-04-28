<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import CurrentNews from './CurrentNews.vue'
import NewsCard from './NewsCard.vue'
import { ref, onMounted } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import { useNewsStore } from '../../stores/news-store'
import Loading from '../../components/Loading.vue'

const store = useNewsStore()
const newsHeadlines = ref([])
const loading = ref(true)
const isError = ref()

const axiosCall = () => {
  fetchData('/news')
    .then((data) => {
      newsHeadlines.value = data.news
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
  axiosCall()
})
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>News | Pililla Rizal</title>
  </head>

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
    <CurrentNews v-else :hotnews="newsHeadlines.slice(0, 3)" />
    <!-- all news -->
    <div class="mt-10 flex flex-col gap-8">
      <div class="flex items-center gap-2">
        <h4 class="font-bold capitalize text-dark dark:text-bggray">other news</h4>
        <div class="flex-1 h-[2px] bg-secondary"></div>
      </div>

      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-3 w-full">
        <NewsCard v-for="news in newsHeadlines.slice(3)" :key="news.id" :news="news" />
      </div>
    </div>
  </WrapperContainer>

  <FooterSection />
</template>