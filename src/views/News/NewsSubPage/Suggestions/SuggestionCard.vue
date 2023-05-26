<script setup>
import moment from 'moment'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

const description = DOMPurify.sanitize(marked.parse(props.news.description))
const props = defineProps({
  news: { type: Object, required: true }
})
</script>
<template>
  <RouterLink
    :to="'/government/news/' + news.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()"
    class="flex flex-col items-start border border-x-0 border-t-0 py-3 gap-2 group cursor-pointer border-secondary"
  >
    <p class="flex items-center text-xs text-dark dark:text-bggray">
      <i class="uil uil-clock-five"></i>
      <span>{{ moment(news.created_at).fromNow() }}</span>
    </p>
    <h3 class="font-bold text-xl text-dark dark:text-bggray capitalize">{{ news.title }}</h3>
    <p
      class="text-xs text-dark dark:text-bggray line-clamp-3 group-hover:text-primarylight"
      :innerHTML="description"
    ></p>
  </RouterLink>
</template>