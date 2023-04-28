import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useHotlineStore = defineStore('hotlines', () => {
  const hotlines = ref(null)

  function getHotlines() {
    return hotlines.value;
  }

  function setHotlines(data) {
    hotlines.value = data;
  }

  return { hotlines, getHotlines, setHotlines }
})