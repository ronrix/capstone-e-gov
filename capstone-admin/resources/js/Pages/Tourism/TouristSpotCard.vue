<template>
    <div
        class="relative bg-white p-5 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden shadow-md">
        <div class="z-10">
            <Delete :handleDelete="handleDelete" :id="data.id" />
        </div>

        <!-- image -->
        <div class="flex-1 flex flex-col gap-3 items-start justify-between ">
            <div class="img-hover-zoom-slide h-[300px] w-full">
                <img class="h-[300px] max-h-[400px] w-full lg:w-[max]" :src="data?.img">
            </div>
            <div class="flex">
                <i style="margin-top: 2px;" class="ml-2 uil uil-location-point text-cyan-400"></i>
                <p class="text-ellipsis overflow-hidden pt-1" style="font-size: 12px;">{{ data.address }}</p>
            </div>
        </div>
        <!-- content -->
        <div class="flex-1 p-5 flex flex-col items-start justify-between">
            <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.placeName }}</h3>
            <p class="text-ellipsis text-sm h-[100px] overflow-hidden">
                {{ data.content }}
            </p>
            <!-- PreviewButton -->
            <button @click="showTouristSpotPreviewModal(data)"
                class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-20 uppercase md:rounded ">edit</button>
        </div>
    </div>
</template>
<script setup>
import Delete from '../../Components/Delete.vue';

const { data } = defineProps({
    showTouristSpotPreviewModal: Function,
    data: Object,
    handleDelete: Function,
});
</script>
<style scope></style>