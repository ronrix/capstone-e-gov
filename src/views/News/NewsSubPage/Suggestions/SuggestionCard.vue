<script setup>
import moment from 'moment'
defineProps({
  news: { type: Object, required: true }
})
</script>
<template>
  <a
    :href="'/news/' + news.title"
    class="flex flex-col items-start border border-x-0 border-t-0 py-3 gap-2 group cursor-pointer border-secondary"
  >
    <p
      class="flex items-center text-xs text-secondary dark:group-hover:text-white group-hover:text-primarylight"
    >
      <i class="uil uil-clock-five"></i>
      <span>{{ moment().endOf('day').fromNow() }}</span>
    </p>
    <h3 class="font-bold text-xl text-dark dark:text-bggray">{{ news.title }}</h3>
    <p
      class="text-xs text-secondary line-clamp-3 dark:group-hover:text-white group-hover:text-primarylight"
    >
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias quos aspernatur ab,
      voluptate porro nam cupiditate fuga id debitis culpa nobis. Deserunt est pariatur, ducimus
      aperiam dolorum cum soluta dicta?
    </p>
  </a>
</template>