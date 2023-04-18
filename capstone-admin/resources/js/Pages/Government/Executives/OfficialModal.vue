<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form @submit.prevent="onSubmit" class="backdrop-blur-xl bg-white/80 sm:w-[500px] p-5 rounded-lg flex flex-col border"
      enctype="multipart/form-data">
      <!-- close modal btn -->
      <i @click="closeModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h3 class="font-bold text-xl capitalize text-gray-900 mb-3">Add an official</h3>
      <!-- full name input -->
      <label class="flex flex-col">
        <span class="text-sm font-bold capitalize mb-2">Full name</span>
        <input v-model="formData.fullName" name="title" type="text" placeholder="Type the full name here..."
          class="rounded-md p-2 focus:outline-blue-600">
        <p v-if="v$.fullName.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.fullName.$errors[0].$message }}
        </p>
      </label>

      <!-- position select tag -->
      <span class="text-sm font-bold capitalize mb-2">Position</span>
      <SelectTag type="position" :value="position" :filterArray="positions" class="text-base" addedClass="!w-full"
        :filterFn="selectFn" />
      <!-- if barangay officials then show this input to add position for barangay official -->
      <label v-if="isOptional" class="flex flex-col mt-4">
        <span class="text-xs font-bold capitalize mb-2">optional</span>
        <input v-model="formData.optionalPosition" name="title" type="text" placeholder="Type optional position..."
          class="rounded-md mb-5 p-2 focus:outline-blue-600">
      </label>

      <!-- term inputs -->
      <span class="text-sm font-bold mb-2 mt-3">Start term <span class="text-blue-400 font-normal">(year)</span></span>
      <DatePicker v-model:value="formData.startTerm" class="w-full"></DatePicker>
      <p v-if="v$.startTerm.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.startTerm.$errors[0].$message }}
      </p>
      <span class="text-sm font-bold mt-3 mb-2">End term <span class="text-blue-400 font-normal">(year)</span></span>
      <DatePicker v-model:value="formData.endTerm" class="w-full"></DatePicker>
      <p v-if="v$.endTerm.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.endTerm.$errors[0].$message }} </p>

      <!-- img file input -->
      <input type="file" class="hidden" ref="imgRef" @change="handleSelectImgToUpload">
      <div class="mt-5 font-[500] self-start flex items-center gap-2" type="button">
        Upload an image
        <i @click="showImgSelection" class="uil uil-plus-circle text-lg hover:text-blue-600 cursor-pointer"></i>
      </div>
      <p v-if="v$.imgFile.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.imgFile.$errors[0].$message }} </p>
      <div class="text-sm text-gray-600 mt-2 flex items-center justify-start">
        <span v-if="!selectedImg">no image selected</span>
        <span v-if="selectedImg" class="text-blue-600">{{ selectedImg }}</span>
        <span v-if="formData.imgFile" @click="removeSelectedImg"
          class="flex items-center bg-red-600 ml-5 px-2 rounded-full font-[500] text-xs text-white cursor-pointer">
          remove
          <i class="uil uil-times"></i>
        </span>
      </div>

      <button type="submit"
        class="active:-translate-y-1 self-end mt-3 bg-blue-600 text-white font-bold uppercase px-3 rounded-md flex items-center">
        <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" color="#fff" />
        <span v-if="!isSubmitting">save</span>
      </button>

    </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import SelectTag from '../../../Components/SelectTag.vue';
import Loading from '../../../Components/Loading.vue';

// datepicker
import DatePicker from 'vue-datepicker-next';
import 'vue-datepicker-next/index.css';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
  fullName: { required: helpers.withMessage("The field full name is required", required) },
  startTerm: { required: helpers.withMessage("The field start term is required", required) },
  endTerm: { required: helpers.withMessage("The field end term is required", required) },
  imgFile: { required: helpers.withMessage("The image is required", required) },
}));

const positions = ["mayor", "vice mayor", "barangay official", "department head", "honorable"];
const position = ref("Mayor");
const isSubmitting = ref(false);
const isError = ref(false);

const isOptional = ref(false);

const imgRef = ref(null);
const selectedImg = ref("");

const formData = useForm({
  fullName: "",
  position: position.value,
  startTerm: "",
  endTerm: "",
  optionalPosition: "",
  imgFile: null
});
const v$ = useVuelidate(rules, formData);

function selectFn(type, value) {
  if (type === "position") {
    position.value = value;
    formData.position = value;
    isOptional.value = position.value.toLowerCase() === 'barangay official' || position.value.toLowerCase() === 'department head';
  }
}

function showImgSelection() {
  imgRef.value.click();
}

function handleSelectImgToUpload(e) {
  formData.imgFile = e.target.files[0];
  selectedImg.value = e.target.files[0]?.name;
}

function removeSelectedImg(e) {
  formData.imgFile = null;
  selectedImg.value = "";
}

async function onSubmit() {
  // invoke validation
  // return when not inputs are not valid
  const valid = await v$.value.$validate();
  if (!valid) {
    isError.value = true;
    return;
  }

  // add comma if barangay or department position
  if (formData.position.toLowerCase() === "barangay official" || formData.position.toLocaleLowerCase() === 'department head') {
    formData.position += ", " + formData.optionalPosition;
  }

  isSubmitting.value = true;
  if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
  handleSubmit(formData).then((data) => {
    if (data.res.status >= 400) {
      formData.imgFile = null;
      selectedImg.value = "";
      return;
    }
    isSubmitting.value = false;
    isOptional.value = false;
    formData.reset();
  });
}

const { handleSubmit } = defineProps({
  closeModal: Function,
  handleSubmit: Function,
});
</script>