<template>
  <div
    class="absolute z-20 top-14 md:top-20 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-700"
    :class="{ 'h-screen': subLinks, 'h-0': !subLinks }"
  >
    <div
      class="bg-white dark:bg-dark p-5 min-h-[400px] max-h-[400px] overflow-y-auto"
      @mouseleave="closeSubLink"
    >
      <WrapperContainer class="grid grid-cols-1 sm:grid-cols-2 gap-2">
        <RouterLink
          v-for="(sub, idx) in subLinks"
          :key="idx"
          :to="sub.link"
          class="hover:text-primarylight text-dark dark:text-bggray dark:hover:text-primarylight my-3"
        >
          <span class="capitalize">{{ sub.title }}</span>
          <p class="text-xs text-secondary">
            {{ sub.desc }}
          </p>
        </RouterLink>
      </WrapperContainer>
    </div>
    <!-- bottom backdrop blur  -->
    <div class="backdrop-filter bg-white/50 dark:bg-dark/50 h-full"></div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  subLinks: { type: Array, required: true },
  closeSubLink: { type: Function, required: true }
})
</script>