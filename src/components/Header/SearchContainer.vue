<script setup>
import { ref, onUpdated } from 'vue'
import axios from 'axios'
import { be_url } from '../../assets/config/config'
import { useRouter } from 'vue-router'
import { useSearchStore } from '../../stores/search-store'

defineProps({
  isShowSearchInput: { type: Boolean, required: true },
  closeSearchInput: { type: Function, required: true }
})

// search fetch request
async function search(query) {
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

const store = useSearchStore()
const router = useRouter()
// this function is invoked on searchinput
function onSubmit() {
  searchCache.value.push(searchInput.value.value)
  searchCache.value = [...new Set(searchCache.value)]
  localStorage.setItem('searches', JSON.stringify(searchCache.value))

  store.setInputSearch(searchInput.value.value)
  search(searchInput.value.value)
    .then((data) => {
      store.setSearch(data.results)
      router.push('/search')
    })
    .catch((err) => console.log(err))
}

// this function is for quick links, when that link was clicked this will get invoked
function searchQuickLinks(searchText) {
  store.setInputSearch(searchText)
  search(searchText)
    .then((data) => {
      store.setSearch(data.results)
      router.push('/search')
    })
    .catch((err) => console.log(err))
}

const searchInput = ref(null)
const searchCache = ref([])
onUpdated(() => {
  searchInput.value.focus()
  searchCache.value = [...new Set(JSON.parse(localStorage.getItem('searches')))]
})
</script>

<template>
  <div
    class="absolute z-20 top-8 md:top-14 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-700"
    :class="{ 'h-screen': isShowSearchInput, 'h-0': !isShowSearchInput }"
  >
    <div class="bg-white dark:bg-dark p-5 duration-200" @mouseleave="closeSearchInput">
      <WrapperContainer class="h-[300px] overflow-y-auto">
        <form class="flex items-center gap-2 mb-5" method="GET" @submit.prevent="onSubmit">
          <i class="uil uil-search text-2xl text-dark dark:text-bggray" />
          <input
            ref="searchInput"
            type="search"
            placeholder="Search pililla"
            class="rounded-md md:text-base p-3 w-full outline-none placeholder-darkgray dark:placeholder-secondary font-bold placeholder:text-xl bg-transparent dark:text-bggray"
          />
        </form>
        <!-- quick links -->
        <div class="flex flex-col items-start gap-3">
          <h5 class="capitalize text-xs text-bggray">quick links</h5>
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
    </div>
    <!-- bottom backdrop blur  -->
    <div class="backdrop-filter bg-white/50 dark:bg-dark/50 h-full"></div>
  </div>
</template>