import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useTourism = defineStore('tourism', () => {
  const tourism = ref(null)

  function getTourism() {
    return tourism.value;
  }

  function setTourism(data) {
    tourism.value = data;
  }

  function getOneTourism(title) {
    const temp = tourism.value.find(n => n.title.toLowerCase() == title);
    return temp;
  }

  function getTopThreeTourism() {
    return tourism.value.slice(0, 3);
  }

  return { tourism, setTourism, getTourism, getTopThreeTourism, getOneTourism }
})