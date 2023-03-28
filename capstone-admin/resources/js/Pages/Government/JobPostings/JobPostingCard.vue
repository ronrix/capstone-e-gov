<template>
  <div class="bg-slate-200/30 rounded-md p-5 flex flex-col w-full sm:w-[300px] h-[450px] overflow-hidden">
     <!--top  -->
     <div class="flex items-center justify-between mb-5">
      <!-- circle -->
      <div :style="{backgroundColor: `${bgColor.bgColor}` }" class="w-14 h-14 rounded-full"></div>
      <span class="font-bold text-gray-400 text-xs">{{ new Date(data.created_at).toLocaleDateString("en-PH", { month: "long", day: "numeric" }) }}</span>
     </div>

    <!-- job type -->
    <div class="flex-1">
      <h5 class="text-xl font-bold text-gray-800">{{ data?.job_title }}</h5>
      <h6 class="text-sm font-bold text-gray-500">{{ data?.job_type }}</h6>
      <div class="flex items-center gap-2 mt-3 flex-wrap">
        <div v-for="jt in workTypes" class="px-2 py-1 text-[10px] rounded-full capitalize font-[500]" 
          :style="{ 
              backgroundColor: (colors.find(col => col.type === jt.trim()))?.bgColor,
              color: (colors.find(col => col.type === jt.trim()))?.textColor,
            }"
        >
        {{ jt }}
      </div>
      </div>
    </div>

    <!-- middle -->
    <div class="mt-8 overflow-hidden flex-1">
      <h6 class="text-gray-600 font-bold text-sm">{{ data.job_location }}</h6>
      <p class="text-xs text-gray-400 whitespace-pre-wrap w-full h-[50px] text-ellipsis truncate">{{ data.job_description }}</p>
    </div>

    <button type="button" @click="showModal(data)" class="active:-translate-y-1 rounded-md bg-blue-600 text-white  mt-3 outline-none font-bold text-sm self-end p-3">
      See Details
      <i class="uil uil-angle-right"></i>
    </button>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';

const workTypes = data.job_schedule.split(",");
const bgColor = ref("");
onMounted(() => {
  const randomIdx = Math.floor(Math.random() * workTypes.length);
  bgColor.value = colors.find(col => {
    const type = workTypes[randomIdx].trim()
    return col.type === type;
  });
});

const { data, colors } = defineProps({
  data: Object,
  showModal: Function,
  colors: Array
});
</script>