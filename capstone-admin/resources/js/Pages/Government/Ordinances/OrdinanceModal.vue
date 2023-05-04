<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-[1000]">
        <form @submit.prevent="onSubmit"
            class="backdrop-blur-xl bg-white/70 h-full sm:h-auto w-[500px] p-5 rounded-lg flex flex-col border overflow-y-auto scrollbar"
            enctype="multipart/form-data">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h3 class="font-bold text-xl capitalize">Edit ordinance</h3>
            <label>
                <span class="font-bold text-sm">Title:</span>
                <textarea v-model="formData.title"
                    class="w-full outline-blue-400 bg-transparent border resize-none"></textarea>
            </label>
            <span class="font-bold text-sm">PDF file</span>
            <a :href="formData.pdfFile" target="_blank" class="underline">{{ formData.pdfView }}</a>
            <input type="file" class="hidden" ref="inputFile" @change="handleChangePDF">
            <button type="button" @click="changePDFfile"
                class="text-xs border border-blue-600 px-2 rounded-md self-start mb-3 hover:bg-blue-600 hover:text-white duration-100">change
                the pdf
                file</button>

            <!-- submit button -->
            <button :disabled="isSubmitting || selectedData?.deleted_at" type="submit" :class="{
                    'cursor-not-allowed': isSubmitting || selectedData?.deleted_at,
                }" class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold flex items-center self-end">
                <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                <span v-if="!isSubmitting">save</span>
            </button>
        </form>
    </div>
</template>
<script setup>
import { ref } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';
import Loading from "../../../Components/Loading.vue";

const isSubmitting = ref(false);
const formData = useForm({
    title: selectedData?.title,
    pdfFile: null,
    pdfView: selectedData?.pdf_path,
});

const inputFile = ref(null);
function changePDFfile() {
    inputFile.value.click();
}

function handleChangePDF(e) {
    formData.pdfFile = e.target.files[0];
    formData.pdfView = e.target.files[0].name;
}

function onSubmit() {
    isSubmitting.value = true;
    handleUpdateOrdinance(selectedData?.id, formData).then(() => {
        isSubmitting.value = false;
    });
}

const { selectedData, handleUpdateOrdinance } = defineProps({
    closeModal: Function,
    selectedData: Object,
    handleUpdateOrdinance: Function
})
</script>