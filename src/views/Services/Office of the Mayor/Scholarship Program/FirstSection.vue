<script setup>
defineProps({
    name : {type: String, required: true}
})
</script>
<template>
    <div class="bg-white dark:bg-dark lg p-10">
    <div class="flex flex-col relative">
      <h1
        class="w-full mt-0.5 ml-4 text-dark dark:text-white py-0 px-4 font-bold text-3xl before:absolute before:w-[4px] before:h-[75px] before:bg-red-500 before:-left-1 before:top-2"
      >
        Where to go?
      </h1>
      <div class="w-6 h-6 rounded-full bg-red-500 absolute top-1.5 -left-3.5"></div>
      <i class="uil uil-map-marker text-red-500 text-4xl absolute top-20 -left-5"></i>
      <h2 class="text-red-600 mt-11 ml-8 text-2xl font-bold">{{ name }}</h2>
    </div>
  </div>
</template>



<style lang="scss" scoped>

</style>