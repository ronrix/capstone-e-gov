<script setup>
defineProps({
  selectedSubLinks: { type: Array, required: true },
  isShowMobileNav: { type: Boolean, required: true },
  goBackToMainNavs: { type: Function, required: true }
})
</script>

<template>
  <div
    class="fixed z-20 top-0 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-700 bg-white dark:bg-dark delay-300 h-screen z-100 overflow-y-auto"
    :class="{
      'translate-x-0 opacity-100': selectedSubLinks,
      'translate-x-full opacity-0': !selectedSubLinks
    }"
  >
    <!-- back button -->
    <i
      class="uil uil-angle-left text-4xl text-gray-900 dark:text-bggray dark:hover:text-white hover:text-black cursor-pointer self-start"
      @click="goBackToMainNavs"
    />

    <div class="pt-8 px-5 flex flex-col gap-3">
      <RouterLink
        v-for="(sub, idx) in selectedSubLinks"
        :key="idx"
        :to="sub.link"
        class="text-3xl text-dark dark:text-bggray dark:hover:text-white hover:text-black my-3 capitalize"
      >
        {{ sub.title }}
      </RouterLink>
    </div>
  </div>
</template>