<script setup>
import { marked } from 'marked'
import DOMPurify from 'dompurify'
import { formatImgs } from '../../utils/imgFormat'

defineProps({
  closeModal: { type: Function, required: true },
  selectedData: { type: Object, required: true }
})
</script>
<template>
  <div
    class="fixed top-1/3 h-screen w-screen bg-white dark:bg-dark shadow-md z-20 duration-150 border border-b-0 border-x-0 border-secondary"
  >
    <!-- close modal -->
    <div
      class="absolute -top-5 left-1/2 -translate-x-1/2 px-3 bg-white dark:bg-dark rounded-full w-12 h-12 flex items-center justify-center cursor-pointer border border-b-0 border-x-0 border-secondary"
      @click="closeModal"
    >
      <i class="uil uil-angle-down text-2xl pointer-events-none text-dark dark:text-bggray"></i>
    </div>
    <h3 v-if="!selectedData" class="text-2xl font-bold">Sorry something went wrong!</h3>
    <WrapperContainer v-else class="mt-10 h-full overflow-y-auto">
      <h4 class="font-bold text-2xl capitalize text-dark dark:text-bggray">
        {{ selectedData?.title }}
      </h4>
      <h6 class="text-sm text-dark dark:text-bggray">
        <span>Posted by: </span>
        <span class="capitalize font-[600]">{{ selectedData?.authors }}</span>
      </h6>
      <h6 class="text-dark dark:text-bggray">
        <i class="uil uil-map-marker text-primary"></i>
        <span class="capitalize font-[600]">{{ selectedData?.location }}</span>
      </h6>
      <div
        class=":text-dark dark:text-bgLightyBlue text-justify leading-loose mardown mt-3"
        :innerHTML="DOMPurify.sanitize(marked.parse(selectedData?.description || ''))"
      ></div>

      <!-- images -->
      <div class="flex flex-col mb-10">
        <img
          v-for="url in formatImgs(selectedData?.img_link.split(','))"
          :key="url"
          :src="url"
          :alt="'this is an iamge of ' + selectedData?.title"
        />
      </div>
    </WrapperContainer>
  </div>
</template>

<style>
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>