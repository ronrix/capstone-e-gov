<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showContactsModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Add new contacts</h4>
            <p class="text-sm text-gray-500">Add new requirement for awareness of the citizen</p>
            <!-- form -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">

                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Department</span>
                    <p class="text-xs text-gray-500">add the a department name</p>
                    <div class="flex flex-row items-center">
                        <input v-model="formData.department" type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                    <p v-if="v$.department.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.department.$errors[0].$message }}</p>
                </label>
                <div ref="add" class="max-h-[300px] overflow-y-scroll scrollbar">
                    <label class="flex flex-col w-full" id="mobile-num">
                        <span class="font-bold text-gray-500">Mobile Number</span>
                        <p class="text-xs text-gray-500">add the a new mobile number</p>
                        <div class="flex items-center gap-2">
                            <input 
                                type="number" 
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="11" 
                                v-model="formData.firstMobileNum"
                                class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <button type="button" @click="addMore">
                                <i class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-500"></i>
                            </button>
                        </div>
                        <p v-if="v$.firstMobileNum.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.firstMobileNum.$errors[0].$message }}</p>
                    </label>

                    <label class="flex flex-col w-full" id="telephone-num">
                        <span class="font-bold text-gray-500">Telephone Number</span>
                        <p class="text-xs text-gray-500">add the a new telephone number</p>

                        <div class="flex flex-row items-center gap-2">
                            <input 
                                type="number" 
                                v-model="formData.firstTelephoneNum"
                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                maxlength="8" 
                                class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <button type="button" @click="addMore">
                                <i class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-400"></i>
                            </button>
                        </div>
                        <p v-if="v$.firstTelephoneNum.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.firstTelephoneNum.$errors[0].$message }}</p>
                    </label>
                </div>

                <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
                    class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center">
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
  department: { required: helpers.withMessage("The department field is required", required) },
  firstMobileNum: { required: helpers.withMessage("One field of mobile number is required", required) },
  firstTelephoneNum: { required: helpers.withMessage("One field of telephone number is required", required) },
}));

const add = ref(null)
const isSubmitting = ref(false);

const formData = useForm({
    department: "",
    firstMobileNum: "",
    firstTelephoneNum: "",
    mobile_nums: "",
    telephone_nums: "",
});

const isError = ref(false);
const v$ = useVuelidate(rules, formData);

function addMore(e) {
    const parent = e.target.parentElement.parentElement.parentElement;

    const div = document.createElement("div");
    const input = document.createElement('input');
    const removeBtn = document.createElement('button');

    // check what type of number then add a max length
    if(parent.id === "mobile-num") {
        input.maxLength = "11";
    }
    else {
        input.maxLength = "8";
    }

    removeBtn.innerHTML = `<i  class="uil uil-times-square text-2xl text-red-500 ml-1 hover:text-red-400"></i> `;
    removeBtn.type = "button";
    input.type = "number";
    input.oninput = (e) =>  {
        if(e.target.value.length > e.target.maxLength) { 
            e.target.value = e.target.value.slice(0, e.target.maxLength);
        }
    }
    input.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600 more-input";
    input.classList.add(parent.id);

    div.className = "flex flex-row  gap-2 items-center";
    div.appendChild(input);
    div.appendChild(removeBtn)

    // focus the input
    input.focus();

    // TODO: function for cancel btn or remove the new added input
    removeBtn.addEventListener("click", function(e) {
        div.remove();
    });

    parent.appendChild(div);
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
    let mobNums = formData.firstMobileNum;
    let telNums = formData.firstTelephoneNum;
    Array.from(e.srcElement).forEach(el => {
        if(el.nodeName === "INPUT" && el.classList.contains("more-input") && el.classList.contains("mobile-num")) {
            mobNums += ", " + el.value;
        }
        if(el.nodeName === "INPUT" && el.classList.contains("more-input") && el.classList.contains("telephone-num")) {
            telNums += ", " + el.value;
        }
    });
    // append the first mobile num to the formData.mobile_nums
    formData.mobile_nums = mobNums;

    // append the first telephone num to the formData.telepehone_nums
    formData.telephone_nums = telNums;

    isSubmitting.value = true;
    handleCreateNewContact(formData).then(() => {
        isSubmitting.value = false;
        formData.reset();

        // reset/remove the inputs
        const inputs = document.querySelectorAll('.more-input');
        inputs.forEach(input => {
            input.parentElement.remove();
        });

    });
}

const { handleCreateNewContact } = defineProps({
    showContactsModal: Function,
    append: Function,
    handleCreateNewContact: Function
})
</script>