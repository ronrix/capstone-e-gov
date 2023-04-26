<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import CurrentNews from './CurrentNews.vue'
import NewsCard from './NewsCard.vue'
import { ref, onMounted } from 'vue'
import { axiosInstance } from '../../utils/axios-instance'
import { useNewsStore } from '../../stores/news-store'
import { be_url } from '../../assets/config/config'

const store = useNewsStore()
const newsHeadlines = ref([])
const loading = ref(true)

const axiosCall = () => {
  axiosInstance()
    .get(be_url + '/news', { withCredentials: true })
    .then(({ data }) => {
      newsHeadlines.value = data.news
      store.setNews(data.news)
      localStorage.setItem('hnd', JSON.stringify(newsHeadlines.value))
      loading.value = false // set the loading to false
    })
    .catch((err) => console.log(err))
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
  <!-- content -->
  <WrapperContainer class="mt-10">
    <!-- skeleton loading animation -->
    <div v-if="loading" class="h-[300px] w-full animate-pulse bg-slate-200"></div>

    <CurrentNews v-else :hotnews="newsHeadlines.slice(0, 3)" />
    <!-- all news -->
    <div class="mt-10 flex flex-col gap-8">
      <div class="flex items-center gap-2">
        <h4 class="font-bold capitalize text-dark dark:text-bggray">other news</h4>
        <div class="flex-1 h-[2px] bg-secondary"></div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div v-if="loading" class="h-[200px] animate-pulse bg-slate-200"></div>
        <div v-if="loading" class="h-[200px] animate-pulse bg-slate-200"></div>
        <div v-if="loading" class="h-[200px] animate-pulse bg-slate-200"></div>
        <div v-if="loading" class="h-[200px] animate-pulse bg-slate-200"></div>
        <NewsCard v-for="news in newsHeadlines.slice(3)" v-else :key="news.id" :news="news" />
      </div>
    </div>
  </WrapperContainer>

  <FooterSection />
</template>