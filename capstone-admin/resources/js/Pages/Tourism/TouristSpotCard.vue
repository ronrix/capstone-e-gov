<template>
    <div
        class="relative bg-white p-5 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden shadow-md">
        <div class="z-10">
            <Delete :handleDelete="handleDelete" :id="data.id" />
        </div>

        <!-- image -->
        <div class="flex-1 flex flex-col gap-3 items-start justify-between ">
            <div class="img-hover-zoom-slide h-[300px] w-full">
                <img class="h-[300px] max-h-[400px] w-full lg:w-[max]" :src="imgSrc">
            </div>
            <div class="flex">
                <i style="margin-top: 2px;" class="mr-2 uil uil-location-point text-cyan-400"></i>
                <p class="text-ellipsis overflow-hidden pt-1 text-[12px] capitalize">{{ data.location }}</p>
            </div>
        </div>
        <!-- content -->
        <div class="flex-1 p-5 flex flex-col items-start justify-between">
            <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
            <p class="text-ellipsis text-sm h-[100px] overflow-hidden" v-bind:innerHTML="description"></p>
            <!-- PreviewButton -->
            <button @click="showTouristSpotPreviewModal(data)"
                class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-20 uppercase md:rounded ">view</button>
        </div>
    </div>
</template>
<script setup>
import Delete from '../../Components/Delete.vue';
import { formatImgs } from '../../utils/formatImgs';

import { marked } from "marked";
import DOMPurify from 'dompurify';

const imgSrc = formatImgs(data.img_link.split(","))[0];
const description = DOMPurify.sanitize(marked.parse(data.description));

const { data } = defineProps({
    showTouristSpotPreviewModal: Function,
    data: Object,
    handleDelete: Function,
});
</script>
<style scope></style>