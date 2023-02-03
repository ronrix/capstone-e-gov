<template>
    <div class="fixed top-10 right-10 p-5 shadow-lg text-white" :class="{active: status >= 400 , 'bg-red-500' : status >= 200,  'bg-green-500' : status < 300 }">
        <h2>{{ msg }}</h2>
    </div>
</template>

<script setup>
    import { defineProps } from 'vue';

    defineProps({
        status: Number,
        msg: String,
    });


</script>