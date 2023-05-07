<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form @submit.prevent="onSubmit"
      class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border">

      <!-- close modal btn -->
      <i @click="closeModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!--top  -->
      <div class="flex items-center justify-between mb-2">
        <span class="font-bold text-gray-400 text-xs">{{ new Date(selectedData.created_at).toLocaleDateString("en-PH", {
          month:
            "long", day: "numeric"
        }) }}</span>
      </div>

      <div class="flex items-center">
        <div class="w-10 h-10 rounded-full overflow-hidden bg-white">
          <img :src="imgLogo" alt="this is the company logo" class="object-cover">
        </div>
        <input type="file" class="hidden" ref="inputLogo" @change="handleSelectLogo">
        <button @click="() => inputLogo.click()" type="button"
          class="border border-blue-500 text-blue-500 rounded-md px-2 text-xs ml-5">change</button>
      </div>

      <!-- job type -->
      <div class="flex-1">
        <textarea v-model="formData.title"
          class="rounded-sm text-xl font-bold text-gray-800 bg-transparent w-full max-h-[30px] outline-blue-600"></textarea>
        <label class="flex flex-col text-sm">
          <span>author:</span>
          <input v-model="formData.author"
            class="rounded-sm font-bold text-primary-dark bg-transparent w-full outline-blue-600" />
        </label>
        <label class="flex flex-col text-sm">
          <span>email:</span>
          <input v-model="formData.email"
            class="rounded-sm font-bold text-primary-dark bg-transparent w-full outline-blue-600" />
        </label>
        <div class="flex items-center gap-2 mt-3 flex-wrap">
          <div v-for="jt, idx in workTypes" :key="jt"
            class="px-2 py-1 text-[10px] rounded-full capitalize font-[500] relative" :style="{
              backgroundColor: (colors.find(col => col.type === jt.trim()))?.bgColor,
              color: (colors.find(col => col.type === jt.trim()))?.textColor,
            }">
            <!-- remove btn -->
            <div
              class="absolute -top-2 -right-1 cursor-pointer bg-red-400 rounded-full w-4 h-4 flex items-center justify-center hover:bg-red-300">
              <i @click="removeSchedule(idx)" class="uil uil-times text-white text-xs"></i>
            </div>
            <!-- value -->
            {{ jt }}
          </div>
          <!-- add new schedule btn -->
          <select @change="addNewSchedule" class="text-xs outline-blue-300">
            <option selected>choose schedule</option>
            <option value="full time">full time</option>
            <option value="part time">part time</option>
            <option value="internship">internship</option>
            <option value="remote">remote</option>
            <option value="temporary">temporary</option>
            <option value="fixed term">fixed term</option>
            <option value="contractural">contractual</option>
          </select>
        </div>
      </div>

      <!-- middle -->
      <div class="mt-8 overflow-hidden flex-1">
        <h6 class="text-gray-600 text-xs font-[500] capitalizejj">salary</h6>
        <h5 v-if="!isEditable" @click="editFormatCurrency" class="text-gray-600 font-bold text-sm w-full">{{
          formattedCurrency }}</h5>
        <input v-if="isEditable" @blur="formatCurrency" v-model="formData.salary" type="number"
          class="text-gray-600 font-bold text-sm bg-transparent w-full outline-blue-600">
        <h6 class="text-gray-600 text-xs font-[500] mt-2 capitalize">address</h6>
        <input v-model="formData.location" type="text"
          class="text-gray-600 text-sm bg-transparent font-bold w-full mb-2 outline-blue-600">
        <h6 class="text-gray-600 text-xs font-[500] mt-2 capitalize">company name</h6>
        <input v-model="formData.companyName" type="text"
          class="text-gray-600 text-sm bg-transparent font-bold w-full mb-2 outline-blue-600">

        <h6 class="text-gray-600 text-xs font-[500] mt-2 capitalize">description</h6>
        <textarea v-model="formData.description"
          class="rounded-md text-sm text-gray-900 bg-transparent w-full overflow-y-scroll h-[100px] max-h-[100px] outline-blue-600 scrollbar"></textarea>
      </div>

      <button
        class="active:-translate-y-1 px-3 upperase font-bold text-white bg-blue-600 self-end rounded-md mt-5 flex items-center justify-center">
        <loading class="w-5 h-5 mr-2" v-if="isSubmitting" color="#fff" />
        <span v-if="!isSubmitting">save</span>
      </button>

    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

import Loading from "../../../Components/Loading.vue";
import { formatImgs } from '../../../utils/formatImgs';

const imgLogo = ref(formatImgs(selectedData.logo.split(','))[0])
const inputLogo = ref(null);
const isEditable = ref(false);
const workTypes = ref(selectedData.job_schedule.split(","));
const formattedCurrency = ref(new Intl.NumberFormat("en-US", { style: "currency", currency: "USD" }).format(selectedData.job_salary));
const formData = useForm({
  id: selectedData.id,
  logo: null,
  title: selectedData.job_title,
  companyName: selectedData.company_name,
  author: selectedData.author,
  email: selectedData.email,
  location: selectedData.job_location,
  salary: selectedData.job_salary,
  description: selectedData.job_description,
  schedule: workTypes.value
});

function handleSelectLogo(e) {
  formData.logo = e.target.files[0];
  imgLogo.value = URL.createObjectURL(e.target.files[0]);
}

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
}

function onSubmit() {
  isSubmitting.value = true;
  handleUpdate(formData).then((data) => {
    isSubmitting.value = false;
  });
}

function addNewSchedule(e) {
  workTypes.value.push(e.target.value);
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
  selectedData: Object,
  closeModal: Function,
  handleUpdate: Function
});
</script>
