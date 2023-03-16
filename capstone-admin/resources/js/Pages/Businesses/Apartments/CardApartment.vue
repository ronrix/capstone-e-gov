<template>
    <div class="flex flex-row items-start shadow-lg bg-white rounded-lg">
        <!---Image-->
        <div :style="{ backgroundImage: `url(${data.img})` }"
            class="bg-no-repeat bg-cover bg-center h-[300px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm">
        </div>
        <!--content-->
        <div class="flex-1 p-5 flex flex-col items-start justify-between">
            <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
            <h5 class="text-xs text-gray-500 font-bold">{{ data.type }}</h5>
            <p class="mt-5 text-ellipsis text-sm h-[100px] overflow-hidden">
                {{ data.content }}
            </p>

            <!-- button to view the more about the content -->
            <button class="px-5 bg-blue-600 text-white py-2" @click="showPreviewModal(data)">view</button>
        </div>
    </div>
</template>

<script setup>
defineProps({
    showPreviewModal: Function,
    data: Object
});
</script>