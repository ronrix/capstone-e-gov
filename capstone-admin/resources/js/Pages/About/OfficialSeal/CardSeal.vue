<template>
    <div
        class="relative overflow-hidden w-full flex flex-col md:flex-col lg:flex-row justify-between mt-5 bg-white rounded-lg px-8 py-10 mb-5  items-center order-last lg:order-first">
        <!-- delete button this will delete the programs and events -->
        <div @click="showDeleteVerificationModal"
            class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
            delete</div>

        <!-- delete -->
        <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
            :handle-delete="handleDelete" :id="index" />


        <div class="flex flex-col flex-1 text-center md:text-left">
            <h1 class="text-2xl md:text-4xl text-center md:text-left font-extrabold text-red-800 mb-4 capitalize">{{
                data?.title }}
            </h1>
            <p class="text-xs whitespace-pre-wrap line-clamp-6 pr-5" v-bind:innerHTML="description">
            </p>
            <!-- button view -->
            <button @click="showPreviewModal(data, index)"
                class="w-[70px] bg-blue-600 rounded-md mb-0  hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-start uppercase mt-5 lg:mt-14">view
            </button>
        </div>

        <div class="items-center justify-center mb-5 lg:mb-0 order-first lg:order-last">
            <img class="w-[250px] md:w-[280px] lg:w-[310px]" :src="imgSrc" alt="this is an official seal">
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import { be_url } from '../../../config/config';
import { validURL } from '../../../utils/validUrl';

import { marked } from "marked";
import DOMPurify from "dompurify";

const isVerificationModal = ref(false);

const description = DOMPurify.sanitize(marked.parse(data.description));
// function to handle the delete 
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

const imgSrc = validURL(data.img_link) ? data.img_link : be_url + "/" + data.img_link;
const { data } = defineProps({
    showPreviewModal: Function,
    data: Object,
    index: Number,
    handleDelete: Function
});
</script>

<style lang="scss" scoped></style>