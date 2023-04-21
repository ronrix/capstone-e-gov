<template>
    <div class="flex-1 w-full flex items-center gap-2">
        <span class="text-xs font-bold text-gray-800">{{ type }}</span>
        <input @change.capture="(e) => showEditVerification(e.target.value, id, type)" v-model="number"
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            maxlength="11"
            class="focus:outline-blue-500 py-1 w-full overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx] border" />
    </div>
</template>

<script setup>
defineProps({
    id: Number,
    showEditVerification: Function,
    type: String,
    number: String
});
</script>