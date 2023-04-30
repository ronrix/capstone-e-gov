<script setup>

defineProps({
  data: { type: Object, required: true },
  showPermitModal: { type: Function, required: true }
})
</script>

<template>
  <div
    class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-[500]"
  >
    <div class="flex flex-col gap-5 bg-white dark:bg-dark w-[800px] rounded-lg px-5 pt-2 pb-5">
      <i
        class="uil uil-multiply text-dark hover:text-secondary dark:text-white dark:hover:text-secondary text-xl self-end -mb-3 cursor-pointer"
        @click="showPermitModal"
      ></i>
      <!-- checklist requirement -->
     <div class="flex flex-col">
        <h2 class="text-gray-800 dark:text-gray-200 font-bold text-sm sm:text-lg mb-1">
          What's the requirements?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div class="flex items-center mb-1">
            <i class="uil uil-check mr-2 text-green-600 dark:text-green-400 text-xl"></i>
            <span class="text-sm sm:text-lg text-gray-800 dark:text-gray-200">{{ data.name }}</span>
          </div>
        </div>
      </div>
      <!-- client steps -->
      <div class="flex flex-col">
        <h2 class="text-gray-800 dark:text-gray-200 font-bold text-sm sm:text-lg mb-1">
          Client steps
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-2">
          <div v-for="req in data.requirements" :key="req" class="flex items-center mb-1">
            <i class="uil uil-check mr-2 text-green-600 text-xl"></i>
            <span class="text-sm sm:text-lg text-gray-800 dark:text-gray-200">{{ req }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>