<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import JobCard from './JobCard.vue'
import { jobs } from '../../assets/data/jobs'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
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
        <p class="text-sm font-[500]">Submit a request to post Job opportunity</p>
        <RouterLink
          to="/job-forms"
          class="bg-primary rounded-full w-fit text-center mx-auto py-2 block text-white px-3 hover:opacity-80"
        >
          Post your job
        </RouterLink>
      </div>
    </div>
    <!-- search input -->
    <form class="flex items-center justify-center mt-10 gap-2">
      <input
        type="search"
        placeholder="Search a job"
        class="border border-dark py-2 rounded-full px-5 w-[500px] outline-none"
      />
      <button
        class="border rounded-full w-10 h-10 flex items-center justify-center bg-primary text-bggray hover:bg-primarylight"
      >
        <i class="uil uil-search text-xl"></i>
      </button>
    </form>

    <!-- lists of jobs -->
    <div class="mt-10">
      <h5 class="text-sm font-bold text-dark dark:text-secondary">All jobs</h5>

      <!-- card jobs -->
      <div class="mt-5 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2">
        <JobCard v-for="job in jobs" :key="job.id" :job="job" />
      </div>
    </div>
  </WrapperContainer>

  <FooterSection />
</template>