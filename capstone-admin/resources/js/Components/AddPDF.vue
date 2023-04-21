<template>
    <!--Adding form-->
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="closeAddPDF"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h2 class="font-bold text-2xl capitalize mb-0 text-gray-900">Upload a file</h2>
            <p class="text-xs text-gray-500 mb-3">Upload a file in (pdf, word) format</p>

            <!--Remember the (Action attribute) needed to be add??-->
            <form method="POST" @submit.prevent="onSubmit" class="flex flex-col w-full gap-3">
                <div>
                    <p class="text-sm font-semibold">Filetype</p>
                    <p class="text-sm capitalize border p-2 cursor-not-allowed">{{ filetypeText }}</p>
                </div>

                <label class="flex flex-col">
                    <span class="text-sm font-semibold capitalize">Filename:</span>
                    <input type="text" v-model="formData.filename" class="text-sm outline-blue-600 w-full p-2 border">
                    <p v-if="v$.filename.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.filename.$errors[0].$message }}</p>
                </label>
                <input @change="handleSelectFile" name="title" type="file" placeholder="type the title here."
                    class="rounded-md mt-2 focus:outline-blue-600">
                <p v-if="v$.file.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.file.$errors[0].$message }}
                </p>

                <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
                    class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center text-xs sm:text-sm self-end">
                    <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                    <span v-if="!isSubmitting">save</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Loading from './Loading.vue';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    filename: { required: helpers.withMessage("The field filename is required", required) },
    file: { required: helpers.withMessage("The field file is required", required) },
}));

const isSubmitting = ref(false);
const formData = useForm({
    filename: "",
    filetype,
    file: null,
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

function handleSelectFile(e) {
    formData.file = e.target.files[0];
}

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
    handleUploadFile(formData).then(data => {
        isSubmitting.value = false;
        formData.reset();
        formData.file = null;
    });
}

const filetypeText = filetype === 'af' ? "application form" : "full disclosure report";
const { handleUploadFile, filetype } = defineProps({
    closeAddPDF: Function,
    handleUploadFile: Function,
    filetype: String,
})
</script>