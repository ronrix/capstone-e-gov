<template>
    <div v-if="msg?.status" class="fixed top-10 right-10 p-5 shadow-lg text-white flex items-center justify-start"
        :class="{ 'bg-red-500': msg?.status >= 400, 'bg-green-500': msg?.status >= 200 && msg?.status < 300 }">
        <i class="uil uil-info-circle text-white text-xl mr-3"></i>
        <h2>{{ msg.msg }}</h2>
    </div>
</template>

<script setup>
defineProps({
    msg: Object,
});


</script>