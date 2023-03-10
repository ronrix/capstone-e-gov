<template>
    <div class="m-5">
        <h3 class="font-bold text-xl">Tracking website viewers</h3>
        <div class="flex gap-3 mt-3 flex-wrap">
            <Card title="Today's viewers" class="bg-blue-600 text-white" borderColor="#fff" amount="1000" />
            <Card title="Total viewers" borderColor="#000" amount="600" />
        </div>

        <!-- 
            display programs showing how many comments 
            when clicked it should display a modal displaying all the comments and the admin acan also add their comments
        -->
        <div class="mt-14">
            <h3 class="font-bold text-xl">Programs & Events</h3>
            <HorizontalCard commentsCount="100" title="Happy fiesta Pililla Rizal" imgSrc="https://images.unsplash.com/photo-1554037895-b5ec1389b928?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1471&q=80" />
        </div>
        <div class=" mt-5">
            <h3 class="font-bold text-xl">News</h3>
            <HorizontalCard commentsCount="23" title="Coffee na masaarap sa Oval, di daw masarap" imgSrc="https://images.unsplash.com/photo-1525480038216-45653b3aac92?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80" />
        </div>
        <div class=" mt-5">
            <h3 class="font-bold text-xl">Job Postings</h3>
            <HorizontalCard commentsCount="23" title="Looking for viva max artists" imgSrc="https://images.unsplash.com/photo-1500628550463-c8881a54d4d4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1469&q=80" />
        </div>

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
import HorizontalCard from "./HorizontalCard.vue";

onMounted(() => {
    document.title = "Better Pililla | Dashboard";
})

</script>

<style lang="scss" scoped></style>