<script setup>
import moment from 'moment'
import JobOpModal from './JobOpModal.vue'
import { onMounted, ref } from 'vue'
import { formatImgs } from '../../utils/imgFormat'
import { useRoute } from 'vue-router'

const routes = useRoute()
const isShowJobModal = ref(false)
function handleShowJobModal() {
  isShowJobModal.value = !isShowJobModal.value
}

onMounted(() => {
  // show the jobOpModal if there is title params.
  // that means it was redirected from search page
  if (routes.params.title && routes.params.title.includes(props.job.job_title.toLowerCase())) {
    isShowJobModal.value = true
  }
})

const props = defineProps({
  job: { type: Object, required: true }
})
</script>
<template>
  <div
    class="p-5 rounded-md border dark:border-secondary hover:shadow-md cursor-pointer"
    @click="handleShowJobModal"
  >
    <!-- logo -->
    <section class="gap-2 pointer-events-none">
      <div class="w-[40px] h-[40px] rounded-full overflow-hidden bg-white border p-2">
        <img
          :src="formatImgs(job?.logo.split(','))[0]"
          alt="company logo"
          class="object-cover rounded-full"
        />
      </div>
      <h3 class="font-bold text-base capitalize text-dar dark:text-bggray">{{ job.job_title }}</h3>
    </section>

    <!-- description -->
    <section class="line-clamp-3 text-secondary pointer-events-none">
      <p>{{ job.job_description }}</p>
    </section>

    <!-- footer -->
    <section
      class="border border-b-0 border-x-0 mt-5 py-3 flex items-center justify-between pointer-events-none"
    >
      <div class="flex items-center gap-2 flex-wrap">
        <h6
          v-for="(type, id) in job.job_schedule.split(',')"
          :key="id"
          class="capitalize font-bold text-xs dark:text-bggray"
        >
          {{ type }} -
        </h6>
      </div>
      <h6 class="text-xs text-dark dark:text-bggray">
        <i class="uil uil-clock-three mr-2"></i>
        <span>{{ moment(job.created_at).endOf('day').fromNow() }}</span>
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