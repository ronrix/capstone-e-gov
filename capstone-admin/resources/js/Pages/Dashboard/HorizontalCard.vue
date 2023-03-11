<template>
  <div class="border shadow-md p-3 my-2 flex items-center rounded-lg cursor-pointer hover:bg-slate-100">
    <div class="w-[50px] h-[50px] overflow-hidden mr-5 rounded-lg">
      <img class="w-full h-full" :src="imgSrc" alt="">
    </div>
    <div class="flex justify-between w-full">
      <div>
        <h5 class="font-bold m-0">{{ title }}</h5>
        <p class="text-gray-500 text-sm">
          <span class="font-bold">{{ commentsCount }}</span>
          comments
        </p>
      </div>
      <p>{{ new Date() }}</p>
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