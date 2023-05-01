<template>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-30">
        <form @submit.prevent="onSubmit"
            class="backdrop-blur-xl bg-white/70 h-auto sm:w-[500px] p-5 rounded-lg flex flex-col border overflow-y-auto scrollbar"
            enctype="multipart/form-data">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

            <h3 class="font-bold">Create new service</h3>
            <p class="text-xs text-gray-600 mb-3">
                By creating new service, this will be visible on services tab where you
                can add requirements and processes
            </p>

            <label class="flex flex-col flex-1">
                <span class="text-xs sm:text-sm font-bold capitalize mb-2">department:</span>
                <input v-model="formData.department" name="department" type="text" placeholder="Type the department here..."
                    class="rounded-md mb-5 p-2 focus:outline-blue-600 text-xs sm:text-sm" />
                <p v-if="v$.department.$error && isError" class="text-xs text-red-400 mb-2">
                    {{ v$.department.$errors[0].$message }}
                </p>
            </label>
            <label class="flex flex-col flex-1">
                <span class="text-xs sm:text-sm font-bold capitalize mb-2">title:</span>
                <input v-model="formData.title" name="intendedFor" type="text" placeholder="Type title here..."
                    class="rounded-md mb-5 p-2 focus:outline-blue-600 text-xs sm:text-sm" />
                <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2">
                    {{ v$.title.$errors[0].$message }}
                </p>
            </label>
            <label class="flex flex-col flex-1">
                <span class="text-xs sm:text-sm font-bold capitalize mb-2">description:</span>
                <textarea v-model="formData.description" name="intendedFor" type="text"
                    placeholder="Type description here..."
                    class="rounded-md mb-5 p-2 focus:outline-blue-600 text-xs sm:text-sm"></textarea>
                <p v-if="v$.description.$error && isError" class="text-xs text-red-400 mb-2">
                    {{ v$.description.$errors[0].$message }}
                </p>
            </label>
            <label class="flex flex-col flex-1">
                <span class="text-xs sm:text-sm font-bold capitalize">service type</span>
                <p class="text-xs text-gray-600 mb-1">Input the type of the service. e.g scholarship program, civil service
                    program, and etc.</p>
                <input v-model="formData.serviceType" name="serviceType" type="text" placeholder="Type the here..."
                    class="rounded-md mb-5 p-2 focus:outline-blue-600 text-xs sm:text-sm" />
                <p v-if="v$.serviceType.$error && isError" class="text-xs text-red-400 mb-2">
                    {{ v$.serviceType.$errors[0].$message }}
                </p>
            </label>

            <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
                class="active:-translate-y-[1px] mt-5 bg-blue-600 px-3 py-1 text-white rounded-md font-bold uppercase flex items-center justify-center text-xs sm:text-sm self-end outline-none">
                <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
                <span v-if="!isSubmitting">save</span>
            </button>
        </form>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { onMounted, onUnmounted, computed, ref } from "vue";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators";
import Loading from "./Loading.vue";
import Notifcation from "./Notifcation.vue";

// adding rules for validation of the form
const rules = computed(() => ({
    department: {
        required: helpers.withMessage("The field department is required", required),
    },
    title: {
        required: helpers.withMessage(
            "The field 'title' is required",
            required
        ),
    },
    description: {
        required: helpers.withMessage(
            "The field 'title' is required",
            required
        ),
    },
    serviceType: {
        required: helpers.withMessage(
            "The field 'service type' is required",
            required
        ),
    },
}));

const isSubmitting = ref(false);
const resMsg = ref();
const formData = useForm({
    department: "",
    title: "",
    description: "",
    serviceType: "",
});
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

// function to handle submit
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
    handleCreateService(formData).then((data) => {
        console.log(data.res);
        isSubmitting.value = false;
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        formData.reset();
    });
}

// add scroll hidden on unmount
onMounted(() => {
    document.body.classList.add("overflow-hidden");
});
// remove scroll hidden on unmount
onUnmounted(() => {
    document.body.classList.remove("overflow-hidden");
});

const { handleCreateService } = defineProps({
    closeModal: Function,
    handleCreateService: Function,
});
</script>