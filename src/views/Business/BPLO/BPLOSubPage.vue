<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import { onMounted, ref } from 'vue'
import { useRoute } from 'vue-router'

const bplo = ref()
const route = useRoute()
onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  bplo.value = JSON.parse(localStorage.getItem('bplo')).find((b) => b.id == route.params.id)
})

defineProps({
  data: { type: Object, required: true },
  showPermitModal: { type: Function, required: true }
})
</script>

<template>
  <HeaderSection />
  <WrapperContainer class="mt-10 p-5">
    <h4 v-if="!bplo" class="text-3xl text-center font-bold">
      We can't find the BPLO you are requesting
    </h4>
    <div v-else>
      <h4 class="text-2xl text-center font-bold capitalize">{{ bplo?.title }}</h4>
      <div v-for="(b, key, id) in JSON.parse(bplo?.requirements)" :key="id" class="mt-2">
        <h3 class="font-[600] capitalize">{{ key }}</h3>
        <p v-for="(req, i) in b" :key="i" class="capitalize text-sm">- {{ req }}</p>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>