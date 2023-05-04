<template>
    <div class="bg-white text-center p-3 relative mt-3 rounded-md">
        <!-- delete -->
        <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
            :handle-delete="handleDeleteOrdinance" :id="ordinance.id" />

        <div @click="showDeleteVerificationModal"
            class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
            delete</div>

        <h4 class="text-2xl font-bold my-3">{{ ordinance.title }}</h4>
        <button type="button" @click="showPDF" class="font-bold text-sm self-start text-blue-600">
            {{ !isShowPdf ? 'view pdf' : 'hide pdf' }}
        </button>

        <PDFViewer v-if="isShowPdf" :source="be_url + '/' + ordinance?.pdf_path" class="w-full h-[500px]" />
        <button type="button" @click="showPreviewModal"
            class="bg-blue-600 text-white font-[500] px-3 rounded-md block ml-auto mr-0 mt-3 text-sm">Edit</button>

    </div>
    <!-- preview ordinance to edit -->
    <OrdinanceModal v-if="isPreviewModal" :close-modal="showPreviewModal" :handle-update-ordinance="handleUpdateOrdinance"
        :selected-data="ordinance" />
</template>
<script setup>
import { ref } from "vue";
import PDFViewer from 'pdf-viewer-vue'
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import OrdinanceModal from "./OrdinanceModal.vue";
import { be_url } from "../../../config/config";

const isShowPdf = ref(false);
function showPDF() {
    isShowPdf.value = !isShowPdf.value;
}
// function to handle the delete 
const isVerificationModal = ref(false);
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

const isPreviewModal = ref(false);
function showPreviewModal() {
    isPreviewModal.value = !isPreviewModal.value;
}

defineProps({
    handleUpdateOrdinance: Function,
    handleDeleteOrdinance: Function,
    ordinance: Object
});
</script>