<template>
    <DashboardWrapper>
        <div class="m-5 border p-3 shadow-md rounded-lg">
            <h4 class="font-bold text-xl">Content Title</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit sit sapiente, veritatis commodi rerum
                rem beatae explicabo id sequi quibusdam!</p>
        </div>
        <div class="flex items-center justify-center">
            <div class="m-8 border bg-red-100">
                <p>hello po</p>
             </div>
            <strong class="text-blue-500">hehehehe</strong>
           
    </div>
    <strong class="text-red-400 ml-56" ><i>Bolbol</i></strong>
    </DashboardWrapper>
</template>

<script setup>
import DashboardWrapper from "../../Components/DashboardWrapper.vue";
import { onMounted } from "vue";

onMounted(() => {
    document.title = "Better Pililla | Dashboard";
})

</script>

<style lang="scss" scoped></style>