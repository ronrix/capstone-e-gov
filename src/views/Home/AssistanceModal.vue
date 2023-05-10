<script setup>
import { onMounted, onUnmounted, ref } from 'vue'

const departments = ref()

onMounted(() => {
  document.body.classList.add('overflow-hidden')
  departments.value = JSON.parse(localStorage.getItem('services'))
})

onUnmounted(() => {
  document.body.classList.remove('overflow-hidden')
})

defineProps({
  showBenefit: { type: Function, required: true }
})
</script>

<template>
  <div
    class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-[500]"
  >
    <div
      class="relative flex flex-col pt-4 pb-5 px-5 w-[700px] overflow-y-auto scrollbar max-h-[500px] bg-white dark:bg-dark border rounded-lg"
    >
      <i
        class="absolute top-3 right-2 uil uil-times text-xl text-dark hover:text-gray-400 -mt-2 dark:text-white cursor-pointer"
        @click="showBenefit"
      ></i>
      <h1 class="text-darkgray dark:text-white font-bold text-xl mb-2">Services Available</h1>
      <div v-for="services in departments" :key="services.id" class="flex flex-col gap-2">
        <RouterLink
          v-for="(service, id) in services"
          :key="id"
          :to="'/services/' + service.replace(' ', '-')"
          class="w-full flex justify-between items-center border gap-2 rounded-b px-3 py-2"
        >
          <p class="tflex-1 text-dark dark:text-white font-normal capitalize">{{ service }}</p>
          <i
            class="uil uil-angle-right-b text-2xl text-dark hover:text-gray-600 dark:text-white cursor-pointer"
          ></i>
        </RouterLink>
      </div>
    </div>
  </div>
</template>