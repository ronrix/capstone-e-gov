<template>
    <RouterLink :to="to" class="capitalize hover:text-primary">
        {{ title }}
        <i class="uil uil-angle-down"></i>
    </RouterLink>
</template>

<script setup>
defineProps({
    title: String,
    to:  String
});
</script>