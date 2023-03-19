<template>
  <div class="relative overflow-hidden flex flex-col md:flex-row items-start shadow-lg bg-white border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 ">
 
    <!-- delete button this will delete the programs and events --> 
    <div class="z-10"> <!-- adding z-10 to put this delete component at the top/front -->
      <Delete />
    </div>

    <!-- image -->
    <div :style="{ backgroundImage: `url(${data.img_link})` }" class="bg-no-repeat bg-cover bg-center h-[300px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm after:block md:after:hidden "> </div>
    <!-- content -->
    <div class="flex-1 p-5 flex flex-col items-start justify-between">
      <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
      <h5 class="text-xs text-gray-500 font-bold">{{ new Date() }}</h5>
      <p class="mt-5 text-ellipsis text-sm h-[100px] overflow-hidden">
        {{ data.description }}
      </p>
      <button @click="showPreviewModal(data)" class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">view </button>
    </div>
  </div>
</template>

<script setup>
import Delete from '../../../Components/Delete.vue';

defineProps({
  showPreviewModal: Function,
  data: Object
});
</script>