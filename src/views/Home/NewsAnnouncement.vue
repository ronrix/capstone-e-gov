<script setup>
import { onMounted, ref } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import { formatImgs } from '../../utils/imgFormat'

const news = ref([])
const loading = ref(true)
const newsToDisplay = ref()
const newsIndex = ref(0)

// content navigation
function changeCotentNavigation(i) {
  newsIndex.value = i - 1 // base 0
  setTimeout(() => {
    newsToDisplay.value = news.value[i - 1] // base 0
  }, 0)
}

// this function change the news displayed
function changeNewsDisplay() {
  setInterval(() => {
    newsIndex.value++
    if (newsIndex.value == news.value.length) {
      newsToDisplay.value = news.value[0]
      newsIndex.value = 0
    } else {
      newsToDisplay.value = news.value[newsIndex.value]
    }
  }, 10000)
}

const axiosCall = () => {
  fetchData('/news')
    .then((data) => {
      news.value = data.news.slice(0, 3)
      newsToDisplay.value = news.value[0]
      loading.value = false // set the loading to false

      // invoke the changing news display
      changeNewsDisplay()
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  axiosCall()
})

defineProps({
  show: { type: Boolean, required: true },
  showNewsAnnouncement: { type: Function, required: true }
})
</script>
<template>
  <div class="sm:sticky w-full top-16 col-span-4 md:col-span-2 sm:h-[500px] mt-10">
    <h4 class="font-bold text-dark dark:text-bggray text-sm">News & Announcements</h4>
    <div class="w-full">
      <div
        v-if="newsToDisplay"
        class="flex flex-col justify-end h-[300px] sm:h-[500px] w-full bg-no-repeat bg-cover group overflow-hidden"
        :style="{
          backgroundImage: 'url(' + formatImgs(newsToDisplay?.img_link.split(','))[0] + ')'
        }"
      >
        <div class="flex flex-col items-start justify-end bg-black/50 p-5 h-full">
          <h3 class="font-bold text-xl text-white w-3/4 capitalize">
            {{ newsToDisplay?.title }}
          </h3>
          <RouterLink
            :to="
              '/government/news/' +
              newsToDisplay?.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
            "
            type="button"
            class="text-xs sm:text-sm bg-white px-3 py-1 font-bold text-dark capitalize rounded-md flex items-center active:-translate-y-1 mt-5 hover:bg-primarylight hover:text-bggray"
          >
            read more
            <i class="uil uil-angle-right"></i>
          </RouterLink>

          <!-- content navigation -->
          <div class="flex items-center mt-10 gap-1">
            <!-- circle -->
            <div
              v-for="i in news.length"
              :key="i"
              class="w-5 h-5 rounded-full bg-secondary/80 cursor-pointer"
              :class="{ 'border-2 border-bggray': i - 1 === newsIndex }"
              @click="changeCotentNavigation(i)"
            ></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>