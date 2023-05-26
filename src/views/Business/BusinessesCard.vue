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
    <img :src="formatImgs(data.img_link.split(','))[0]" :alt="`this is the view of the apartment from ${data?.location}`" class="h-[250px] object-cover" />
    <div class="flex-1 flex flex-col gap-1">
      <h1 class="text-sm sm:text-xl lg:text-lg text-dark dark:text-white font-bold ml-1 capitalize">
        {{ data?.title }}
      </h1>
      <hr />
      <div class="flex-1 flex flex-col mt-2 ml-1">
        <div>
          <i class="uil uil-map-marker text-base text-gray-700 dark:text-white"></i>
          <span class="text-base text-dark dark:text-white font-semibold mr-2">Address: </span>
        </div>
        <p class="text-sm text-dark dark:text-white capitalize">
          {{ data?.location }}
        </p>
      </div>
      <button
        class="w-full sm:w-fit px-3 text-sm text-white ml-1 bg-primary dark:bg-primarylight hover:bg-primarylight dark:hover:bg-primary rounded-md py-2"
        @click="showDisplayModal(data)"
      >
        View
        <i class="uil uil-angle-right"></i>
      </button>
    </div>
  </div>
</template>