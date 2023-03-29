<template>
    <!--Adding form-->
    <section class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-50 z-20">
        <div
            class="backdrop-blur-xl bg-white/70 sm:w-[700px] mx-auto p-5 flex flex-col relative overflow-hidden rounded-lg">

            <!--Close Button--><!--remeber to add back (uil uil-times)-->
            <i @click="showAddModal"
                class=" text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h2 class="font-bold text-2xl capitalize mb-0 text-gray-900">Create new {{ title }}</h2>
            <p class="text-sm text-gray-600 whitespace-pre-wrap">
                To format for your content appropriately, you should understand how markdown works
            </p>
        </div>
    </section>
</template>

<script setup>

</script>