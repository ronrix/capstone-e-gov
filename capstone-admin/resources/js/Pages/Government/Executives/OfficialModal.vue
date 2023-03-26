<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form @submit.prevent="onSubmit" class="backdrop-blur-xl bg-white/80 sm:w-[500px] p-5 rounded-lg flex flex-col border" enctype="multipart/form-data">
      <!-- close modal btn -->
      <i @click="closeModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h3 class="font-bold text-xl capitalize text-gray-900 mb-3">Add an official</h3>
      <!-- full name input -->
      <label class="flex flex-col">
        <span class="text-sm font-bold capitalize mb-2">Full name</span>
        <input v-model="formData.fullName" name="title" type="text" placeholder="Type the full name here..." class="rounded-md p-2 focus:outline-blue-600">
        <p v-if="v$.fullName.$error" class="text-xs text-red-400 mb-2"> {{ v$.fullName.$errors[0].$message }} </p>
      </label>

      <!-- position select tag -->
      <span class="text-sm font-bold capitalize mb-2">Position</span>
      <SelectTag type="position" :value="position" :filterArray="positions" class="text-base" addedClass="!w-full" :filterFn="selectFn" />
      <!-- if barangay officials then show this input to add position for barangay official -->
      <label v-if="isBarangayOfficials" class="flex flex-col mt-4">
        <span class="text-xs font-bold capitalize mb-2">Barangay official position</span>
        <input v-model="formData.barangayOfficialPos" name="title" type="text" placeholder="Type the barangay position..." class="rounded-md mb-5 p-2 focus:outline-blue-600">
      </label>

      <!-- term inputs -->
      <div class="mt-3">
        <div>
          <span class="text-sm font-bold mb-2">Start term <span class="text-blue-400 font-normal">(year)</span></span>
          <SelectTag type="startTerm" :value="startTerm" :filterArray="years" class="text-base" addedClass="!w-full overflow-y-scroll max-h-[150px] scrollbar" :filterFn="selectFn" />
        </div>
        <div class="mt-3">
          <span class="text-sm font-bold mb-2">End term <span class="text-blue-400 font-normal">(year)</span></span>
          <SelectTag type="endTerm" :value="endTerm" :filterArray="years" class="text-base" addedClass="!w-full overflow-y-scroll max-h-[150px] scrollbar" :filterFn="selectFn" />
        </div>
      </div>

      <!-- img file input -->
      <input type="file" class="hidden" ref="imgRef" @change="handleSelectImgToUpload" >
      <div class="mt-5 font-[500] self-start flex items-center gap-2" type="button">
        Upload an image
        <i @click="showImgSelection" class="uil uil-plus-circle text-lg hover:text-blue-600 cursor-pointer"></i>
      </div>
      <p v-if="v$.imgFile.$error" class="text-xs text-red-400 mb-2"> {{ v$.imgFile.$errors[0].$message }} </p>
      <div class="text-sm text-gray-600 mt-2 flex items-center justify-start">
        <span v-if="!selectedImg">no image selected</span>
        <span v-if="selectedImg" class="text-blue-600">{{ selectedImg }}</span>
        <span v-if="formData.imgFile" @click="removeSelectedImg" class="flex items-center bg-red-600 ml-5 px-2 rounded-full font-[500] text-xs text-white cursor-pointer">
          remove
          <i class="uil uil-times"></i>
        </span>
      </div>

      <button type="submit" class="active:-translate-y-1 self-end mt-3 bg-blue-600 text-white font-bold uppercase px-3 rounded-md">
        <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
        save
      </button>

      </form>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import SelectTag from '../../../Components/SelectTag.vue';
import Loading from '../../../Components/Loading.vue';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    fullName: { required: helpers.withMessage("The field full name is required", required) },
    imgFile: { required: helpers.withMessage("The image is required", required) },
}));

const positions = ["Mayor", "Vice mayor", "barangay officials", "department heads"];
const years = [2023, 2022, 2021, 2020, 2019, 2018];
const position = ref("Mayor");
const startTerm = ref("2023");
const endTerm = ref("2023");
const isSubmitting = ref(false);

const isBarangayOfficials = ref(false);

const imgRef = ref(null);
const selectedImg = ref("");

const  formData = useForm({
  fullName: "",
  position: position.value,
  startTerm: startTerm.value,
  endTerm: endTerm.value,
  barangayOfficialPos: "",
  imgFile: null
});
const v$ = useVuelidate(rules, formData);

function selectFn(type, value) {
  if(type === "position") {
    position.value = value;
    isBarangayOfficials.value = position.value.toLowerCase() === 'barangay officials';
  }
  if(type === "startTerm") {
    startTerm.value = value;
  }
  if(type === "endTerm") {
    endTerm.value = value;
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
  if (!valid) return

  formData.reset();
  selectedImg.value = "";
  handleSubmit(formData);
}

const { handleSubmit } = defineProps({
  closeModal: Function,
  handleSubmit: Function,
});
</script>