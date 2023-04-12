<template>
  <div class="flex flex-col sm:flex-row p-5 items-start xl:items-center justify-evenly gap-5">
    <div
      class="flex-1"
      :class="{ 'sm:order-first': idx % 2 === 0, 'sm:order-last sm:text-end': idx % 2 !== 0 }"
    >
      <h3 class="text-xl sm:text-4xl font-bold">
        {{ place.title }}
      </h3>
      <h6 class="text-sm mb-2">
        Located at
        <span class="text-primarylight font-bold">
          <i class="uil uil-map-marker-question" />
          {{ place.location }}
        </span>
      </h6>
      <h4 class="font-['display'] text-lg sm:text-3xl mb-5">
        {{ place.qoute }}
      </h4>
      <RouterLink to="/" class="text-sm px-2 py-1 text-white bg-primary rounded-md capitalize">
        see more
        <i class="uil uil-angle-right" />
      </RouterLink>
    </div>
    <div
      class="flex-1 overflow-hidden"
      :class="{ 'sm:order-last': idx % 2 === 0, 'sm:order-first': idx % 2 !== 0 }"
    >
      <img :src="place.imgSrc" alt="this is a picture of pililla wind farm" class="w-full" />
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  place: { type: Object, required: true },
  idx: { type: Number, required: true }
})
</script>
