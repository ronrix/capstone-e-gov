import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useFestivalStore = defineStore('festivals', () => {
  const festivals = ref(null)

  function getFestivals() {
    return festivals.value;
  }

  function setFestivals(data) {
    festivals.value = data;
  }

  function getOneFestival(title) {
    const temp = festivals.value.find(n => n.title.toLowerCase() == title);
    return temp;
  }

  return {  festivals, getFestivals, setFestivals, getOneFestival }
})