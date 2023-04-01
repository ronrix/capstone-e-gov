<template>
    <div class="flex justify-between items-center mb-1 mt-2">
        <div class="flex flex-row items-center">
            <i class="uil uil-check text-2xl mr-1 text-[#48742C]"></i>
            <p class="text-base font-normal ml-4">{{ title }}</p>
        </div>
        <button class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button>
    </div>
</template>

<script setup>
defineProps({ title: String })
</script>

<style lang="scss" scoped></style>
