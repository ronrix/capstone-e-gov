<template>
  <div class="flex items-center justify-center flex-col gap-2">
    <RouterLink
      to="/news"
      class="flex items-center px-3 rounded-full bg-primary py-1 text-white font-bold text-xs"
    >
      <span class="px-2 bg-white rounded-full text-darkgray mr-3">news</span>
      check this out
      <i class="uil uil-arrow-right" />
    </RouterLink>

    <h3 class="text-center font-['display'] text-5xl sm:w-1/2 text-darkgray mt-5 dark:text-bggray">
      Apply for assistance in as little as 15 minutes
    </h3>
    <p class="text-center text-sm dark:text-bggray">
      We help connect families to benefits and services that faster health, safety, resilience, and
      opportunity and help them to meet a wide variety of needs.
    </p>

    <!-- buttons -->
    <div class="flex items-center gap-5 mt-5">
      <button
        class="text-sm sm:text-base px-3 py-2 bg-primary font-bold hover:bg-primarylight text-white rounded-md shadow-lg shadow-primarylight/50"
      >
        Apply for Benefits
      </button>
    </div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>