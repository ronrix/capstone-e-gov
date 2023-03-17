<template>  
    <div class="flex justify-start items-center gap-2">
        <span class="text-sm font-sm text-gray-800"><textarea class="w-[125px] h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ third?.week }}</textarea></span>
        <span class="text-sm font-sm text-gray-800"><textarea class="w-[125px] h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ third?.time }}</textarea></span>
    </div>
       
</template>

<script setup>
defineProps({ third: Object })
</script>

<style scoped>

</style>