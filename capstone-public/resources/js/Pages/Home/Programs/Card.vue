<template>
    <div class="flex flex-col items-start gap-2 justify-between p-3 rounded-md" :class="additionalClass">
        <!-- icon -->
        <div class="rounded-full p-2 bg-white w-10 h-10 flex items-center justify-center">
            <i class="text-xl" :class="icon"></i>
        </div>

        <h5 class="font-bold text-lg">{{ title }}</h5>
        <p class="whitespace-pre-wrap text-sm">{{ desc }}</p>
        <RouterLink :to="to" class="flex items-center font-semibold hover:text-primarylight">
            Learn more
            <i class="uil uil-angle-right"></i>
        </RouterLink>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';

defineProps({
    title: String,
    desc: String,
    to: String,
    additionalClass: String,
    icon: String
})
</script>