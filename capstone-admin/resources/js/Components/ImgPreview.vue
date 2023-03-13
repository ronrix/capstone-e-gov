<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/50 flex items-center justify-center z-50">
    <!-- close modal btn -->

    <i @click="closeImgPreview" class="uil uil-times text-white hover:text-gray-800 text-3xl absolute top-0 right-2 cursor-pointer"></i>

    <img class="w-1/2" :src="imgSrc" alt="this is an image to preview">
  </div>
</template>

<script setup>
defineProps({ 
  imgSrc: String,
  closeImgPreview: Function
});
</script>