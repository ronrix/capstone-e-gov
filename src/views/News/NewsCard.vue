<script setup>
import moment from 'moment'

defineProps({
  news: { type: Object, required: true }
})
</script>

<template>
  <div
    class="flex items-center justify-center hover:shadow-lg hover:scale-[1.010] cursor-pointer gap-x-3 p-3"
  >
    <!-- left -->
    <div class="flex-1 flex flex-col items-start justify-between h-full gap-2">
      <div>
        <h5 class="text-xs sm:text-base font-bold text-dark dark:text-bggray capitalize">
          By {{ news.authors }}
        </h5>
        <p class="flex items-center text-xs text-secondary gap-2">
          <i class="uil uil-clock-five"></i>
          <span>{{ moment().endOf('day').fromNow() }}</span>
        </p>
      </div>
      <h3 class="font-bold text-base lg:text-2xl text-dark dark:text-bggray">{{ news.title }}</h3>
      <a
        :href="'/news/' + news.title"
        type="button"
        class="text-dark capitalize text-sm hover:text-primarylight dark:text-bggray"
      >
        read more
      </a>
    </div>

    <!-- right -->
    <div class="flex-1 overflow-hidden">
      <img class="w-full object-cover" :src="news.thumbnail" alt="" />
    </div>
  </div>
</template>