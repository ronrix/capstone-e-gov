<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import PDFViewer from 'pdf-viewer-vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import { be_url } from '../../../assets/config/config'

const ordinances = ref([])
const activeOrdinance = ref()
const axiosCall = () => {
  fetchData('/ordinances')
    .then((data) => {
      ordinances.value = data.ordinances
      activeOrdinance.value = data.ordinances[0]
    })
    .catch((err) => {
      console.log(err)
    })
}

function changeOrdinance(id) {
  activeOrdinance.value = ordinances.value.find((o) => o.id === id)
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Municipal Ordinances | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="flex items-center">
      <h1 class="text-2xl md:text-3xl py-10 font-bold dark:text-bggray">Municipal Ordinances</h1>
      <div class="flex-1 border-t-2 border-black dark:border-bggray ml-3"></div>
    </div>
    <h5 v-if="!activeOrdinance && !ordinances.length" class="font-bold text-2xl">
      No ordinances yet!
    </h5>
    <div v-else class="flex flex-col sm:flex-row gap-5">
      <PDFViewer class="!h-[800px]" :source="be_url + '/' + activeOrdinance?.pdf_path" />
      <div class="flex flex-col w-full sm:w-[400px]">
        <h2
          class="text-xl md:text-2xl font-bold border-b-2 border-black dark:border-bggray pb-2 dark:text-bggray"
        >
          Odinances
        </h2>

        <div class="py-3 border-b-[1px] border-dark dark:border-bggray">
          <button
            v-for="(ord, index) in ordinances"
            :key="index"
            class="line-clamp-2 text-xs sm:text-sm dark:text-bggray hover:text-primary dark:hover:text-primary"
            type="button"
            @click="changeOrdinance(ord.id)"
          >
            {{ ord.title }}
          </button>
        </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>
<style>
.pdf-viewer {
  --iron-icon-height: 20px;
  --iron-icon-width: 20px;
  --viewer-icon-ink-color: rgb(189, 189, 189);
  --viewer-pdf-toolbar-background-color: rgb(50, 54, 57);
  --viewer-text-input-selection-color: rgba(255, 255, 255, 0.3);
  --viewer-pdf-toolbar-height: 56px;
  background-color: #ccc;
  height: 100%;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  flex: 1;
  min-width: 50% !important;
  z-index: 1;
}
</style>