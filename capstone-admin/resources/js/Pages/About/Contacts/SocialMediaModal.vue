<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showSocialMediaModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Add new social media links</h4>
            <p class="text-sm text-gray-500">share new links to contact the municipal</p>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Social Platform</span>
                    <p class="text-xs text-gray-500">add a social platform here</p>
                    <div class="flex flex-row items-center">
                        <input v-model="formData.platform" type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                    <p v-if="v$.platform.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.platform.$errors[0].$message }}</p>
                </label>
                <div ref="add" class="max-h-[300px] overflow-y-scroll scrollbar">
                    <label class="flex flex-col w-full" id="telephone-num">
                        <span class="font-bold text-gray-500">Link</span>
                        <p class="text-xs text-gray-500">add link here</p>

                        <div class="flex flex-row items-center gap-2">
                            <input 
                                type="text" 
                                v-model="formData.firstLink"
                                class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <button type="button" @click="addMore">
                                <i class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-400"></i>
                            </button>
                        </div>
                        <p v-if="v$.firstLink.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.firstLink.$errors[0].$message }}</p>
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
import { computed, ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import Loading from '../../../Components/Loading.vue';

// adding rules for validation of the form
const rules = computed(() => ({
  platform: { required: helpers.withMessage("The platform field is required", required) },
  firstLink: { required: helpers.withMessage("One field of link is required", required) },
}));

const formData = useForm({
    platform: "",
    firstLink: "",
    links: "",
});

const add = ref(null)
const isError = ref(false);
const v$ = useVuelidate(rules, formData);
const isSubmitting = ref(false);

// add more input
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

    // append all the links
    const links = formData.firstLink;
    Array.from(e.srcElement).forEach(el => {
        if(el.nodeName === "INPUT" && el.classList.contains("more-input")) {
            mobNums += ", " + el.value;
        }
    });
    formData.links = links;

    isSubmitting.value = true;
    handleCreateNewSocialLinks(formData).then(() => {
        isSubmitting.value = false;
        formData.reset();

        // reset/remove the inputs
        const inputs = document.querySelectorAll('.more-input');
        inputs.forEach(input => {
            input.parentElement.remove();
        });

    });
}

const { handleCreateNewSocialLinks } = defineProps({
    showSocialMediaModal: Function,
    handleCreateNewSocialLinks: Function
})
</script>