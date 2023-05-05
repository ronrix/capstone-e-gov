<script setup>
import { formatImgs } from '../../utils/imgFormat'

defineProps({
  official: { type: Object, required: false }
})
</script>
<template>
  <div
    class="border border-dark dark:border-bggray p-5 w-full sm:w-[400px] flex flex-col items-center mx-auto dark:bg-dark duration-200 rounded-lg shadow-lg relative"
  >
    <div
      class="w-[100px] h-[100px] overflow-hidden absolute -top-1/2 left-1/2 -translate-x-1/2 bg-white dark:bg-dark rounded-full"
    >
      <img
        :src="formatImgs(official?.img_link.split(','))[0]"
        alt="this is an image of the mayor of pililla rizal"
        class="object-cover w-full h-full rounded-lg"
      />
    </div>
    <h3 class="font-bold text-xl text-dark dark:text-bggray mt-5 capitalize">
      {{ official?.executive_name }}
    </h3>
    <h5 class="text-primary dark:text-primarylight capitalize">{{ official?.position }}</h5>
  </div>
</template>