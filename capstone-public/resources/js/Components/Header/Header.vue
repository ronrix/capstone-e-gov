<template>
    <nav class="flex items-center justify-between gap-3 p-5 border border-t-0 border-x-0">
        <RouterLink to="/" class="uppercase font-['display'] font-[700] hover:text-primary">home</RouterLink>
        <NavLink to="/goverment" title="government" />
        <NavLink to="/tourism" title="tourism" />

        <!-- logo -->
        <img src="/images/BetterPilillaLogo-black.png" alt="this is a logo" class="w-32">

        <NavLink to="/business" title="business" />
        <NavLink to="/services" title="services" />
        <RouterLink to="/about" class="capitalize hover:text-primary">about</RouterLink>
        <i class="uil uil-search text-lg hover:text-primary cursor-pointer"></i>
    </nav>
</template>

<script setup>
import { RouterLink } from 'vue-router';
import NavLink from './NavLink.vue';

</script>
