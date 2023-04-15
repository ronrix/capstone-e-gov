<script setup>
defineProps({
    name : { type : String, required: true}
})
</script>

<template>
        <div class="flex flex-row items-center gap-3">
            <i class="uil uil-check text-2xl text-green-700"></i>
            <p class="text-gray-600 text-lg font-medium">{{ name }}</p>
        </div> 
</template>



<style lang="scss" scoped>
</style>