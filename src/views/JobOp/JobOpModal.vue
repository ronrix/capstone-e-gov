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
      class="border w-14 h-14 items-center justify-center absolute -top-8 left-1/2 -translate-x-1/2 bg-white dark:bg-dark text-dark dark:text-bggray rounded-full cursor-pointer overflow-y-auto"
      :class="{ hidden: !isShowJobModal, flex: isShowJobModal }"
      @click="closeJobModal"
    >
      <i class="uil uil-times pointer-events-none"></i>
    </div>

    <!-- content -->
    <WrapperContainer>
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
      <h4 class="text-3xl font-bold text-dark dark:text-bggray mt-5">
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
        class=":text-dark dark:text-bgLightyBlue text-justify leading-loose mardown mt-5"
        :innerHTML="DOMPurify.sanitize(marked(selectedJob?.job_description))"
      ></div>
      <p class="font-[600] text-dark dark:text-bggray">For more information. Email us</p>
    </WrapperContainer>
  </div>
</template>