<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import BusinessPermits from './BusinessPermits.vue'
import { fetchData } from '../../../utils/axios-instance'
import { onMounted } from 'vue'
import { ref } from 'vue'
import Loading from '../../../components/Loading.vue'
import { be_url } from '../../../assets/config/config'

const applicationForm = ref()
const permits = ref([])
const originalPermits = ref([])
const loading = ref(true)
const axiosCall = () => {
  // fetch permits data
  fetchData('/permits')
    .then((data) => {
      permits.value = data.permits
      originalPermits.value = data.permits
      localStorage.setItem('bplo', JSON.stringify(data.permits))
      loading.value = false
    })
    .catch((err) => {
      loading.value = false
      console.log(err)
    })
}

const getApplicationForm = () => {
  // fetch application form
  fetchData('/application-forms')
    .then((data) => {
      applicationForm.value = data.application_forms[0]
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  axiosCall()
  getApplicationForm()
})
</script>

<template>
  <head>
    <title>Business Permit | Pililla Rizal</title>
  </head>

  <HeaderSection class="relative" />
  <WrapperContainer>
    <div class="w-full flex flex-col gap-4 items-center mt-24">
      <div class="relative mt-10">
        <h1 class="text-dark dark:text-white font-bold text-4xl md:text-5xl">
          <span class="text-primary dark:text-primarylight">Businesses Permit</span> here.
        </h1>
        <div class="bg-primary dark:bg-primarylight absolute w-[45%] -bottom-1 h-1"></div>
      </div>
      <p class="text-base text-secondary dark:text-gray-100 text-center">
        The Municipality of Pilila Rizal requires every one who are planning to do business to have
        a Business Permit. To be issued a Business Permit the applicant must submit an application
        form with supporting documents
      </p>
    </div>

    <!-- application form  -->
    <div class="w-full flex flex-col items-center mt-5">
      <a
        v-if="applicationForm"
        :href="be_url + '/uploads/files/application-form/' + applicationForm?.filename"
        target="_blank"
        class="text-sm md:text-base px-3 py-2 bg-primary font-bold hover:bg-primarylight text-white rounded-md shadow-lg shadow-primarylight/50"
        >Download the application form <i class="uil uil-angle-right"></i
      ></a>
    </div>
    <!-- business permits -->
    <h2 class="w-full mt-10 text-sm font-bold text-dark dark:text-white capitalize">
      All business permits
    </h2>
    <!-- permits -->
    <div class="w-full mt-5">
      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <div v-else class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-2">
        <BusinessPermits v-for="(data, id) in permits" :key="id" :data="data" />
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped></style>