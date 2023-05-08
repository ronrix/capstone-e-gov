import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useApartmentStore = defineStore('apartments', () => {
  const apartments = ref(null)

  function getApartments() {
    return apartments.value;
  }

  function setApartments(data) {
    apartments.value = data;
  }

  return { apartments, getApartments,  setApartments }
})