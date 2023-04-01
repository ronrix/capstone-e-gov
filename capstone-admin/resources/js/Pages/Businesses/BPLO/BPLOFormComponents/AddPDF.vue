<template>
    <!--Adding form-->
    <section class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-50 z-20">
        <div
            class="backdrop-blur-xl bg-white/70 sm:w-[700px] mx-auto p-5 flex flex-col relative overflow-hidden rounded-lg">

            <!--Close Button--><!--remeber to add back (uil uil-times)-->
            <i @click="showAddModal"
                class=" text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h2 class="font-bold text-2xl capitalize mb-0 text-gray-900">Add new form</h2>

            <!--Remember the (Action attribute) needed to be add??-->
            <form method="POST" @submit.prevent="onSubmit" class="flex flex-col">
                <label class="flex flex-col">
                    <span class="text-sm font-bold capitalize mb-2">title</span>
                    <input v-model="formData.title" name="title" type="text" placeholder="type the title here."
                        class="rounded-md mb-5 p-2 focus:outline-blue-600">
                    <p v-if="v$.title.$error && isError" class="text-xs text-red-400- mb-2">{{ v$.title.$errors[0].$message
                    }}</p>
                    
                </label>
            </form>
        </div>
    </section>
</template>

<script setup>

</script>