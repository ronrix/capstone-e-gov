<template>
    <nav class="flex items-center justify-between gap-3 p-5 border border-t-0 border-x-0">
        <RouterLink to="/" class="uppercase font-['display'] font-[700] hover:text-primary">home</RouterLink>
        <RouterLink to="/government" class="capitalize font-['Playfair Display SC'] hover:text-primary">
            government
            <i class="uil uil-angle-down"></i>
        </RouterLink>
        <RouterLink to="/tourism" class="capitalize font-['Playfair Display SC'] hover:text-primary">
            tourism
            <i class="uil uil-angle-down"></i>
        </RouterLink>

        <!-- logo -->
        <img src="/images/BetterPilillaLogo-black.png" alt="this is a logo" class="w-32">

        <RouterLink to="/business" class="capitalize font-['Playfair Display SC'] hover:text-primary">
            business
            <i class="uil uil-angle-down"></i>
        </RouterLink>
        <RouterLink to="/services" class="capitalize font-['Playfair Display SC'] hover:text-primary">
            services
            <i class="uil uil-angle-down"></i>
        </RouterLink>
        <RouterLink to="/about" class="capitalize hover:text-primary">about</RouterLink>
        <i class="uil uil-search text-lg hover:text-primary cursor-pointer"></i>
    </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router';

</script>
