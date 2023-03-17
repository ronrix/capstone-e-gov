<template>
    <Head title="Login"></Head>
    <Notifcation :status="$page.props.flash?.error_msg?.status" :msg="$page.props.flash?.error_msg?.msg"
        v-if="$page.props.flash" />

    <div class="dark:text-white light:text-primary-dark flex items-center justify-center h-screen overflow-hidden">
        <!-- left -->
        <div class="hidden md:flex flex-1 bg-blue-600 h-full w-full items-center justify-center p-5 relative">
            <div class="flex-col mt-10 px-10 text-left">
                <img src="/images/logo/white/better-pililla.png" alt="Better Pililla Logo" class="w-32 mb-5">
                <h1 class="text-5xl font-bold">Municipality of Pililla Rizal.</h1>
                <p class="text-lg text-slate-300 mt-5">Easily modify the information of the official website of the municipality.</p>
            </div>

            <!-- circles -->
            <div class="bg-green-300 w-[200px] h-[200px] rounded-full absolute -bottom-14 right-10"></div>
            <div class="bg-pink-400 w-[200px] h-[200px] rounded-full absolute -top-24 -left-10"></div>
        </div>

        <!-- right -->
        <div class="flex-1 bg-slate-100 h-full flex items-center justify-center">
            <form @submit.prevent="submitForm" :disabled="formData.processing"
                class="w-full px-14 flex flex-col gap-3">
                <img class="w-20" src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/70/Emoji_u1f44b.svg/1024px-Emoji_u1f44b.svg.png" alt="hand wave icon">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Welcome Back</h2>
                    <h3 class="text-sm text-secondary-gray">Enter your credentials to login</h3>
                </div>

                <label class="text-gray-800 mb-2 rounded-md">
                    <span class="font-bold text-sm mb-1">E-mail or username</span>
                    <input v-model="formData.email" name="email" type="text" placeholder="Type your email or username"
                        class="outline-none w-full p-2 bg-white rounded-md text-lg" />
                    <p v-if="v$.email.$error" class="text-xs text-red-400 mb-2"> {{ v$.email.$errors[0].$message }} </p>
                </label>
                <label class="mb-2 rounded-md text-gray-800">
                    <span class="font-bold text-sm mb-1">Password</span>
                    <input v-model="formData.password" name="password" type="password" placeholder="type your password"
                        class="outline-none w-full p-2 bg-white rounded-md text-lg" />
                    <p v-if="v$.password.$error" class="text-xs text-red-400 mb-2"> {{ v$.password.$errors[0].$message }} </p>
                </label>
                <input type="submit" value="Login"
                    class="p-2 my-2 cursor-pointer text-white rounded-md w-full bg-blue-600" />
                <p class="text-xs text-secondary-gray text-center">Login with administration access</p>
            </form>
        </div>
    </div>
</template>

<script setup>
import { Head, useForm } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import Notifcation from "../Components/Notifcation.vue";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

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

// function to call when form submits
async function submitForm() {
    // invoke validation
    // return when not inputs are not valid
    const valid = await v$.value.$validate();
    if (!valid) return

    formData.post(route('login'));
    // niremove ko para di siya magrefresh pagclick ng login sa form para magwork yung prevent na code formData.reset();
}


</script>