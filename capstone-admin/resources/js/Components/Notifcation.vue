<template>
    <div v-if="isMounted" class="fixed top-10 right-10 p-5 shadow-lg text-white"
        :class="{ active: msg?.status >= 400, 'bg-red-500': msg?.status >= 200, 'bg-green-500': msg?.status < 300 }">
        <h2>{{ msg.msg }}</h2>
    </div>
</template>

<script setup>
defineProps({
    msg: Object,
    isMounted: Boolean,
});


</script>