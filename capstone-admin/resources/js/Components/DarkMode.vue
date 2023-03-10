
<template>
    <div class="fixed right-0 top-0 p-5 flex items-center text-white">
        <i @click="toggleDarkMode" class="fa-solid " :class="[darkMode ? 'fa-sun' : 'fa-moon text-black']"></i>
    </div>
</template>

<script setup>
defineProps({
    toggleDarkMode: Function,
    darkMode: Boolean
}) 
</script>