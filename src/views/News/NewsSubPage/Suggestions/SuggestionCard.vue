<script setup>
import { RouterLink } from 'vue-router'
</script>
<template>
  <RouterLink
    to="/news/something"
    class="flex flex-col items-start border border-x-0 border-t-0 py-3 gap-2 group cursor-pointer border-secondary"
  >
    <p class="flex items-center text-xs text-secondary group-hover:text-white">
      <i class="uil uil-clock-five"></i>
      <span>3 days ago</span>
    </p>
    <h3 class="font-bold text-xl text-dark dark:text-bggray">
      Ukraine war: Five ways Russia's Invasion may play out
    </h3>
    <p class="text-xs text-secondary line-clamp-3 group-hover:text-white">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias quos aspernatur ab,
      voluptate porro nam cupiditate fuga id debitis culpa nobis. Deserunt est pariatur, ducimus
      aperiam dolorum cum soluta dicta?
    </p>
  </RouterLink>
</template>