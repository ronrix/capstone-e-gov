<template>
  <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
      <!-- close modal btn -->
      <i @click="showHotlineModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
      <h4 class="font-bold text-xl text-gray-900">Create new hotline</h4>
      <p class="text-sm text-gray-500">Create new hotline number to help citizens contact departments when emergency comes.</p>

      <form @submit.prevent="onSubmit" class="w-full mt-3 flex flex-col gap-3">
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Department</span>
          <p class="text-xs text-gray-500">add the department name below</p>
          <input v-model="formData.department" type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Smart Number</span>
          <p class="text-xs text-gray-500">add the contact number below</p>
          <input 
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            maxlength="11"
            v-model="formData.smart" type="number" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Globe Number</span>
          <p class="text-xs text-gray-500">add the contact number below</p>
          <input 
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            maxlength="11"
            v-model="formData.globe" type="number" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Landline Number</span>
          <p class="text-xs text-gray-500">add the contact number below</p>
          <input 
            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
            maxlength="8"
            v-model="formData.landline" type="number" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
      
        <button class="active:-translate-y-1 px-3 upperase font-bold text-white bg-blue-600 self-end rounded-md mt-5 flex items-center justify-center">
          <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
          <span>save</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Loading from "../../../Components/Loading.vue";

const isSubmitting = ref(false);
const formData = useForm({
  department: "",
  smart: "",
  globe: "",
  landline: "",
});

function onSubmit() {
  isSubmitting.value = true;
  handleSubmit(formData).then(() => {
    isSubmitting.value = false;
  });
}

const { handleSubmit } = defineProps({
  showHotlineModal: Function,
  handleSubmit: Function
})
</script>