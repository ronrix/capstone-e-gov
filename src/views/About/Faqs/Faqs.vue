<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import Questions from './Questions.vue'
import { ref, onMounted } from 'vue'
import { fetchData } from '../../../utils/axios-instance'
import Loading from '../../../components/Loading.vue'

const faqs = ref([])
const loading = ref(true)
const isError = ref()

const axiosCall = () => {
  fetchData('/faq')
    .then((data) => {
      faqs.value = data.faqs
      loading.value = false // set the loading to false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
      // display soomething is error
      isError.value = err.response?.data?.res?.err?.msg
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()
})
</script>

<template>
  <head>
    <title>FAQ | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <WrapperContainer>
    <div class="w-full flex flex-col gap-5 items-center mt-10">
      <p class="text-sm md:text-normal text-primary dark:text-primarylight font-bold uppercase">
        faq<span class="lowercase">s</span>
      </p>
      <h1 class="text-dark dark:text-white font-light text-3xl md:text-4xl capitalize">
        Frequenlty asked questions
      </h1>
      <h4 class="text-secondary text-sm text-center">
        Got any question? Find our FAQs here. If your questions hasn't been answered here, drop us a
        line or use our
        <RouterLink to="/about/contacts" class="text-primarylight">contacts</RouterLink>
      </h4>
    </div>
    <!-- questions -->
    <div class="flex flex-col mt-20 mx-1 md:mx-5 lg:mx-20">
      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <Questions v-for="(data, idx) in faqs" v-else :key="idx" :data="data" />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped></style>