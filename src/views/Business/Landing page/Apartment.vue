<script setup>
defineProps({
  apartment: { type: Object, required: true },
  idx: { type: Number, required: true }
})
</script>

<template>
  <div class="mx-10 flex items-center mt-1 gap-10">
    <img
      class="flex-1 w-1/2 h-[350px] rounded-lg"
      :src="apartment?.imgSrc"  :class="{ 'order-first': idx % 2 === 0, 'order-last': idx % 2 !== 0 }"
    />
    
    <div
      class="flex flex-col flex-1 gap-2" :class="{ 'order-last': idx % 2 === 0, 'order-first': idx % 2 !== 0 }"
    >
      <p class="text-2xl font-semibold text-dark dark:text-white">Location at:</p>
      <div class="flex items-center">
        <i class="uil uil-map-marker text-red-700 text-2xl"></i>
        <span class="text-lg font-light text-dark dark:text-white">{{ apartment?.location }}</span>
      </div>
      <button class="w-20 bg-primary p-1 rounded-md text-white text-sm mt-5 hover:bg-primarylight">
        View
        <i class="uil uil-angle-right"></i>
      </button>
    </div>
  </div>
</template>


<style lang="scss" scoped>
</style>