<script setup>
import { onMounted, ref } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import { useHotlineStore } from '../../stores/hotlines-store'
import HotlinesTable from './HotlinesTable.vue'

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
    <WrapperContainer>
      <HotlinesTable :hotlines="hotlines" />
    </WrapperContainer>
  </div>
</template>
