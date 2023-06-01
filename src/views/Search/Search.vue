<script setup>
import { onMounted, ref } from 'vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import { useSearchStore } from '../../stores/search-store'
import { marked } from 'marked'
import DOMPurify from 'dompurify'
import axios from 'axios'
import { be_url } from '../../assets/config/config'

const store = useSearchStore()
const searchResults = ref([])
const searchInput = ref(null)
const searchCache = ref([])
const searchedText = ref(store.getInputSearch())

// search fetch request
async function searchFn(query) {
  return await axios
    .post(
      be_url + '/api/search',
      {
        query
      },
      {
        withCredentials: true
      }
    )
    .then(({ data }) => {
      return data
    })
    .catch((err) => {
      console.log(err)
      return err
    })
}

// this function is invoked on searchinput
function onSubmit() {
  searchCache.value.push(searchInput.value.value)
  searchCache.value = [...new Set(searchCache.value)]
  localStorage.setItem('searches', JSON.stringify(searchCache.value))

  store.setInputSearch(searchInput.value.value)
  searchedText.value = searchInput.value.value
  searchFn(searchInput.value.value)
    .then((data) => {
      searchResults.value = data.results
    })
    .catch((err) => console.log(err))
}

// this function is for quick links, when that link was clicked this will get invoked
function searchQuickLinks(searchText) {
  store.setInputSearch(searchText)
  searchedText.value = searchText
  searchFn(searchText)
    .then((data) => {
      searchResults.value = data.results
    })
    .catch((err) => console.log(err))
}

// get the right route path for the link
function getRightRoute(key) {
  console.log(key)
  if (key.includes('tourist-attractions') || key.includes('festivals')) {
    return 'tourism/' + key
  }
  if (key.includes('programs-events') || key.includes('news') || key.includes('job')) {
    if (key.includes('job')) {
      return 'government/' + key + '-op'
    }
    return 'government/' + key
  }
  if (key.includes('events')) {
    return 'business/' + key
  }
  if (key.includes('services')) {
    return key
  }
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  searchResults.value = store.getSearch()
  searchCache.value = [...new Set(JSON.parse(localStorage.getItem('searches')))]
})
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>Search | Pililla Rizal</title>
  </head>

  <!-- <WrapperContainer> -->
  <HeaderSection />
  <WrapperContainer class="h-screen">
    <form class="flex mt-10 gap-2" @submit.prevent="onSubmit">
      <input
        ref="searchInput"
        type="search"
        class="rounded-md md:text-base p-3 w-full outline-none placeholder-darkgray dark:placeholder-bggray font-bold placeholder:text-xl bg-transparent dark:text-bggray border border-secondary dark:border-bggray flex-1"
        placeholder="search pililla"
      />
      <button type="submit" class="px-3 text-bggray bg-primarylight rounded-md flex items-center">
        <i class="uil uil-search text-xl mr-2"></i>
        <span class="hidden md:block">Search</span>
      </button>
    </form>
    <div v-if="searchResults">
      <h5 class="text-sm text-dark dark:text-bggray my-5 font-bold">
        Search results for "{{ searchedText }}"
      </h5>
      <div v-for="(search, key) in searchResults" :key="search.id">
        <RouterLink
          v-for="(res, id) in search"
          :key="id"
          :to="
            getRightRoute(key) +
            '/' +
            res.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
          "
          class="group my-5 block"
        >
          <h4 class="text-xl font-bold text-dark dark:text-bggray group-hover:underline capitalize">
            {{ res.title }}
          </h4>
          <div
            class="text-secondary line-clamp-4 text-sm dark:text-bggray group-hover:underline"
            :innerHTML="DOMPurify.sanitize(marked.parse(res.description))"
          ></div>
        </RouterLink>
      </div>
    </div>

    <!-- no results -->
    <h5 v-else class="text-2xl text-dark dark:text-bggray mt-5">No search results!</h5>
    <div class="mt-10">
      <h5 class="capitalize text-xs text-dark dark:text-bggray">quick links</h5>

      <div
        v-for="(searchText, idx) in searchCache"
        :key="idx"
        class="text-xs dark:text-bggray dark:hover:bg-secondary hover:bg-bggray w-full font-semibold flex items-center gap-2 duration-300 rounded-md cursor-pointer"
        @click="searchQuickLinks(searchText)"
      >
        <i class="uil uil-arrow-right text-lg text-gray-400 pointer-events-none"></i>
        <span class="pointer-events-none">{{ searchText }}</span>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>