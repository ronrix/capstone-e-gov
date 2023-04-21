<template>
    <!-- list -->
    <div class="flex items-center gap-2 mt-2">
        <!-- soc med icons -->
        <i v-if="keyName === 'facebook'" class="uil uil-facebook text-3xl text-blue-600"></i>
        <i v-if="keyName === 'twitter'" class="uil uil-twitter text-3xl text-blue-400"></i>
        <i v-if="keyName === 'gmail'" class="uil uil-envelope text-3xl text-red-400"></i>
        <i v-if="keyName === 'youtube'" class="uil uil-youtube text-3xl text-red-600"></i>

        <input v-for="(link, arrId) in links" :key="link" :value="link"
            @change.capture="(e) => showEditVerification(e.target.value, id, keyName, arrId)" type="text"
            class="focus:outline-blue-500 border p-2 overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx] flex-1">
    </div>
</template>

<script setup>
defineProps({
    links: Array,
    keyName: String,
    showEditVerification: Function,
    id: Number
})
</script>

<style lang="scss" scoped></style>