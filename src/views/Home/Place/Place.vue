<script setup>
import { RouterLink } from 'vue-router'
import { formatImgs } from '../../../utils/imgFormat'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

const imgURL = formatImgs(props.place.img_link.split(','))
const description = DOMPurify.sanitize(marked.parse(props.place.description))

const props = defineProps({
  place: { type: Object, required: true },
  idx: { type: Number, required: true }
})
</script>

<template>
  <div class="flex flex-col sm:flex-row p-5 items-start xl:items-center justify-evenly gap-5">
    <div
      class="flex-1"
      :class="{ 'sm:order-first': idx % 2 === 0, 'sm:order-last sm:text-end': idx % 2 !== 0 }"
    >
      <h3 class="text-xl sm:text-4xl font-bold capitalize">
        {{ place.title }}
      </h3>
      <h6 class="text-sm mb-2">
        Located at
        <span class="text-primarylight font-bold">
          <i class="uil uil-map-marker-question" />
          {{ place.location }}
        </span>
      </h6>
      <h4
        class="font-['display'] text-sm sm:text-3xl mb-5 line-clamp-4"
        :innerHTML="description"
      ></h4>
      <RouterLink
        :to="
          '/tourist-attractions/' +
          place.title.replace(/\s+/g, '-').replace(/\n/g, ' ').toLowerCase()
        "
        class="text-sm px-2 py-1 text-white bg-primary rounded-md capitalize"
      >
        see more
        <i class="uil uil-angle-right" />
      </RouterLink>
    </div>
    <div
      class="flex-1 overflow-hidden"
      :class="{ 'sm:order-last': idx % 2 === 0, 'sm:order-first': idx % 2 !== 0 }"
    >
      <img :src="imgURL" :alt="'this is a picture of ' + place.title" class="w-full" />
    </div>
  </div>
</template>