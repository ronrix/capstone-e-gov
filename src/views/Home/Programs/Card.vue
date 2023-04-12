<template>
  <div
    class="flex flex-col items-start gap-2 justify-between p-3 rounded-md"
    :class="additionalClass"
  >
    <!-- icon -->
    <div class="rounded-full p-2 bg-white w-10 h-10 flex items-center justify-center">
      <i
        class="text-xl"
        :class="icon"
      />
    </div>

    <h5 class="font-bold text-base sm:text-lg">
      {{ title }}
    </h5>
    <p class="whitespace-pre-wrap text-xs sm:text-sm">
      {{ desc }}
    </p>
    <RouterLink
      :to="to"
      class="text-xs sm:text-smflex items-center font-semibold hover:text-primarylight"
    >
      Learn more
      <i class="uil uil-angle-right" />
    </RouterLink>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

defineProps({
    title: { type: String, required: true },
    desc: { type: String, required: true },
    to: { type: String, required: true },
    additionalClass: { type: String, required: true },
    icon: { type: String, required: true }
})
</script>