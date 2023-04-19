<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showPermitModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900 capitalize">Add new Permit</h4>
            <p class="text-sm text-gray-500">Add new requirement for the permit</p>
            <!-- form -->
            <form @submit.prevent="submitFn" class="mt-3 w-full">
                <label class="flex flex-col justify-start gap-1">
                    <span class="font-bold text-gray-500">Title</span>
                    <p class="text-xs text-gray-500">add new requirement for the permit</p>
                    <input type="text" v-model="formData.title" class="border p-2 rounded-lg focus:outline-blue-600">
                    <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.title.$errors[0].$message
                    }}</p>
                </label>

                <span class="font-bold text-gray-500">Requirements</span>
                <p class="text-xs text-gray-500">
                    Format the requirements correctly by copying the first { "title": "", "requirements": [] } and pasting
                    it below with a comma separation
                    it should look like this [ [ { "title": "", "requirements": [] }, { "title": "", "requirements": [] }] ]
                </p>
                <!-- requirements in JSONeditor format -->
                <div ref="reqContainer" class="w-full border mt-3 bg-slate-100 relative"></div>

                <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
                    class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center w-full">
                    <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                    <span v-if="!isSubmitting">save</span>
                </button>
            </form>
        </div>
    </div>
</template>
   
<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import Loading from "../../../../Components/Loading.vue";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import JSONEditor from "jsoneditor";

// adding rules for validation of the form
const rules = computed(() => ({
    title: { required: helpers.withMessage("The field title is required", required) },
}));

const formData = useForm({
    title: "",
    requirements: {},
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);
const isSubmitting = ref(false);
const reqContainer = ref(null);
let editor;
const json = [
    {
        title: "change of business name",
        requirements: ["example 1", "example 2"]
    },
];

async function submitFn(e) {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) {
        isError.value = true;
        return;
    }

    isSubmitting.value = true;
    if (isError.value) isError.value = false; // remove the error message from displaying when validation passed

    // TODO: get all the value of the JSONeditor and store them to formData 
    formData.requirements = editor.get();
    // then send a post request to the server
    handleSubmit(formData).then(() => {
        isSubmitting.value = false;
        formData.reset();
        // format the editor json value to default
        editor.set(json);
    });
}

// add scroll hidden on mount
onMounted(() => {
    document.body.classList.add("overflow-hidden");

    const options = { mode: "text", mainMenuBar: false, statusBar: false, indentation: 4 }
    editor = new JSONEditor(reqContainer.value, options, json);
    // style the text editor
    editor.textarea.className += "bg-slate-100 max-h-[300px] h-[200px] scrollbar w-full";
});

// remove scroll hidden on unmount
onUnmounted(() => {
    document.body.classList.remove("overflow-hidden");
});

const { handleSubmit } = defineProps({
    showPermitModal: Function,
    handleSubmit: Function
})
</script>