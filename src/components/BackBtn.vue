<script setup>
</script>
<template>
  <button
    class="mt-10 font-semibold text-sm flex items-center gap-2 text-dark dark:text-bggray hover:text-primarylight dark:hover:text-primarylight"
    type="button"
    @click="$router.back()"
  >
    <i class="fa-solid fa-angle-left"></i>
    Back
  </button>
</template>