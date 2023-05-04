<template>
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-[1000]">
        <form @submit.prevent="onSubmit"
            class="backdrop-blur-xl bg-white/70 h-full sm:h-auto w-[500px] p-5 rounded-lg flex flex-col border overflow-y-auto scrollbar"
            enctype="multipart/form-data">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <label>
                <span class="font-bold text-sm">Title:</span>
                <textarea v-model="formData.title" placeholder="type the ordinance title..."
                    class="w-full outline-blue-400 bg-transparent border h-[50px] resize-none placeholder:text-sm border-gray-400"></textarea>
                <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.title.$errors[0].$message }}
                </p>
            </label>
            <p class="font-bold text-sm">
                PDF file
                <input type="file" class="hidden" ref="inputFile" @change="handleChangePDF">
                <button type="button" @click="changePDFfile"
                    class="text-xs border font-thin border-blue-600 px-2 rounded-md self-start mb-3 hover:bg-blue-600 hover:text-white duration-100">
                    <i class="uil uil-plus-circle"></i> upload pdf</button>
            </p>
            <p class="underline">{{ formData.pdfView }}</p>
            <p v-if="v$.pdfFile.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.pdfFile.$errors[0].$message }}
            </p>
            <!-- submit button -->
            <button :disabled="isSubmitting" type="submit" :class="{
                    'cursor-not-allowed': isSubmitting,
                }" class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold flex items-center self-end">
                <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                <span v-if="!isSubmitting">save</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Loading from "../../../Components/Loading.vue";
// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    title: { required: helpers.withMessage("The field title is required", required) },
    pdfFile: { required: helpers.withMessage("The pdf file is required", required) },
}));
const isSubmitting = ref(false);
const formData = useForm({
    title: "",
    pdfFile: null,
    pdfView: "",
});

const inputFile = ref(null);
function changePDFfile() {
    inputFile.value.click();
}

function handleChangePDF(e) {
    formData.pdfFile = e.target.files[0];
    formData.pdfView = e.target.files[0].name;
}

const isError = ref(false);
const v$ = useVuelidate(rules, formData);
async function onSubmit() {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) {
        isError.value = true;
        return;
    }

    isSubmitting.value = true;
    if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
    handleCreateNewOrdinance(formData).then(data => {
        isSubmitting.value = false;
        formData.reset();
    });
}

const { handleCreateNewOrdinance } = defineProps({
    handleCreateNewOrdinance: Function,
    closeModal: Function
});

</script>