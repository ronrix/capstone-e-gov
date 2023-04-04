<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form @submit.prevent="onSubmit" class="backdrop-blur-xl bg-white/70 sm:w-[700px] p-5 rounded-lg relative flex flex-col md:flex-row items-start">
      <!-- close modal btn -->
      <i @click="showTouristSpotPreviewModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!-- left -->
      <!-- news thumbnail -->
      <div class="overflow-hidden mt-5 group relative h-[50px] md:h-auto w-full md:w-1/2">
        <img :src="selectedImgFile || formData.img">
        <div class="flex">
          <i style="margin-top: 2px;" class="ml-2 uil uil-location-point text-cyan-400"></i>
          <textarea v-model="formData.location" class="bg-transparent outline-blue-600 w-full max-h-[40px] text-ellipsis overflow-hidden pt-1" style="font-size: 12px;"></textarea>
        </div>
        <!-- input file to select new thumbnail -->
        <input @change="selectImgFn" type="file" ref="fileRef" class="hidden">

        <button @click="selectNewThumbnail" type="button" class="px-3 border border-blue-600 text-blue-600 text-xs font-bold rounded-md mt-5">
          <i class="uil uil-plus-circle"></i> 
          Upload new thumbnail
        </button>
      </div>

      <!-- right -->
      <div class="flex-1 p-3 w-full">
        <!-- title -->
        <textarea v-model="formData.name"
          class="bg-transparent capitalize w-full py-3 overflow-scroll no-scrollbar text-xl font-bold h-[40px] max-h-[40ppx]"></textarea>
        <!-- date -->
        <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
        <!-- content -->
        <textarea v-model="formData.description"
          class="bg-transparent outline-blue-600 capitalize py-3 w-full overflow-scroll h-[200px] max-h-[200px] no-scrollbar text-sm"></textarea>

        <div class="flex items-center justify-end">
          <button type="submit" :disabled="isSubmitting" :class="{'cursor-not-allowed' : isSubmitting}" class="active:-translate-y-1 px-4 bg-blue-600 ml-3 text-white rounded-md flex items-center justify-center">
            <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
            save
          </button>
        </div>
      </div>
    </form>
  </div>
</template>
  
<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { dateFormat } from "../utils/dateFormat";
import Loading from './Loading.vue';
import { formatImgs } from '../utils/formatImgs';

const imgSrc = formatImgs(selectedData.img_link.split(","));
const formData = useForm({
  img: selectedData.img_link.length ? imgSrc : "https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png",
  newImg: null,
  name: selectedData.name,
  location: selectedData.location,
  description: selectedData.description
});
const { selectedData, handleUpdate } = defineProps({
  showTouristSpotPreviewModal: Function,
  selectedData: {},
  handleUpdate: Function
});
const date = dateFormat(selectedData.created_at);
const fileRef = ref(null);
const isSubmitting = ref(false);

function selectNewThumbnail() {
  fileRef.value.click();
}

// this function is change event handler, will set the new/selected image file and store in the state "selectedImgFile"
function selectImgFn(e) {
  formData.img = URL.createObjectURL(e.target.files[0]); 
  formData.newImg = e.target.files[0];
}

// add scroll hidden on mount
onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});

function onSubmit() {
  isSubmitting.value = true;

  handleUpdate(formData, selectedData.id).then(() => {
    isSubmitting.value = false;
  });
}

</script>