<template>
    <div
        class="relative overflow-hidden w-full flex flex-col md:flex-col lg:flex-row justify-between mt-5 bg-white rounded-lg px-8 py-10 mb-5  items-center order-last lg:order-first">
        <!-- delete button this will delete the programs and events -->
        <div class="z-10"> <!-- adding z-10 to put this delete component at the top/front -->
            <Delete :handleDelete="handleDelete" :id="index" />
        </div>
        <div class="flex flex-col flex-1 text-center md:text-left">
            <h1 class="text-2xl md:text-4xl text-center md:text-left font-extrabold text-red-800 mb-4 capitalize">{{ data?.title }}
            </h1>
            <p
                class="h-[95px] md:h-[100px] overflow-hidden md:text-sm font-medium text-gray-800 justify-center items-center mr-0 lg:mr-28 text-left">
                {{ data?.description }}</p>
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
import Delete from '../../../Components/Delete.vue';
import { be_url } from '../../../config/config';
import { validURL } from '../../../utils/validUrl';

const imgSrc = validURL(data.img_link) ? data.img_link : be_url + "/" + data.img_link;
const { data } = defineProps({
    showPreviewModal: Function,
    data: Object,
    index: Number,
    handleDelete: Function
});
</script>

<style lang="scss" scoped></style>