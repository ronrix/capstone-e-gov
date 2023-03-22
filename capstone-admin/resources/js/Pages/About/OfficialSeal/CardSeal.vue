<template>
    <div class= "w-full flex flex-col md:flex-col lg:flex-row gap-1 bg-white rounded-lg p-10 mb-5  items-center">
        <div class="flex-1 text-center md:text-left" :class=" {'order-last': index === 1, 'md:order-last lg:order-first': index ===0}">
            <h4 class="text-xl md:text-2xl text-blue-500 font-semibold uppercase">Logo</h4>
            <textarea class="text-2xl md:text-4xl text-center md:text-left font-extrabold text-red-800 mb-0 lg:mb-4 h-[40px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ seal?.title }}</textarea>
            <textarea class="h-[300px] md:h-[180px] lg:h-[150px] md:text-sm font-medium text-gray-800 justify-center items-center w-full focus:outline-blue-500 overflow-scroll no-scrollbar bg-white p-2 text-left">{{ seal?.subText }}</textarea>
        </div>

        <div class="items-center justify-center mb-6 lg:mb-0" :class=" {'order-first': index === 1, 'md:order-first lg:order-last': index ===0} ">
            <img class="w-[250px] md:w-[300px] lg:w-[350px]" :src="seal?.imgSrc" alt="this is an official seal">
        </div>
    </div>
</template>

<script setup>
defineProps({ seal: Object, index: Number });
</script>

<style lang="scss" scoped></style>