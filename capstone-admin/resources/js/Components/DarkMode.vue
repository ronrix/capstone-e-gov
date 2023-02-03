
<template>
    <div class="fixed right-0 top-0 p-5 flex items-center text-white">
        <i @click="toggleDarkMode" class="fa-solid " :class="[darkMode ? 'fa-sun' : 'fa-moon text-primary-dark']"></i>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue';

    const darkMode = ref(true);

    function toggleDarkMode() {
        darkMode.value = !darkMode.value;
        if(darkMode.value) {
            document.body.classList.add("dark");
            return;
        }
        document.body.classList.remove("dark")
    }

    onMounted(() => {
        // dark mode is on
        // if(darkMode.value) {
        //     localStorage.setItem("darkMode", darkMode);
        // }
        // dark mode is off
        console.log("the component is now mounted");
    });

</script>