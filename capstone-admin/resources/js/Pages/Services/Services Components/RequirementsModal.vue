<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showRequirementModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900 capitalize">Add new requirements</h4>
            <p class="text-sm text-gray-500">Add new requirement for awareness of the citizen</p>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label>
                    <div class="flex flex-row  gap-2 items-center">
                        <input v-model="formData.requirement" type="text" placeholder="Requirement"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600">
                        <input v-model="formData.whereToGo" type="text" placeholder="Where to go?"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600">
                        <button @click="addMore" type="button">
                            <i class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-400"></i>
                        </button>
                    </div>
                </label>
                <p v-if="v$.requirement.$error && isError" class="text-xs text-red-400 mb-2"> {{
                    v$.requirement.$errors[0].$message }}</p>
                <div ref="add"></div>

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
import { ref, computed } from 'vue';
import Loading from '../../../Components/Loading.vue';
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    requirement: { required: helpers.withMessage("One field of requirement is required", required) },
}));

const isSubmitting = ref(false);
const formData = useForm({
    requirement: "",
    whereToGo: "",
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

const add = ref(null)
function addMore(e) {
    const div = document.createElement("div");
    const inputReq = document.createElement('input');
    const inputToGo = document.createElement('input');
    const removeBtn = document.createElement('button');

    removeBtn.innerHTML = `<i  class="uil uil-times-square text-2xl text-red-500 ml-1 hover:text-red-400"></i> `;
    inputReq.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600 input-req";
    inputReq.placeholder = "Requirement";
    inputToGo.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600 input-to-go";
    inputToGo.placeholder = "Where to go?";

    div.className = "flex flex-row  gap-2 items-center";
    div.appendChild(inputReq);
    div.appendChild(inputToGo);
    div.appendChild(removeBtn)

    // focus the input
    inputReq.focus();

    // TODO: function for cancel btn or remove the new added input
    removeBtn.addEventListener("click", function (e) {
        div.remove();
    });

    add.value.appendChild(div, e.target);
}

async function submitFn(e) {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) {
        isError.value = true;
        return;
    }

    // get all the value of "more-input"/s and append it to the formData.requirements
    let newRequirement = [formData.requirement];
    let newWhereToGo = [formData.whereToGo];
    Array.from(e.srcElement).forEach(el => {
        // get the input req
        if (el.nodeName === "INPUT" && el.classList.contains("input-req")) {
            newRequirement.push(el.value);
        }
        // get the input where to go
        if (el.nodeName === "INPUT" && el.classList.contains("input-to-go")) {
            newWhereToGo.push(el.value);
        }
    });

    isSubmitting.value = true;
    if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
    handleCreateRequirement(newRequirement, newWhereToGo).then(() => {
        isSubmitting.value = false;
        formData.reset();
        add.value.innerHTML = "";
    });
}

const { handleCreateRequirement } = defineProps({
    showRequirementModal: Function,
    append: Function,
    handleCreateRequirement: Function
})
</script>