<template>
    <div
        class="relative bg-white p-2 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden shadow-md">
        <!-- restore button -->
        <div v-if="data.deleted_at" @click="showRestoreModal"
            class="bg-blue-300 text-blue-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-blue-400 hover:text-blue-200 cursor-pointer">
            restore</div>

        <!-- delete button -->
        <div v-else @click="showDeleteVerificationModal"
            class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
            delete</div>

        <!-- restore -->
        <RestoreVerificationModal v-if="isRestoreModal" :close-modal="showRestoreModal" :handle-restore="handleRestore"
            :id="data.id" />

        <!-- delete -->
        <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
            :handle-delete="handleDelete" :id="data.id" />

        <!-- image -->
        <div class="flex-1 flex flex-col gap-3 items-start justify-between ">
            <div class="img-hover-zoom-slide h-[300px] w-full">
                <img class="h-[300px] max-h-[400px] w-full object-cover" :src="imgSrc">
            </div>
            <div v-if="data.location" class="flex">
                <i style="margin-top: 2px;" class="mr-2 uil uil-location-point text-cyan-400"></i>
                <p class="text-ellipsis overflow-hidden pt-1 text-[12px] capitalize">{{ data.location }}</p>
            </div>
        </div>
        <!-- content -->
        <div class="flex-1 px-5 pt-5 flex flex-col items-start justify-between gap-3">
            <div>
                <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
                <h5 class="text-sm text-gray-600 font-bold capitalize">By {{ data.authors }}</h5>
            </div>
            <p class="text-xs overflow-hidden whitespace-pre-wrap h-[100px] marked-desc" v-bind:innerHTML="description"></p>
            <!-- PreviewButton -->
            <button @click="showTourismModal(data)"
                class="active:-translate-y-[1px] mb-2 rounded-md bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">
                view
            </button>
        </div>
    </div>
</template>
<script setup>
import { formatImgs } from '../../utils/formatImgs';

import { ref } from 'vue';
import { marked } from "marked";
import DOMPurify from 'dompurify';
import RestoreVerificationModal from '../../Components/RestoreVerificationModal.vue';
import DeleteVerificationModal from '../../Components/DeleteVerificationModal.vue';

const imgSrc = formatImgs(data.img_link.split(","))[0];
const description = DOMPurify.sanitize(marked.parse(data.description));

const isVerificationModal = ref(false);
const isRestoreModal = ref(false);
// function to handle the delete 
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

// function to handle the delete 
function showRestoreModal() {
    isRestoreModal.value = !isRestoreModal.value;
}

const { data } = defineProps({
    showTourismModal: Function,
    data: Object,
    handleDelete: Function,
    handleRestore: Function,
});
</script>
<style scope></style>