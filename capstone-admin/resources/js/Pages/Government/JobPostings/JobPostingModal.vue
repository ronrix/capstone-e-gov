<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border">
      
      <!-- close modal btn -->
      <i @click="closeModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!--top  -->
      <div class="flex items-center justify-between mb-5">
        <span class="font-bold text-gray-400 text-xs">{{ new Date(selectedData.created_at).toLocaleDateString("en-PH", {
          month:
            "long", day: "numeric"
        }) }}</span>
      </div>

      <!-- job type -->
      <div class="flex-1">
        <textarea class="rounded-md text-xl font-bold text-gray-800 bg-transparent w-full max-h-[30px] outline-blue-600">{{ selectedData?.job_title }}</textarea>
        <input class="rounded-md text-sm font-bold text-gray-500 bg-transparent w-full outline-blue-600" :value="selectedData?.job_type" />
        <div class="flex items-center gap-2 mt-3 flex-wrap">
          <div v-for="jt in workTypes" class="px-2 py-1 text-[10px] rounded-full capitalize font-[500] relative" :style="{
            backgroundColor: (colors.find(col => col.type === jt.trim()))?.bgColor,
            color: (colors.find(col => col.type === jt.trim()))?.textColor,
          }">
            <!-- remove btn -->
            <div class="absolute -top-2 -right-1 cursor-pointer bg-red-400 rounded-full w-4 h-4 flex items-center justify-center hover:bg-red-300">
              <i @click="removeSchedule" class="uil uil-times text-white text-xs"></i>
            </div>
            <!-- value -->
            {{ jt }}
          </div>
          <!-- add new schedule btn -->
          <div class="w-7 h-7 rounded-full bg-slate-300 flex items-center justify-center cursor-pointer hover:bg-slate-200">
            <i class="uil uil-plus-circle text-gray-700"></i>
          </div>
        </div>
      </div>

      <!-- middle -->
      <div class="mt-8 overflow-hidden flex-1">
        <h6 class="text-gray-600 font-bold text-sm">{{ selectedData.job_location }}</h6>
        <textarea class="rounded-md text-sm text-gray-900 bg-transparent w-full overflow-y-scroll max-h-[100px] outline-blue-600">{{
          selectedData.job_description }}</textarea>
      </div>

      <button class="active:-translate-y-1 px-3 upperase font-bold text-white bg-blue-600 self-end rounded-md mt-5">save</button>

    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

const workTypes = selectedData.job_schedule.split(",");
const bgColor = ref("");
onMounted(() => {
  const randomIdx = Math.floor(Math.random() * workTypes.length);
  bgColor.value = colors.find(col => {
    const type = workTypes[randomIdx].trim()
    return col.type === type;
  });
  
  document.body.classList.add("overflow-hidden");
});

onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
})

function removeSchedule() {
  console.log("removing...");
}

const { colors, selectedData } = defineProps({
  colors: Array,
  selectedData: Array,
  closeModal: Function
});
</script>
