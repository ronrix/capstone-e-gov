<template>
    <div class="flex justify-between items-center mb-1 mt-2">
        <div class= "flex flex-row items-center">
            <i class="uil uil-check text-2xl mr-1 text-[#48742C]"></i>
            <p class="text-base font-normal">{{ title }}</p>
        </div> 
        <div class ="mr-5">
            <i class="uil uil-edit-alt ml-3 mr-2 text-base pointer-events-none"></i>
        </div>
        
    </div>
</template>

<script setup>
defineProps({title: String})
</script>

<style lang="scss" scoped></style>
