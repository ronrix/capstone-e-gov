<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form @submit.prevent="onSubmit" class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border">
      
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
        <textarea v-model="formData.title" class="rounded-md text-xl font-bold text-gray-800 bg-transparent w-full max-h-[30px] outline-blue-600">{{ selectedData?.job_title }}</textarea>
        <input v-model="formData.type" class="rounded-md text-sm font-bold text-gray-500 bg-transparent w-full outline-blue-600" />
        <div class="flex items-center gap-2 mt-3 flex-wrap">
          <div v-for="jt, idx in workTypes" class="px-2 py-1 text-[10px] rounded-full capitalize font-[500] relative" :style="{
            backgroundColor: (colors.find(col => col.type === jt.trim()))?.bgColor,
            color: (colors.find(col => col.type === jt.trim()))?.textColor,
          }">
            <!-- remove btn -->
            <div class="absolute -top-2 -right-1 cursor-pointer bg-red-400 rounded-full w-4 h-4 flex items-center justify-center hover:bg-red-300">
              <i @click="removeSchedule(idx)" class="uil uil-times text-white text-xs"></i>
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
        <h6 class="text-gray-600 text-xs font-[500] capitalizejj">salary</h6>
        <h5 v-if="!isEditable" @click="editFormatCurrency" class="text-gray-600 font-bold text-sm w-full">{{ formattedCurrency }}</h5>
        <input v-if="isEditable" @blur="formatCurrency" v-model="formData.salary" type="number" class="text-gray-600 font-bold text-sm bg-transparent w-full outline-blue-600">
        <h6 class="text-gray-600 text-xs font-[500] mt-2 capitalize">address</h6>
        <input v-model="formData.location" type="text" class="text-gray-600 text-sm bg-transparent font-bold w-full mb-2 outline-blue-600">

        <h6 class="text-gray-600 text-xs font-[500] mt-2 capitalize">description</h6>
        <textarea v-model="formData.description" class="rounded-md text-sm text-gray-900 bg-transparent w-full overflow-y-scroll h-[100px] max-h-[100px] outline-blue-600 scrollbar">{{
          selectedData.job_description }}</textarea>
      </div>

      <button class="active:-translate-y-1 px-3 upperase font-bold text-white bg-blue-600 self-end rounded-md mt-5 flex items-center justify-center">
        <loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
        <span>save</span>
      </button>

    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import Loading from "../../../Components/Loading.vue";

const isEditable = ref(false);
const workTypes = ref(selectedData.job_schedule.split(","));
const formattedCurrency = ref(new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(selectedData.job_salary));
const formData = useForm({
  id: selectedData.id,
  title: selectedData.job_title,
  type: selectedData.job_type,
  location: selectedData.job_location,
  salary: selectedData.job_salary,
  description: selectedData.job_description,
  schedule: workTypes.value
});

const isSubmitting = ref(false);
const bgColor = ref("");
onMounted(() => {
  const randomIdx = Math.floor(Math.random() * workTypes.length);
  bgColor.value = colors.find(col => {
    const type = workTypes[randomIdx];
    return col.type === type;
  });
  
  document.body.classList.add("overflow-hidden");
});

onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
})

function removeSchedule(id) {
  workTypes.value.splice(id, 1);
  console.log("removing... ", id);
}

function onSubmit() {
  isSubmitting.value = true;
  handleUpdate(formData).then((data) => {
    console.log(data);
    isSubmitting.value = false;
  });
}

// function to format the currency when input salary is out of focus
function formatCurrency(e) {
  formattedCurrency.value = new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(e.target.value);
  isEditable.value = false;
}

function editFormatCurrency(e) {
  isEditable.value = true;
}

const { colors, selectedData, handleUpdate } = defineProps({
  colors: Array,
  selectedData: Array,
  closeModal: Function,
  handleUpdate: Function
});
</script>
