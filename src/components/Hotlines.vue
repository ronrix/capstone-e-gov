<script setup>
import { onMounted, ref } from 'vue'
import { fetchData } from '../utils/axios-instance'
import { useHotlineStore } from '../stores/hotlines-store'

const store = useHotlineStore()
const hotlines = ref()

const axiosTourisms = () => {
  fetchData('/hotlines')
    .then((data) => {
      hotlines.value = data.hotlines
      store.setHotlines(data.hotlines)
      localStorage.setItem('hotlines', JSON.stringify(data.hotlines))
    })
    .catch((err) => console.log(err))
}

onMounted(() => {
  axiosTourisms()
})
</script>

<template>
  <div>
    <div class="bg-dark dark:bg-secondary p-5 gap-3">
      <WrapperContainer>
        <h5 class="font-bold flex items-center text-2xl uppercase gap-2">
          <i
            class="uil uil-outgoing-call w-10 h-10 bg-dark dark:bg-bggray rounded-full flex items-center justify-center text-bggray dark:text-dark"
          ></i>
          <span class="text-bggray">pililla emergency hotlines</span>
        </h5>
      </WrapperContainer>
    </div>
    <WrapperContainer class="grid grid-cols-2 items-center w-full">
      <div v-for="n in hotlines" :key="n.id" class="p-3">
        <h6 class="sm:text-base flex-1 font-bold text-dark dark:text-bggray !text-2xl capitalize">
          {{ n.department }}
        </h6>
        <div class="flex-1">
          <p class="text-sm sm:text-base rounded-lg text-dark dark:text-bggray">{{ n.smart }}</p>
          <p class="text-sm sm:text-base rounded-lg text-dark dark:text-bggray">{{ n.globe }}</p>
          <p class="text-sm sm:text-base rounded-lg text-dark dark:text-bggray">{{ n.landline }}</p>
        </div>
      </div>
    </WrapperContainer>
  </div>
</template>
