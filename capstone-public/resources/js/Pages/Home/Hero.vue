<template>
    <div class="w-full mt-5 h-[400px] relative">
        <!-- img -->
        <img src="/images/hero.png" alt="this is a hero picture" class="absolute mx-auto -z-10 left-0 right-0 w-screen h-full">
        <!-- img-1 -->
        <img src="/images/hero-2.png" alt="this is a hero picture 2. mayor and a child hugging  together" class="absolute bottom-0 right-0 xl:right-96 w-[350px] -z-10">

        <Wrapper class="flex flex-col gap-3 items-start">
            <h1 class="text-8xl text-primary font-bold capitalize font-['display']">better pililla</h1>
            <h2 class="font-bold text-3xl flex flex-col items-start capitalize">
                <span>A better Community,</span>
                <span>A better home</span>
            </h2>
            <h3 class="font-semibold">Get to know the places in pililla</h3>
            <RouterLink
                to="/tourism/highlights"
                class="capitalize bg-primary rounded-md text-white px-3 py-1 cursor-pointer hover:bg-primarylight font-bold">
                <i class="uil uil-map-marker-question mr-2"></i>
                Tourists Spots
            </RouterLink>

            <!-- datetime -->
            <p class="font-bold text-black">{{ $page.props.time }}</p>
        </Wrapper>
    </div>
</template>

<script setup>
import { RouterLink } from 'vue-router';
</script>