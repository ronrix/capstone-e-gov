<template>
  <div
    class="absolute z-20 top-20 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-500"
    :class="{ 'h-screen': subLinks, 'h-0': !subLinks }"
  >
    <div class="bg-white p-5" @mouseleave="closeSubLink">
      <WrapperContainer class="grid grid-cols-1 sm:grid-cols-2 gap-2">
        <RouterLink
          v-for="(sub, idx) in subLinks"
          :key="idx"
          :to="sub.link"
          class="hover:text-primarylight"
        >
          <span class="capitalize">{{ sub.title }}</span>
          <p class="text-xs text-gray-400">
            {{ sub.desc }}
          </p>
        </RouterLink>
      </WrapperContainer>
    </div>
    <!-- bottom backdrop blur  -->
    <div class="backdrop-blur-2xl bg-white/50 flex-1"></div>
  </div>
</template>

<script setup>
import { RouterLink } from 'vue-router'

defineProps({
  subLinks: { type: Array, required: true },
  closeSubLink: { type: Function, required: true }
})
</script>