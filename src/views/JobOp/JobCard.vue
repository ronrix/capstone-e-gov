<script setup>
import moment from 'moment'
import JobOpModal from './JobOpModal.vue'
import { ref } from 'vue'

const isShowJobModal = ref(false)
function handleShowJobModal() {
  isShowJobModal.value = !isShowJobModal.value
}

defineProps({
  job: { type: Object, required: true }
})
</script>
<template>
  <div
    class="p-5 rounded-md border dark:border-secondary hover:shadow-md cursor-pointer"
    @click="handleShowJobModal"
  >
    <!-- logo -->
    <section class="flex items-center gap-2 pointer-events-none">
      <div class="w-14 h-14 rounded-full overflow-hidden bg-white border p-2">
        <img :src="job.logo" alt="company logo" class="object-cover" />
      </div>
      <h3 class="font-bold text-base capitalize text-dar dark:text-bggray">{{ job.title }}</h3>
    </section>

    <!-- description -->
    <section class="line-clamp-3 text-secondary pointer-events-none">
      <p>{{ job.description }}</p>
    </section>

    <!-- footer -->
    <section
      class="border border-b-0 border-x-0 mt-5 py-3 flex items-center justify-between pointer-events-none"
    >
      <div class="flex items-center gap-2 flex-wrap">
        <h6
          v-for="(type, id) in job.types"
          :key="id"
          class="capitalize font-bold text-xs dark:text-bggray"
        >
          {{ type }} -
        </h6>
      </div>
      <h6 class="text-xs text-dark dark:text-bggray">
        <i class="uil uil-clock-three mr-2"></i>
        <span>{{ moment().endOf('day').fromNow() }}</span>
      </h6>
    </section>
  </div>

  <!-- show more details about the job : modal -->
  <JobOpModal
    :selected-job="job"
    :is-show-job-modal="isShowJobModal"
    :close-job-modal="handleShowJobModal"
  />
</template>