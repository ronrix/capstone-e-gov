<template>
    <!--Adding form-->
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="closeAddPDF"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
             <h2 class="font-bold text-2xl capitalize mb-0 text-gray-900">Add new application</h2>
             <p class="text-xs text-gray-500 mb-3">Upload a pdf format of the application form</p>

            <!--Remember the (Action attribute) needed to be add??-->
            <form method="POST" @submit.prevent="onSubmit" class="flex flex-col w-full">
                <label class="flex flex-col">
                    <span class="text-sm font-semibold capitalize">Title</span>
                    <input type="text" class="text-sm outline-blue-600 w-full p-2 border">
                </label>
                <input name="title" type="file" placeholder="type the title here."
                    class="rounded-md mt-2 focus:outline-blue-600">
                <input type="submit" value="save" class="self-end p-2 font-semibold bg-blue-600 rounded-md text-white">
            </form>
        </div>
    </div>
</template>

<script setup>
defineProps({
    closeAddPDF: Function
})
</script>