import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useSearchStore = defineStore('search', () => {
  const search = ref(null)

  function getSearch() {
    return search.value;
  }

  function setSearch(data) {
    search.value = data;
  }

  return { search, getSearch, setSearch }
})