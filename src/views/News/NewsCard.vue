<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <div
    class="flex items-center justify-center hover:shadow-lg p-5 px-2 hover:scale-[1.010] cursor-pointer"
  >
    <!-- left -->
    <div class="flex-1 flex flex-col items-start gap-2">
      <div>
        <h5 class="font-bold text-dark dark:text-bggray">By James Lindale</h5>
        <p class="flex items-center text-xs text-secondary">
          <i class="uil uil-clock-five"></i>
          <span>3 days ago</span>
        </p>
      </div>
      <h3 class="font-bold text-2xl text-dark dark:text-bggray">
        Ukraine war: Five ways Russia's Invasion may play out
      </h3>
      <p class="text-sm text-secondary line-clamp-3">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestias quos aspernatur ab,
        voluptate porro nam cupiditate fuga id debitis culpa nobis. Deserunt est pariatur, ducimus
        aperiam dolorum cum soluta dicta?
      </p>
      <RouterLink
        to="/news/ukraine-war-five-ways-russia's-invasion-may-play-out"
        type="button"
        class="font-bold text-dark capitalize text-sm hover:text-primarylight dark:text-bggray"
      >
        read more
      </RouterLink>
    </div>

    <!-- right -->
    <div class="flex-1 overflow-hidden">
      <img
        class="w-full object-cover"
        src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse3.mm.bing.net%2Fth%3Fid%3DOIP.2AO-iGsufqcofTcW4lbwIgHaEK%26pid%3DApi&f=1&ipt=07fa597ae5acf7f28cf39ae0b51a53b91977e5ba11feffe615dafbe9f071a087&ipo=images"
        alt=""
      />
    </div>
  </div>
</template>