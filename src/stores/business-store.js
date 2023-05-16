import { ref } from 'vue'
import { defineStore } from 'pinia'

export const useBusinessStore = defineStore('business', () => {
  const business = ref(null)

  function getBusiness() {
    return business.value;
  }

  function setBusiness(data) {
    business.value = data;
  }

  return { getBusiness,  setBusiness }
})