<template>
  <div class="flex items-start border shadow-md p-3 my-2 rounded-lg cursor-pointer hover:bg-slate-100 bg-white">
    <div class="w-[50px] h-[50px] overflow-hidden mr-5 rounded-lg">
      <img class="w-full h-full" :src="imgSrc" alt="">
    </div>
    <div class="flex flex-col md:flex-row md:items-center justify-between w-full">
      <div>
        <h5 class="font-bold m-0">{{ title }}</h5>
        <p class="text-gray-500 text-sm">
          <span class="font-bold">{{ commentsCount }}</span>
          comments
        </p>
      </div>
      <p class="text-xs">{{ new Date() }}</p>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  imgSrc: String,
  commentsCount: Number
});
</script>