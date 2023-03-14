<template>
    <div class="flex flex-row items-start shadow-lg bg-white rounded-lg">
        <!---Image-->
        <div :style="{backgroundImage: `url(${data.img})`}" class="bg-no-repeat bg-cover bg-center h-[300px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm">
        </div>
        <!--content-->
        <div class="flex-1 p-5 flex flex-c items-start justify-between"> 
            <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
            <h5 class="text-xs text-gray-500 font-bold">{{ data.type }}</h5>
            <p class="mt-5 text-ellipsis text-sm h-[100px] overflow-hidden">
            {{ data.content }}
            </p>

        </div>
    </div>
</template>

<script setup>
defineProps({
  showNewsModal: Function,
  data: Object
});
</script>