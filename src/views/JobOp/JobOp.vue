<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import JobCard from './JobCard.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import { onMounted, onUnmounted, ref } from 'vue'
import { fetchData } from '../../utils/axios-instance'
import Loading from '../../components/Loading.vue'

const inputSearch = ref('')
function onSubmit() {
  jobs.value = OR_JOBS.value.filter((a) =>
    a.job_title.toLowerCase().includes(inputSearch.value.toLowerCase())
  )
}

const OR_JOBS = ref([])
const jobs = ref([])
const loading = ref(true)
const axiosCall = () => {
  fetchData('/job-postings')
    .then((data) => {
      jobs.value = data.jobs
      OR_JOBS.value = data.jobs
      loading.value = false
    })
    .catch((err) => {
      console.log(err)
      loading.value = false
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Job Opportunities | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template>
  <HeaderSection />

  <WrapperContainer class="mt-10">
    <div class="grid place-items-center mb-10"></div>
    <div class="flex items-center justify-center">
      <h5
        class="rounded-full px-3 py-1 text-bggray bg-dark dark:bg-bggray dark:text-dark capitalize text-xs font-bold"
      >
        Job searching
      </h5>
    </div>
    <h2 class="text-dark dark:text-bggray text-5xl font-bold text-center mt-5">
      Find the Right Jobs
    </h2>
    <h5 class="text-xl text-secondary text-center mt-5">Open jobs. people hiring.</h5>
    <div class="flex justify-center mt-5">
      <div>
        <RouterLink
          to="/job-forms"
          class="bg-primary rounded-full w-fit text-center mx-auto py-2 block text-white px-3 hover:opacity-80"
        >
          Post your job
        </RouterLink>
        <p class="text-sm text-secondary">Submit a request to post Job opportunity</p>
      </div>
    </div>
    <!-- search input -->
    <form class="flex items-center justify-center mt-10 gap-2" @submit.prevent="onSubmit">
      <input
        v-model="inputSearch"
        type="search"
        placeholder="Search a job"
        class="border border-dark py-2 rounded-full px-5 w-[500px] outline-none"
      />
      <button
        type="submit"
        class="border rounded-full w-10 h-10 flex items-center justify-center bg-primary text-bggray hover:bg-primarylight"
      >
        <i class="uil uil-search text-xl"></i>
      </button>
    </form>

    <!-- lists of jobs -->
    <div class="mt-10">
      <h5 class="text-sm font-bold text-dark dark:text-secondary">All jobs</h5>

      <!-- card jobs -->
      <Loading v-if="loading" class="w-10 h-10 mx-auto" />
      <div v-else class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
        <JobCard v-for="job in jobs" :key="job.id" :job="job" />
      </div>
    </div>
  </WrapperContainer>

  <FooterSection />
</template>