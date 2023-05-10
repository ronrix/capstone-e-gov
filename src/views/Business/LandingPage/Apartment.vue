<script setup>
import { formatImgs } from '../../../utils/imgFormat'
import DOMPurify from 'dompurify'
import { marked } from 'marked'

defineProps({
  apartment: { type: Object, required: true },
  idx: { type: Number, required: true }
})
</script>

<template>
  <div
    class="flex flex-col md:flex-row items-start md:items-center mx-0 lg:mx-10 mt-1 gap-5 md:gap-10 mb-12 md:mb-0"
  >
    <img
      class="flex-1 w-full md:w-1/2 h-[300px] lg:h-[350px] rounded-lg"
      :src="formatImgs(apartment?.img_link.split(','))[0]"
      :class="{ 'order-first': idx % 2 === 0, 'order-first md:order-last': idx % 2 !== 0 }"
    />

    <div
      class="flex flex-col flex-1 gap-2"
      :class="{ 'order-last': idx % 2 === 0, 'order-first': idx % 2 !== 0 }"
    >
      <p class="text-xl md:text-2xl font-semibold text-dark dark:text-white">
        {{ apartment?.title }}
      </p>
      <div>
        <div class="flex items-center">
          <i class="uil uil-map-marker text-red-700 text-base"></i>
          <span class="text-sm text-dark dark:text-white capitalize font-[600]">{{
            apartment?.location
          }}</span>
        </div>
        <div
          class="markdown"
          :innerHTML="DOMPurify.sanitize(marked.parse(apartment?.description))"
        ></div>
      </div>
    </div>
  </div>
</template>

<style>
.markdown p {
  font-size: 1em;
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