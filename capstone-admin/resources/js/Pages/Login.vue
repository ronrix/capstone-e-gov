<template>
    <HeadTitle title="Login"></HeadTitle>
    <Notifcation :msg="errorMsg" :isMounted="isMounted" />

    <div class="dark:text-white light:text-primary-dark flex items-center justify-center h-screen overflow-hidden">
        <!-- left -->
        <div class="hidden md:flex flex-1 bg-blue-600 h-full w-full items-center justify-center p-5 relative">
            <div class="max-w-[1000px]">
                <div class="flex-col mt-10 px-10 text-left">
                    <img src="/images/logo/white/better-pililla.png" alt="Better Pililla Logo" class="w-32 lg:w-44 mb-5">
                    <h1 class="text-5xl lg:text-7xl font-bold">Municipality of Pililla Rizal.</h1>
                    <p class="text-lg lg:text-3xl text-slate-300 mt-5">Easily modify the information of the official website
                        of the municipality.</p>
                </div>

                <!-- circles -->
                <div class="bg-green-300 w-[200px] h-[200px] rounded-full absolute -bottom-14 right-10"></div>
                <div class="bg-pink-400 w-[200px] h-[200px] rounded-full absolute -top-24 -left-10"></div>
            </div>
        </div>

        <!-- right -->
        <div class="flex-1 bg-slate-100 h-full flex items-center justify-center">
            <form @submit.prevent="submitForm" :disabled="formData.processing"
                class="w-full px-14 flex flex-col gap-3 max-w-[1000px]">
                <img class="w-20"
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Emoji_u1f44b.svg/1024px-Emoji_u1f44b.svg.png"
                    alt="hand wave icon">

                <div>
                    <h2 class="text-xl sm:text-3xl font-bold text-gray-800">Welcome Back</h2>
                    <h3 class="text-sm sm:text-base text-secondary-gray">Enter your credentials to login</h3>
                </div>

                <label class="text-gray-800 mb-2 rounded-md">
                    <span class="font-bold text-sm sm:text-base mb-1">E-mail</span>
                    <input v-model="formData.email" name="email" type="text" placeholder="Type your email or username"
                        class="outline-none w-full p-2 bg-white rounded-md text-sm sm:text-base shadow-inner focus:outline-blue-600"
                        :class="{ 'outline-red-400': v$.email.$error }" />
                    <p v-if="v$.email.$error" class="text-xs text-red-400 my-2"> {{ v$.email.$errors[0].$message }} </p>
                </label>
                <label class="mb-2 rounded-md text-gray-800">
                    <span class="font-bold text-base mb-1">Password</span>
                    <div class="relative">
                        <input v-model="formData.password" name="password" :type="hideNshowPass ? 'text' : 'password'"
                            placeholder="Type your password"
                            class="outline-none w-full p-2 bg-white rounded-md text-sm sm:text-base shadow-inner focus:outline-blue-600"
                            :class="{ 'outline-red-400': v$.password.$error }" />
                        <!-- hide and display password -->
                        <i @click="handleHideNShowPass"
                            :class="{ 'uil-eye': hideNshowPass, 'uil-eye-slash': !hideNshowPass }"
                            class="uil absolute top-1/2 -translate-y-1/2 right-2 text-gray-500 hover:text-blue-600"></i>
                    </div>

                    <p v-if="v$.password.$error" class="text-xs text-red-400 my-2"> {{ v$.password.$errors[0].$message }}
                    </p>
                </label>
                <input type="submit" value="Login"
                    class="active:-translate-y-1 p-2 my-2 cursor-pointer text-white rounded-md w-full bg-blue-600 text-sm sm:text-base font-bold" />
                <p class="text-xs sm:text-sm text-secondary-gray text-center">Login with administration access</p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import { computed, ref } from "vue";
import Notifcation from "../Components/Notifcation.vue";
import axios from "axios";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import { be_url } from "../config/config";

// form state
const formData = useForm({
    email: "",
    password: ""
});
// adding rules for validation of the form
const rules = computed(() => ({
    email: { required: helpers.withMessage("The field username or email is required", required) },
    password: { required: helpers.withMessage("The field password is required", required) }
}));
const v$ = useVuelidate(rules, formData);
const hideNshowPass = ref(false);

// function to call when form submits
const isMounted = ref(false);
const errorMsg = ref();

async function submitForm() {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) return

    // send login request
    try {
        const response = await axios.post(be_url + '/login', { email: formData.email, password: formData.password });

        // success
        // redirect to '/dashboard'
        if (response.data.status === 200) {
            window.location.href = "/dashboard"; // redirect to dashboard 
            return;
        }

        // error 
        if (response.data.status === 400) {
            errorMsg.value = response.data; // set the error msg to display in notif component 
            isMounted.value = true; // show the notif component
            formData.password = ""; // reset the password input

            // 3s before the notif component go display out
            const interval = setTimeout(() => {
                isMounted.value = false;
                clearTimeout(interval);
            }, 3000);
        }
    } catch (error) {
        console.log(error);
    }

    // niremove ko para di siya magrefresh pagclick ng login sa form para magwork yung prevent na code formData.reset();
}

function handleHideNShowPass() {
    hideNshowPass.value = !hideNshowPass.value;
}


</script>