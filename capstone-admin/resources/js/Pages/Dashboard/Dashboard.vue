<template>
    <div>
        <div class="m-5 border p-3 shadow-md rounded-lg">
            <h4 class="font-bold text-xl">Content Title</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit sit sapiente, veritatis commodi rerum
                rem beatae explicabo id sequi quibusdam!</p>
        </div>


        <!-- test component -->
        <Test propTitle="BELOW CONTENT, IS <p> TAG WITH LONG TEXTS" />
        <br>
        <Link href="logout" class="border bg-blue-400 p-2 text-white">logout</Link>
    </div>
</template>

<script setup>
import { Link } from "@inertiajs/inertia-vue3";
import { onMounted, ref } from "vue";
import Test from "../Test.vue";

onMounted(() => {
    document.title = "Better Pililla | Dashboard";
})

</script>

<style lang="scss" scoped></style>