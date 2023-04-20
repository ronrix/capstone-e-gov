<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showServiceModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Create new processes</h4>
            <p class="text-sm text-gray-500">Create a new processn to help citizens for more awareness about the
                specific service</p>
            <!-- form -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Client Steps</span>
                    <p class="text-xs text-gray-500">add the clients steps below</p>
                    <input v-model="formData.client_steps" type="text"
                        class="border w-full p-2 rounded-lg focus:outline-blue-600">
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Agency Steps</span>
                    <p class="text-xs text-gray-500">add the agency steps below</p>
                    <input v-model="formData.agent_steps" type="text"
                        class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    <p v-if="v$.agent_steps.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.agent_steps.$errors[0].$message }}</p>
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Fees to paid</span>
                    <p class="text-xs text-gray-500">add the fees to paid below</p>
                    <input v-model="formData.fees" type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Processing time</span>
                    <p class="text-xs text-gray-500">add the processing time below</p>
                    <input v-model="formData.process_time" type="text"
                        class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    <p v-if="v$.process_time.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.process_time.$errors[0].$message }}</p>
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Person responsible</span>
                    <p class="text-xs text-gray-500">add the name of the person responsible for the service</p>
                    <input v-model="formData.person_responsible" type="text"
                        class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    <p v-if="v$.person_responsible.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.person_responsible.$errors[0].$message }}</p>
                </label>

                <button :disabled="isSubmitting" type="submit" :class="{ 'cursor-not-allowed': isSubmitting }"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer flex items-center justify-center">
                    <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                    <span v-if="!isSubmitting">save</span>
                </button>
            </form>
        </div>
    </div>
</template>
  
<script setup>
import { computed, ref } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import Loading from "../../../Components/Loading.vue";

// adding rules for validation of the form
const rules = computed(() => ({
    agent_steps: { required: helpers.withMessage("One field of agent steps is required", required) },
    process_time: { required: helpers.withMessage("One field of processing time is required", required) },
    person_responsible: { required: helpers.withMessage("One field of processing time is required", required) },
}));

const formData = useForm({
    client_steps: "",
    agent_steps: "",
    fees: "",
    process_time: "",
});

const isSubmitting = ref(false);
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

async function submitFn() {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) {
        isError.value = true;
        return;
    }

    isSubmitting.value = true;
    if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
    handleCreateProcess(formData).then(() => {
        isSubmitting.value = false;
        formData.reset();
    });
}

const { handleCreateProcess } = defineProps({
    showServiceModal: Function,
    handleCreateProcess: Function
})
</script>