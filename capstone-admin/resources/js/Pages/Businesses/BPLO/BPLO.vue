<template>
    <HeadTitle title="BPLO"></HeadTitle>


    <div>
        <!--For File-->
        <div class="flex flex-cols items-center">
            <span class="font-bold text-2xl text-gray-500 mr-5">Application Form</span>
            <div class="flex-1 border"></div>
        </div>
        <button
            class="w-[100px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5 lg:mt-10"
            @click="AddPDF">
            Add Form
        </button>

        <!--For Permit-->
        <div class="flex flex-cols items-center">
            <span class="font-bold text-2xl text-gray-500 mr-5">Permits</span>
            <div class="flex-1 border"></div>
        </div>
        <button
            class="w-[120px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5 lg:mt-10"
            @click="AddPermit">
            Add Permit
        </button>
    </div>
</template>

<script setup>
import AddPDF from './BPLOFormComponents/AddPDF.vue';
import AddPermit from './BPLOFormComponents/AddPermit.vue';
</script>

<style lang="scss" scoped></style>