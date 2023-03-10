<template>
    <Head title="Login"></Head>
        <Wrapper :toggleDarkMode="toggleDarkMode" :darkMode="darkMode">
            <Notifcation :status="$page.props.flash?.error_msg?.status" :msg="$page.props.flash?.error_msg?.msg" v-if="$page.props.flash?.error_msg?.msg" />
            <div class="container mx-auto dark:text-white light:text-primary-dark flex items-center justify-center h-full">
                <form @submit.prevent="submitForm" :disabled="formData.processing" class="shadow-lg flex flex-col w-80 p-5 dark:bg-primary-gray rounded-md">
                    <!-- logo -->
                    <img :src="logoSrc" alt="Better Pililla Logo" class="w-32 mx-auto mb-5">
                    <!-- logo -->
                    <h1 class="text-2xl text-center">Welcome Back</h1>
                    <h3 class="text-sm text-secondary-gray text-center mb-5">Enter your credentials to login</h3>

                    <div class=" p-2 mb-2 rounded-md bg-tersiary-gray dark:bg-secondary-gray">
                        <input v-model="formData.email" name="email" type="text" placeholder="username or email" class="outline-none bg-transparent w-full" />
                    </div>
                    <p v-if="v$.email.$error" class="text-xs text-red-400 mb-2"> {{ v$.email.$errors[0].$message }} </p>
                    <div class="p-2 mb-2 rounded-md dark:bg-secondary-gray bg-tersiary-gray">
                        <input v-model="formData.password" name="password" type="password" placeholder="password" class="outline-none bg-transparent w-full" />
                    </div>
                    <p v-if="v$.password.$error" class="text-xs text-red-400 mb-2"> {{ v$.password.$errors[0].$message }} </p>
                    <input type="submit" value="Login" class="bg-primary-red p-2 my-2 hover:bg-primary-red-300 cursor-pointer text-white rounded-md" />
                    <p class="text-xs text-secondary-gray text-center">Login with administration access</p>
                </form>
            </div>
        </Wrapper>
</template>

<script setup>
    import { Head, useForm } from "@inertiajs/inertia-vue3";
    import { computed, ref, onMounted } from "vue";
    import Notifcation from "../Components/Notifcation.vue";

    // validation
    import useVuelidate from "@vuelidate/core";
    import { required, helpers } from "@vuelidate/validators"

    const darkMode = ref(true);
    const logoSrc = ref("images/logo/white/better-pililla.png");

    function toggleDarkMode() {
        darkMode.value = !darkMode.value;
        if(darkMode.value) {
            document.body.classList.add("dark");
            localStorage.setItem("theme", "dark"); // add dark to localStorage theme
            logoSrc.value = "images/logo/white/better-pililla.png";
            return;
        }
        document.body.classList.remove("dark")
        localStorage.setItem("theme", "light"); // add light to localStorage theme
        logoSrc.value = "images/logo/black/better-pililla.png";
    }

    onMounted(() => {
        // dark mode is off
        if(localStorage.getItem("theme") === "light") {
            darkMode.value = false;
            document.body.classList.remove("dark");
            logoSrc.value = "images/logo/black/better-pililla.png";
            return;
        }

        // dark mode is off
        darkMode.value = true;
        document.body.classList.add("dark");
        logoSrc.value = "images/logo/white/better-pililla.png";
    });

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
        if(!valid) return

        formData.post(route('login'));
        formData.reset();
    }
</script>