<template>
 <div class="flex flex-col lg:flex-row justify-between mt-5  gap-1 lg:gap-5 w-full p-0 bg-white border-y-0 border-l-[6px] border-l-blue-600"> 
        <!-- image -->
    <img class="h-[300px] max-h-[400px] w-full lg:w-[400px]" :src="data?.imgSrc" alt="this is bulawan resort" :class="{'order-first lg:order-last': index === 1, 'order-first': index === 0}">
        <!-- content -->
     <div class="flex-1 px-5 pt-5 flex flex-col justify-between" :class=" {'order-last lg:order-first': index === 1, 'order-last': index === 0} ">
          <h3 class="font-bold capitalize text-xl tracking-wide">{{data?.title}}</h3>
          <p class="mt-5 text-sm h-[100px] overflow-hidden">{{data?.description}}</p>

          <!-- button view -->
          <button
          class="w-[70px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5 lg:mt-10">view
        </button>
      </div>
 </div>
</template>

<script setup>
defineProps({ data : Object, index : Number });
</script>

<style scoped>

</style>