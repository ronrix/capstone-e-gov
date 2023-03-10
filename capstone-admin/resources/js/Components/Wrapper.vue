<template>
    <div  class="dark:bg-primary-dark light:bg-white h-screen w-screen">
        <DarkMode :toggleDarkMode="toggleDarkMode" :darkMode="darkMode" />
        <slot></slot>
    </div>
</template>

<script setup>
defineProps({
    toggleDarkMode: Function,
    darkMode: Boolean,
})
</script>