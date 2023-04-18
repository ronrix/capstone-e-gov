<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-start justify-center z-30">
        <div ref="refModal"
            class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border animate-slideDown duration-75">
            <h4 class="font-bold text-center">Are you sure you want to save this?</h4>
            <div class="flex items-center justify-center mt-3 gap-2">
                <button @click="closeModal"
                    class="whitespace-pre-wrap px-3 bg-gray-300 rounded-md py-1 hover:bg-gray-500 hover:text-white">No, i
                    don't want to save this.</button>
                <button @click="handleEdit(data.value, data.id, data.type)"
                    class="whitespace-pre-wrap px-3 bg-green-300 text-green-700 rounded-md py-1 hover:text-green-300 hover:bg-green-700 duration-75">Yes,
                    i want to save this.</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';

const refModal = ref();
onMounted(() => {
    refModal.value.classList.add("translate-y-0");
});

defineProps({
    closeModal: Function,
    handleEdit: Function,
    data: Object
});
</script>

<style>
.animate-slideDown {
    animation: slideDown 0.5s ease-out;
}

@keyframes slideDown {
    0% {
        transform: translateY(-100%);
    }

    100% {
        transform: translateY(0);
    }
}
</style>