<template>
    <HeadTitle title="Dashboard"></HeadTitle>
    <div class="container mx-auto flex mt-2">
        <!-- left -->
        <section class="bg-white flex-1 p-3">
            <h2 class="text-xl font-bold">Welcome back, Admin!</h2>
            <h5 class="text-sm text-gray-600">{{ dateFormat(new Date()) }}</h5>

        </section>

        <!-- right -->
        <section class="flex-1 p-3"></section>
    </div>
</template>

<script setup>
import { dateFormat } from "../../utils/dateFormat";
import { onMounted } from "vue";
import Echo from "laravel-echo";

onMounted(() => {
    window.Echo.channel("notification")
        .listen("PostRequestNotification", (e) => {
            console.log(e);
        });
});

</script>