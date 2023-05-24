<template>
    <div class="bg-white text-center p-3 relative mt-3 rounded-md flex items-center">
        <!-- delete -->
        <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
            :handle-delete="handleDeleteOrdinance" :id="ordinance.id" />

        <!-- restore -->
        <RestoreVerificationModal v-if="isRestoreModal" :close-modal="showRestoreModal" :handle-restore="handleRestore"
            :id="ordinance.id" />

        <!-- restore button -->
        <div v-if="ordinance.deleted_at" @click="showRestoreModal"
            class="bg-blue-300 text-blue-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-blue-400 hover:text-blue-200 cursor-pointer">
            restore</div>

        <div v-else @click="showDeleteVerificationModal"
            class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
            delete</div>

        <div class="flex flex-col items-start justify-start">
            <h4 class="text-2xl font-bold my-3 capitalize">{{ ordinance.title }}</h4>
            <a v-if="ordinance" :href="be_url + '/' + ordinance?.pdf_path" class="text-blue-700" target="_blank">{{ be_url +
                '/' +
                ordinance?.pdf_path }}</a>
        </div>
        <button type="button" @click="showPreviewModal"
            class="bg-blue-600 text-white font-[500] px-3 rounded-md block ml-auto mr-0 mt-3 text-sm">Edit</button>

    </div>
    <!-- preview ordinance to edit -->
    <OrdinanceModal v-if="isPreviewModal" :close-modal="showPreviewModal" :handle-update-ordinance="handleUpdateOrdinance"
        :selected-data="ordinance" />
</template>
<script setup>
import { ref } from "vue";
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import RestoreVerificationModal from '../../../Components/RestoreVerificationModal.vue';
import OrdinanceModal from "./OrdinanceModal.vue";
import { be_url } from "../../../config/config";

// function to handle the delete 
const isVerificationModal = ref(false);
const isRestoreModal = ref(false);
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

const isPreviewModal = ref(false);
function showPreviewModal() {
    isPreviewModal.value = !isPreviewModal.value;
}

// function to handle the delete 
function showRestoreModal() {
    isRestoreModal.value = !isRestoreModal.value;
}

defineProps({
    handleUpdateOrdinance: Function,
    handleDeleteOrdinance: Function,
    ordinance: Object,
    handleRestore: Function
});
</script>
<style>
.pdf-viewer__header {
    z-index: 5;
}
</style>