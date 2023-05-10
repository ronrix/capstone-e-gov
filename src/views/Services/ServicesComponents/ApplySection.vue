<script setup>
import { be_url } from '../../../assets/config/config'

function copyToClipboard(e) {
  navigator.clipboard.writeText(e.target.textContent)
}

defineProps({
  service: { type: Object, required: true }
})
</script>
<template>
  <div id="#apply">
    <h4 class="capitalize text-xl md:text-2xl text-dark dark:text-bggray font-bold">
      To apply for this service
    </h4>
    <p class="text-dark dark:text-bggray">
      Download the application form
      <a :href="be_url + '/' + service?.application_form" class="text-primarylight" target="_blank"
        >here</a
      >
      and fill it up then send the pdf version of it to
      <span
        title="copy"
        class="text-primarylight cursor-pointer hover:bg-primarylight hover:text-bggray"
        @click="copyToClipboard"
        >{{ service?.email }}</span
      >
    </p>
  </div>
</template>