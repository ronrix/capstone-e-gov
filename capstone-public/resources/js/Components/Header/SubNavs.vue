<template>
    <div class="absolute top-full left-0 w-full p-3 bg-white shadow-md z-30 border duration-100 scale-0 grid grid-cols-2 gap-5 transform origin-top-left">
        <RouterLink v-for="sub in subLinks" :to="sub.link" class="hover:text-primarylight">
            <span class="capitalize">{{ sub.title }}</span>
            <p class="text-xs text-gray-400">{{ sub.desc }}</p>
        </RouterLink> 
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

defineProps({
    subLinks: Array,
});
</script>