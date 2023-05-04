<script setup>
defineProps({
  showBenefit: { type: Function, required: true }
})
</script>

<template>
  <div
    class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-[500]"
  >
    <div
      class="relative flex flex-col pt-4 pb-5 px-5 w-[700px] overflow-y-scroll scrollbar max-h-[500px] bg-white dark:bg-dark border rounded-lg"
    >
      <i
        class="absolute top-3 right-2 uil uil-times text-xl text-dark hover:text-gray-400 -mt-2 dark:text-white"
        @click="showBenefit"
      ></i>
      <h1 class="text-darkgray dark:text-white font-bold text-xl mb-2">Services available</h1>
      <hr class="border border-gray-200" />
      <div class="flex flex-col">
        <div
          class="w-full flex justify-between items-center border gap-2 border-gray-300 rounded-b px-3 py-2"
        >
          <p class="tflex-1 text-dark dark:text-white font-normal capitalize">
            educational assistance for students
          </p>
          <i
            class="uil uil-angle-right-b text-2xl text-dark hover:text-gray-600 dark:text-white cursor-pointer"
          ></i>
        </div>
        <div
          class="w-full flex justify-between items-center border gap-2 border-gray-300 rounded-b px-3 py-2"
        >
          <p class="flex-1 text-dark dark:text-white font-normal capitalize">
            educational assistance for students
          </p>
          <i
            class="uil uil-angle-right-b text-2xl text-dark hover:text-gray-600 dark:text-white cursor-pointer"
          ></i>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>