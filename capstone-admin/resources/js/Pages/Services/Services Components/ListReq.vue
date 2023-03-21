<template>
    <div class="flex justify-between items-center mb-1 mt-2">
        <div class= "flex flex-row items-center">
            <i class="uil uil-check text-2xl mr-1 text-[#48742C]"></i>
            <p class="text-base font-normal ml-4"><textarea class="h-[25px]
                focus:outline-blue-500 overflow-scroll no-scrollbar">{{ title }}</textarea></p>
        </div>      
    </div>
</template>

<script setup>
defineProps({title: String})
</script>

<style lang="scss" scoped></style>
