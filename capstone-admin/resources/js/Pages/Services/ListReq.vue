<template>
    <div class="flex items-center mb-1 mt-2">
        <i class="uil uil-check text-2xl mr-1 text-[#48742C]"></i>
        <p class="text-base font-normal">{{ title }}</p>
    </div>
</template>

<script setup>
defineProps({title: String})
</script>

<style lang="scss" scoped></style>
