<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center">
    <div class="bg-white w-[700px] p-5 rounded-lg relative">
      <div @click="showNewsModal" class="m-0 p-0 cursor-pointer">
        <i class="uil uil-times text-gray-800 hover:text-blue-800 text-xl absolute top-0 right-2 p-2"></i>
      </div>
      <h4 class="font-bold text-2xl flex items-center">
        <span class="cursor-pointer">{{ selectedData.title }}</span>
        <i class="uil uil-edit-alt ml-3 text-base"></i>
      </h4>
      <h5 class="text-xs text-gray-500 font-bold">{{ new Date() }}</h5>
      <p class="text-sm mt-5 cursor-pointer">
        {{ selectedData.content }}
        <i class="uil uil-edit-alt ml-3 text-base"></i>
      </p>

      <div class="flex items-end justify-end mt-10">
        <button class="px-4 p-1 border border-blue-600">cancel</button>
        <button class="px-4 p-1 bg-blue-600 ml-3 text-white">save</button>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  showNewsModal: Function,
  selectedData: {}
});

</script>