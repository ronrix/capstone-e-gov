<script setup>
defineProps({
  data: { type: Object, required: true }
})

</script>
<template>
  <div class="sm:mt-5 h-[300px] lg:h-[400px] relative mx-2 md:mx-10 ">
    <img class="opacity-50 absolute  -z-10 left-0 right-0 w-screen h-full" :src="data?.imgSrc" alt="this is hero picture for services" />
    <div class="flex flex-col items-center">
      <h1 class="text-3xl md:text-4xl text-primary font-bold text-center ml-10 mt-36 uppercase">
      {{ data?.name }}
      </h1>
    </div>
  </div>
</template>

<style lang="scss" scoped>
</style>