<template>
    <div class="flex bg-white rounded-lg p-10 mb-5 flex-col md:flex-row w-full">
        <div class="flex-1" :class=" {'md:order-last': index === 1} ">
            <h4 class="text-xl md:text-2xl text-blue-500 font-semibold uppercase">logo</h4>
            <textarea cols="15" rows="1" class="text-2xl md:text-4xl font-extrabold text-red-800 mb-4 h-[40px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ seal?.title }}</textarea>
            <textarea rows="10" class="text-xs md:text-sm font-medium text-gray-800 justify-center items-center w-full focus:outline-blue-500 overflow-scroll no-scrollbar bg-white p-2 text-left">{{ seal?.subText }}</textarea>
        </div>

        <div class="flex-1 left-side flex flex-col items-center justify-center" :class=" {'md:order-first': index === 1} ">
            <img class="md:w-[400px]" :src="seal?.imgSrc" alt="this is an official seal">
        </div>
    </div>
</template>

<script setup>
defineProps({ seal: Object, index: Number });
</script>

<style lang="scss" scoped></style>