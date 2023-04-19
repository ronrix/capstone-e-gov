<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900 capitalize">Add new section</h4>
            <p class="text-sm text-gray-500">Add new requirements</p>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label>
                    <p class="text-sm text-gray-600">Section Name</p>
                    <input v-model="formData.sectionName" type="text"
                        class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    <p v-if="v$.sectionName.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.sectionName.$errors[0].$message }}</p>
                </label>
                <label>
                    <p class="text-sm text-gray-600">Requirements</p>
                    <div class="flex flex-row  gap-2 items-center">
                        <input v-model="formData.requirement" type="text"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600">
                        <button @click="addMore" type="button">
                            <i class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-400"></i>
                        </button>
                    </div>
                </label>
                <p v-if="v$.requirement.$error && isError" class="text-xs text-red-400"> {{
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
import Loading from '../../../../Components/Loading.vue';
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    requirement: { required: helpers.withMessage("One field of requirement is required", required) },
    sectionName: { required: helpers.withMessage("Section name field is required", required) },
}));

const isSubmitting = ref(false);
const formData = useForm({
    sectionName: "",
    requirement: "",
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

const add = ref(null)
function addMore(e) {
    const div = document.createElement("div");
    const input = document.createElement('input');
    const removeBtn = document.createElement('button');

    removeBtn.innerHTML = `<i  class="uil uil-times-square text-2xl text-red-500 ml-1 hover:text-red-400"></i> `;
    input.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600 more-input";

    div.className = "flex flex-row  gap-2 items-center";
    div.appendChild(input);
    div.appendChild(removeBtn)

    // focus the input
    input.focus();

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
    let newRequirement = formData.requirement;
    Array.from(e.srcElement).forEach(el => {
        if (el.nodeName === "INPUT" && el.classList.contains("more-input")) {
            newRequirement += ", " + el.value;
        }
    });

    isSubmitting.value = true;
    if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
    handleAddNewSectionPermit({ title: formData.sectionName, requirements: newRequirement }, id).then(() => {
        isSubmitting.value = false;
        formData.reset();
        add.value.innerHTML = "";
    });
}

const { handleAddNewSectionPermit, id } = defineProps({
    closeModal: Function,
    id: Number,
    handleAddNewSectionPermit: Function,
})
</script>