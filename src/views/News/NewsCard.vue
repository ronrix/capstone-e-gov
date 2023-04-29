<script setup>
import moment from 'moment'
import { RouterLink } from 'vue-router'
import { formatImgs } from '../../utils/imgFormat'

const imgURL = formatImgs(props.news.img_link.split(','))

const props = defineProps({
  news: { type: Object, required: true }
})
</script>

<template>
  <RouterLink
    :to="'/news/' + news.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()"
    class="flex items-center justify-center hover:shadow-lg cursor-pointer gap-x-5"
  >
    <!-- left -->
    <div class="flex-1 flex flex-col items-start justify-start h-full gap-5">
      <div>
        <h5 class="text-xs sm:text-base font-bold text-dark dark:text-bggray capitalize">
          By {{ news.authors }}
        </h5>
        <p class="flex items-center text-xs text-secondary gap-2">
          <i class="uil uil-clock-five"></i>
          <span>{{ moment().endOf('day').fromNow() }}</span>
        </p>
      </div>
      <h3 class="font-bold text-base lg:text-2xl text-dark dark:text-bggray capitalize">
        {{ news.title }}
      </h3>
    </div>

    <!-- right -->
    <div class="flex-1 overflow-hidden">
      <img class="w-full object-cover" :src="imgURL" alt="" />
    </div>
  </RouterLink>
</template>