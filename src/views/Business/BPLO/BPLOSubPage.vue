<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

import { marked } from 'marked'
import DOMPurify from 'dompurify'

const bplo = ref()
const route = useRoute()
const isDropdown = ref(false)

function showDropdown() {
  isDropdown.value = !isDropdown.value
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  bplo.value = JSON.parse(localStorage.getItem('bplo')).find((b) => b.id == route.params.id)
})
</script>

<template>
  <head>
    <title>Business Permit | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <WrapperContainer class="mt-14 sm:px-3">
    <h4 v-if="!bplo" class="text-3xl text-center font-bold text-dark dark:text-bggray">
      We can't find the BPLO you are requesting
    </h4>
    <div v-else>
      <h4 class="text-2xl text-center font-bold capitalize text-dark dark:text-bggray">
        {{ bplo?.title }}
      </h4>
      <div class="mt-2 text-dark dark:text-bggray">
        <h3 @click="showDropdown">
          {{ bplo.description }}
        </h3>

        <div
          class="capitalize text-sm overflow-hidden markdown"
          :innerHTML="DOMPurify.sanitize(marked.parse(bplo.requirements))"
        ></div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>
<style>
.markdown p {
  margin-top: 0.5em;
  font-size: 1em;
}
.markdown h2 {
  font-size: 1em;
  margin-top: 0.5em;
  font-weight: bold;
}
.markdown h3 {
  font-size: 1em;
  margin-top: 0.5em;
  font-weight: bold;
}
.markdown h4 {
  font-size: 1em;
  margin-top: 0.5em;
  font-weight: bold;
}
.markdown ul {
  list-style-type: disc;
  margin-left: 1em;
}
.markdown ol {
  list-style-type: decimal;
  margin-left: 1em;
}
</style>