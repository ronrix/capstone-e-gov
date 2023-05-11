<script setup>
import { RouterLink } from 'vue-router'
import { formatImgs } from '../../utils/imgFormat'

defineProps({
  hotnews: { type: Array, required: true }
})
</script>
<template>
  <div class="flex flex-col items-center justify-center">
    <h5 class="font-bold text-xs capitalize text-dark dark:text-bggray">news</h5>
    <h4 class="capitalize text-3xl text-dark dark:text-bggray font-bold">
      <span class="text-primarylight">hot </span> topic
      <span class="text-primarylight">news</span>
    </h4>

    <div class="flex flex-col sm:flex-row items-center">
      <div
        v-for="n in hotnews"
        :key="n.id"
        class="flex flex-col justify-end mt-5 h-[500px] w-full bg-no-repeat bg-cover group overflow-hidden"
        :style="{ backgroundImage: 'url(' + formatImgs(n.img_link.split(','))[0] + ')' }"
      >
        <div
          class="duration-500 translate-y-10 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 flex flex-col items-start bg-black/50 p-5"
        >
          <h3 class="font-bold text-xl md:text-3xl text-white w-3/4 capitalize">{{ n.title }}</h3>
          <RouterLink
            :to="'/news/' + n.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()"
            type="button"
            class="bg-white px-3 py-1 font-bold text-dark capitalize rounded-md flex items-center active:-translate-y-1 mt-5"
          >
            read more
            <i class="uil uil-angle-right"></i>
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>