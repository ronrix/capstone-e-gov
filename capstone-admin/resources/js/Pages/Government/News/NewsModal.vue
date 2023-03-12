<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center">
    <div class="bg-white w-[700px] p-5 rounded-lg relative">
      <div @click="showNewsModal" class="m-0 p-0 cursor-pointer">
        <i class="uil uil-times text-gray-800 hover:text-blue-800 text-xl absolute top-0 right-2 p-2"></i>
      </div>
      <h4 class="font-bold text-2xl">this is the news modal</h4>
    </div>
  </div>
</template>

<script setup>
defineProps({
  showNewsModal: Function
})
</script>