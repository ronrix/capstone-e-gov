<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="backdrop-blur-xl bg-white/70 p-5 w-[500px] rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900 capitalize">Change password</h4>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit.prevent="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label>
                    <span class="text-sm font-bold text-gray-700">Old password</span>
                    <div class="relative">
                        <input v-model="formData.oldPassword" :type="hideNshowPass.op ? 'text' : 'password'"
                            placeholder="Type current password"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600 placeholder:text-sm text-sm">

                        <!-- hide and display password -->
                        <i @click="handleHideNShowPass" id="op"
                            :class="{ 'uil-eye': hideNshowPass.op, 'uil-eye-slash': !hideNshowPass.op }"
                            class="uil  absolute top-1/2 -translate-y-1/2 right-2 text-gray-500 hover:text-blue-600"></i>
                    </div>
                    <p v-if="v$.oldPassword.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.oldPassword.$errors[0].$message }}</p>
                </label>
                <label>
                    <span class="text-sm font-bold text-gray-700">New password</span>
                    <div class="relative">
                        <input v-model="formData.newPassword" :type="hideNshowPass.np ? 'text' : 'password'"
                            placeholder="Type new password"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600 placeholder:text-sm text-sm">

                        <!-- hide and display password -->
                        <i @click="handleHideNShowPass" id="np"
                            :class="{ 'uil-eye': hideNshowPass.np, 'uil-eye-slash': !hideNshowPass.np }"
                            class="uil absolute top-1/2 -translate-y-1/2 right-2 text-gray-500 hover:text-blue-600"></i>
                    </div>


                    <p v-if="v$.newPassword.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.newPassword.$errors[0].$message }}</p>
                </label>
                <label>
                    <span class="text-sm font-bold text-gray-700">Confirm new password</span>
                    <div class="relative">
                        <input v-model="formData.confirmPassword" placeholder="Type new password again"
                            :type="hideNshowPass.cp ? 'text' : 'password'"
                            class="border w-full p-2 rounded-lg focus:outline-blue-600 placeholder:text-sm text-sm">
                        <!-- hide and display password -->
                        <i @click="handleHideNShowPass" id="cp"
                            :class="{ 'uil-eye': hideNshowPass.cp, 'uil-eye-slash': !hideNshowPass.cp }"
                            class="uil absolute top-1/2 -translate-y-1/2 right-2 text-gray-500 hover:text-blue-600"></i>
                    </div>


                    <p v-if="v$.confirmPassword.$error && isError" class="text-xs text-red-400 mb-2"> {{
                        v$.confirmPassword.$errors[0].$message }}</p>
                </label>

                <button :disabled="isSubmitting" type="submit" :class="{ 'cursor-not-allowed': isSubmitting }"
                    class="active:-translate-y-1 w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer flex items-center justify-center">
                    <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                    <span v-if="!isSubmitting">save</span>
                </button>
            </form>
        </div>
    </div>
</template>
<script setup>
import { ref, computed } from "vue";
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers, minLength, sameAs } from "@vuelidate/validators"
import Loading from "./Loading.vue";

// adding rules for validation of the form
const rules = computed(() => ({
    oldPassword: { required: helpers.withMessage("The field current password is required", required) },
    newPassword: { required: helpers.withMessage("The field new password is required", required), minLength: minLength(8) },
    confirmPassword: { required: helpers.withMessage("The field confirm new password is required", required), sameAsPassword: helpers.withMessage("Please confirm the new password", sameAs(formData.newPassword)) },
}));

const hideNshowPass = ref({ op: false, np: false, cp: false });
const isSubmitting = ref(false);
const formData = useForm({
    oldPassword: "",
    newPassword: "",
    confirmPassword: "",
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

function handleHideNShowPass(e) {
    if (e.target.id === "np") {
        hideNshowPass.value.np = !hideNshowPass.value.np;
    }
    if (e.target.id === "op") {
        hideNshowPass.value.op = !hideNshowPass.value.op;
    }
    if (e.target.id === "cp") {
        hideNshowPass.value.cp = !hideNshowPass.value.cp;
    }
}

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
    handleChangePassword(formData).then(() => {
        isSubmitting.value = false;
        formData.reset();
    });
}

const { handleChangePassword } = defineProps({
    closeModal: Function,
    handleChangePassword: Function,
});
</script>