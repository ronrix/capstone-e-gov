<script setup>
import { formatImgs } from '../../utils/imgFormat'

defineProps({
  data: { type: Object, required: true },
  showDisplayModal: { type: Function, required: true }
})
</script>

<template>
  <div
    class="flex flex-col gap-3 md:gap-4 mt-3 bg-white dark:bg-dark px-0 pt-0 pb-3 border dark:border-gray-500 shadow-sm"
  >
    <img :src="formatImgs(data.img_link.split(','))[0]" alt="" class="h-[250px] object-cover" />
    <div class="flex flex-col gap-2 p-2">
      <div class="flex items-center gap-2">
        <h1 class="text-sm sm:text-xl lg:text-lg text-dark dark:text-white font-bold capitalize">
          {{ data?.title }}
        </h1>
        <div class="bg-dark flex-1 w-full h-0.5 dark:bg-white"></div>
      </div>
      <div class="flex items-center gap-1">
        <i class="uil uil-map-marker text-base text-gray-700 dark:text-white"></i>
        <span class="text-base text-dark dark:text-white font-semibold">Address: </span>
        <p class="max-w-[200px] text-sm text-dark dark:text-white capitalize">
          {{ data?.location }}
        </p>
      </div>
      <button
        class="w-full sm:w-fit px-3 text-sm text-white bg-primary dark:bg-primarylight hover:bg-primarylight dark:hover:bg-primary rounded-md py-2"
        @click="showDisplayModal(data)"
      >
        View
        <i class="uil uil-angle-right"></i>
      </button>
    </div>
  </div>
</template>