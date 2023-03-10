<template>
    <div class="m-5">
        <h3 class="font-bold text-xl">Tracking website viewers</h3>
        <div class="flex gap-3 mt-3 flex-wrap">
            <Card title="Today's viewers" class="bg-blue-600 text-white" borderColor="#fff" amount="1000" />
            <Card title="Total viewers" borderColor="#000" amount="600" />
        </div>

        <h3 class="font-bold text-xl mt-5">Programs & Events</h3>
        <!-- <div class="m-5 border p-3 shadow-md rounded-lg">
            <h4 class="font-bold text-xl">Content Title</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit sit sapiente, veritatis commodi rerum
                rem beatae explicabo id sequi quibusdam!</p>
        </div>-->


        <!-- test component -->
        <!-- <Test propTitle="BELOW CONTENT, IS <p> TAG WITH LONG TEXTS" />
        <br>
        <Link href="logout" class="border bg-blue-400 p-2 text-white">logout</Link>  -->
    </div>
</template>

<script setup>
import { onMounted } from "vue";
import Test from "../Test.vue";
import Card from "./Card.vue";

onMounted(() => {
    document.title = "Better Pililla | Dashboard";
})

</script>

<style lang="scss" scoped></style>