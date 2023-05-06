<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showPermitModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900 capitalize">
                Add new Permit
            </h4>
            <p class="text-sm text-gray-500">
                Add new requirement for the permit
            </p>
            <!-- form -->
            <form @submit.prevent="submitFn" class="mt-3 w-full">
                <label class="flex flex-col justify-start gap-1">
                    <span class="font-bold text-gray-500">Title</span>
                    <p class="text-xs text-gray-500">
                        Add new requirement for the permit
                    </p>
                    <input type="text" v-model="formData.title" class="border p-2 rounded-lg focus:outline-blue-600" />
                    <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2">
                        {{ v$.title.$errors[0].$message }}
                    </p>
                </label>
                <label class="flex flex-col justify-start gap-1">
                    <span class="font-bold text-gray-500">Description</span>
                    <p class="text-xs text-gray-500">
                        Add a description for this permit
                    </p>
                    <input type="text" v-model="formData.description"
                        class="border p-2 rounded-lg focus:outline-blue-600" />
                    <p v-if="v$.description.$error && isError" class="text-xs text-red-400 mb-2">
                        {{ v$.description.$errors[0].$message }}
                    </p>
                </label>

                <!-- requirements -->
                <label class="flex flex-col justify-start gap-1">
                    <span class="font-bold text-gray-500">Requirements</span>
                    <p class="text-xs text-gray-500">
                        Type the requirements using this format
                        <a href="https://www.markdownguide.org/basic-syntax/" target="_blank"
                            class="text-blue-500 underline">markedown</a>
                    </p>
                    <textarea type="text" v-model="formData.requirements"
                        class="border p-2 rounded-lg focus:outline-blue-600 resize-none max-h-[200px]"></textarea>
                    <p v-if="v$.requirements.$error && isError" class="text-xs text-red-400 mb-2">
                        {{ v$.requirements.$errors[0].$message }}
                    </p>
                </label>
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
import { ref, onMounted, onUnmounted, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Loading from "../../../../Components/Loading.vue";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";

// adding rules for validation of the form
const rules = computed(() => ({
    title: { required: helpers.withMessage("The field title is required", required) },
    description: { required: helpers.withMessage("The field descrption is required", required) },
    requirements: { required: helpers.withMessage("The field requirements is required", required) },
}));

const formData = useForm({
    title: "",
    description: "",
    requirements: "",
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);
const isSubmitting = ref(false);

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
});

// remove scroll hidden on unmount
onUnmounted(() => {
    document.body.classList.remove("overflow-hidden");
});

const { handleSubmit } = defineProps({
    showPermitModal: Function,
    handleSubmit: Function,
});
</script>
