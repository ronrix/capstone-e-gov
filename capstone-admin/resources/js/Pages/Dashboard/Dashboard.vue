<template>
    <DashboardWrapper>
        <div class="m-5 border p-3 shadow-md rounded-lg">
            <h4 class="font-bold text-xl">Content Title</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reprehenderit sit sapiente, veritatis commodi rerum
                rem beatae explicabo id sequi quibusdam!</p>
        </div>
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