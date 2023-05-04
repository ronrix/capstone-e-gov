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
        class="uil uil-multiply text-dark hover:text-secondary dark:text-white dark:hover:text-secondary text-xl self-end -mb-5 cursor-pointer"
        @click="showPermitModal"
      ></i>
      <!-- content modal -->
      <div class="flex flex-col">
        <div
          class="flex items-center mb-3 border border-gray-500 border-x-0 border-t-0 border-b-2 pb-2"
        >
          <i
            class="uil uil-map-marker text-primary dark:text-primarylight text-2xl md:text-3xl"
          ></i>
          <h2
            class="text-gray-800 dark:text-gray-400 font-bold text-sm sm:text-xl md:text-2xl mb-1 capitalize"
          >
            {{ data?.location }}
          </h2>
        </div>
        <div class="flex items-center gap-52">
          <!-- requiements -->
          <div>
            <h2 class="text-gray-800 dark:text-white font-semibold text-sm sm:text-lg mb-1">
              Requirements
            </h2>
            <div class="flex items-center mb-1">
              <span class="text-sm sm:text-base text-gray-800 dark:text-gray-200">{{
                data.req
              }}</span>
            </div>
          </div>
          <!-- where to go -->
          <div>
            <h2 class="text-gray-800 dark:text-white font-semibold text-sm sm:text-lg mb-1">
              Where to go?
            </h2>
            <div class="flex items-center mb-1">
              <span class="text-sm sm:text-lg text-gray-800 dark:text-gray-200">{{
                data?.goTo
              }}</span>
            </div>
          </div>
        </div>
      </div>
      <!-- client steps -->
      <div class="flex flex-col">
        <h2 class="text-gray-800 dark:text-white font-bold text-sm sm:text-lg mb-1">
          Client steps
        </h2>
        <div class="flex flex-col">
          <div v-for="steps in data.steps" :key="steps" class="flex items-center mb-1">
            <i class="uil uil-check mr-2 text-green-600 text-xl"></i>
            <span class="text-sm sm:text-lg text-gray-800 dark:text-gray-200">{{ steps }}</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>