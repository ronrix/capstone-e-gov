<template>
    <div v-if="isMounted" class="fixed top-10 right-10 p-5 shadow-lg text-white"
        :class="{ active: errorMsg?.status >= 400, 'bg-red-500': errorMsg?.status >= 200, 'bg-green-500': errorMsg?.status < 300 }">
        <h2>{{ errorMsg.msg }}</h2>
    </div>
</template>

<script setup>
defineProps({
    errorMsg: Object,
    isMounted: Boolean,
});


</script>