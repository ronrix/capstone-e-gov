<script setup>
import { RouterLink } from 'vue-router'

const news = [
  {
    id: 1,
    title: 'The Juice mission will soon launch to Jupiter’s icy ocean worlds',
    img_link:
      'https://media.cnn.com/api/v1/images/stellar/prod/230412192103-04-esa-juice-mission.jpg?c=16x9&q=h_540,w_960,c_fill/f_webp'
  },
  {
    id: 2,
    title: 'Analysis: ‘Tone deaf’ Macron faces backlash over Taiwan comments',
    img_link:
      'https://media.cnn.com/api/v1/images/stellar/prod/230406060125-02-macron-xi-meeting-040623.jpg?c=16x9&q=h_540,w_960,c_fill/f_webp'
  },
  {
    id: 3,
    title:
      'Fear and confusion in Japan’s Hokkaido as North Korean missile triggers evacuation order',
    img_link:
      'https://media.cnn.com/api/v1/images/stellar/prod/230412195003-j-alert-north-korea-missile-041223.jpg?c=16x9&q=h_540,w_960,c_fill/f_webp'
  }
]
</script>
<template>
  <div class="flex flex-col items-center justify-center">
    <h5 class="font-bold text-xs capitalize text-dark dark:text-bggray">news</h5>
    <h4 class="capitalize text-3xl text-dark dark:text-bggray font-bold">
      <span class="text-primarylight">hot </span> topic current
      <span class="text-primarylight">news</span>
    </h4>

    <div class="flex items-center">
      <div
        v-for="n in news"
        :key="n.id"
        class="p-5 flex flex-col justify-end mt-5 h-[500px] w-full bg-no-repeat bg-cover group overflow-hidden"
        :style="{ backgroundImage: 'url(' + n.img_link + ')' }"
      >
        <div
          class="duration-500 translate-y-10 opacity-0 group-hover:opacity-100 group-hover:translate-y-0 flex flex-col items-start"
        >
          <h3 class="font-bold text-3xl text-white w-3/4">
            The Juice mission will soon launch to Jupiter’s icy ocean worlds
          </h3>
          <RouterLink
            :to="'/news/' + n.title"
            type="button"
            class="bg-white px-3 py-1 font-bold text-dark capitalize rounded-md flex items-center active:-translate-y-1 mt-5"
          >
            read more
            <i class="uil uil-angle-right"></i>
          </RouterLink>
        </div>
      </div>
    </div>
  </div>
</template>