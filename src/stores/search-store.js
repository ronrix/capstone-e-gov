import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useSearchStore = defineStore('search', () => {
  const search = ref(null)
  const inputSearch = ref("")

  function setInputSearch(query) {
    inputSearch.value = query
  }

  function getInputSearch() {
    return inputSearch.value
  }

  function getSearch() {
    return search.value;
  }

  function setSearch(data) {
    search.value = data;
  }

  return { search, getSearch, setSearch, setInputSearch, getInputSearch }
})