import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useProgEventsStore = defineStore('prog-events', () => {
  const progEvents = ref(null)

  function getProgEvents() {
    return progEvents.value;
  }

  function setProgEvents(data) {
    progEvents.value = data;
  }

  function getOneProgEvents(title) {
    const temp = progEvents.value.find(n => n.title.toLowerCase() == title);
    return temp;
  }

  return { progEvents, setProgEvents, getOneProgEvents, getProgEvents }
})