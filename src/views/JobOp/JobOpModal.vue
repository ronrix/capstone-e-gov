<script setup>
import { formatImgs } from '../../utils/imgFormat'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

defineProps({
  selectedJob: { type: Object, required: true },
  isShowJobModal: { type: Boolean, required: true },
  closeJobModal: { type: Function, required: true }
})
</script>
<template>
  <div
    class="fixed bg-white/50 dark:bg-dark/50 bottom-0 left-0 w-full right-0 h-[70%] border rounded-tl-2xl rounded-tr-2xl duration-100 backdrop-blur-lg z-10"
    :class="{ 'translate-y-0': isShowJobModal, 'translate-y-full': !isShowJobModal }"
  >
    <!-- close btn -->
    <div
      class="border w-14 h-14 items-center justify-center absolute -top-8 left-1/2 -translate-x-1/2 bg-white dark:bg-dark text-dark dark:text-bggray rounded-full cursor-pointer"
      :class="{ hidden: !isShowJobModal, flex: isShowJobModal }"
      @click="closeJobModal"
    >
      <i class="uil uil-times pointer-events-none"></i>
    </div>

    <!-- content -->
    <WrapperContainer class="h-full overflow-y-auto">
      <div class="flex items-center mt-5 gap-3">
        <div class="w-[60px] h-[60px] rounded-full overflow-hidden bg-white border p-2">
          <img
            :src="formatImgs(selectedJob?.logo.split(','))[0]"
            alt="company logo"
            class="object-cover"
          />
        </div>
        <h4 class="text-2xl font-bold text-dark dark:text-bggray">
          {{ selectedJob?.company_name }}
        </h4>
      </div>
      <h4 class="text-3xl font-bold text-dark dark:text-bggray mt-5 capitalize">
        {{ selectedJob.job_title }}
      </h4>
      <p class="text-dark dark:text-bggray">@ {{ selectedJob.job_location }}</p>
      <p class="text-dark dark:text-bggray mb-3 underline">{{ selectedJob.email }}</p>
      <!-- schedules -->
      <span
        v-for="sche in selectedJob.job_schedule.split(',')"
        :key="sche"
        class="border px-3 rounded-md mr-2 text-sm capitalize font-[600] text-secondary dark:text-bggray"
        >{{ sche }}</span
      >

      <div
        class=":text-dark dark:text-bgLightyBlue text-justify leading-loose markdown mt-5"
        :innerHTML="DOMPurify.sanitize(marked(selectedJob?.job_description))"
      ></div>
      <p class="font-[600] text-dark dark:text-bggray mb-5">
        For more information. you can email us @{{ selectedJob?.email }}
      </p>
    </WrapperContainer>
  </div>
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