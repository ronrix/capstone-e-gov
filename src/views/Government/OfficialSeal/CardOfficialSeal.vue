<script setup>
import { formatImgs } from '../../../utils/imgFormat'

defineProps({
  data: { type: Object, required: true },
  idx: { type: Object, required: true }
})
</script>

<template>
  <div
    class="flex flex-col mt-2 rounded-md bg-white border border-gray-50 dark:bg-dark px-3 lg:px-5 py-7"
  >
    <div class="flex flex-col md:flex-row items-center mx-2 lg:mx-10 gap-10">
      <div
        class="flex flex-col gap-3"
        :class="{ 'order-last md:order-first': idx % 2 === 0, 'order-last': idx % 2 !== 0 }"
      >
        <h1
          class="text-2xl md:text-3xl font-bold text-primary dark:text-primarylight uppercase"
          :class="{ 'text-blue-600 dark:text-blue-400': idx % 2 !== 0 }"
        >
          {{ data?.title }}
        </h1>
        <p class="flex-1 text-sm lg:text-base text-gray-500 dark:text-white">
          {{ data?.description }}
        </p>
      </div>
      <img
        class=""
        :src="formatImgs(data.img_link.split(','))[0]"
        alt=""
        :class="{
          'order-first md:order-last w-[300px]': idx % 2 === 0,
          'order-first': idx % 2 !== 0
        }"
      />
    </div>
  </div>
</template>


<style scoped></style>