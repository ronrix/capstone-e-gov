<template>
        <div class="flex items-center">
            <i class="text-2xl text-gray-700 mr-4 uil uil-facebook-f"></i>
            <p class="text-sm font-medium text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ second?.fb }}</textarea></p>
        </div>   
        <div class="flex items-center">
            <i class="text-2xl text-gray-700 mr-4 uil uil-envelopes"></i>
            <p class="text-sm font-sm text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ second?.gmail }}</textarea></p>
        </div>
        <div class="flex items-center">
            <i class="text-2xl text-gray-700 mr-4 uil uil-twitter-alt"></i>
            <p class="text-sm font-sm text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ second?.twitter }}</textarea></p>
        </div>     
</template>

<script setup>
defineProps({ second: Object })
</script>

<style lang="scss" scoped>

</style>