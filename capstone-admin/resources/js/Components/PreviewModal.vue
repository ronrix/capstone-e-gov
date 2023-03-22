<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form class="backdrop-blur-md bg-white/50 sm:w-[700px] p-5 rounded-lg flex flex-col md:flex-row border" enctype="multipart/form-data">
      <!-- close modal btn -->
      <i @click="showPreviewModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!-- left -->
      <!-- news thumbnail -->
      <div class="overflow-hidden mt-5 group relative h-[100px] md:h-auto w-full md:w-1/2">
        <div class="overflow-hidden h-[300px] flex items-center justify-center">
          <Loading class="w-8 h-8" v-if="isLoading" />
          <img v-if="!isLoading" :src="imgSrc" alt="this is the thumbnail of news" class="align-middel shadow-lg">
        </div>
        <input  @change="handleSelectImg" ref="imgRef" type="file" class="hidden" >
        <button type="button" @click="selectNewImgFile" class="px-4 mt-3 self-end border border-blue-600 rounded-md font-bold capitalize text-sm hover:bg-blue-600 hover:text-white duration-75">upload new photo</button>
        <button @click="cancelNewImg" type="button" class="ml-3 hover:text-blu-600">cancel</button>
      </div>

      <!-- right -->
      <div class="flex-1 px-3 w-full flex flex-col justify-between">
        <!-- title -->
        <textarea v-model="formData.title" class="hover:overflow-y-scroll overflow-hidden scrollbar focus:outline-blue-600 bg-transparent capitalize w-full text-xl font-bold max-h-[71px]">{{ formData.title }}</textarea>
        <!-- date -->
        <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
        <!-- content -->
        <!-- <p @click="startEditing" class="text-sm mt-5 cursor-pointer overflow-scroll no-scrollbar h-[200px]">
          {{ selectedData?.content }}
        </p> -->
        <textarea v-model="formData.description" class="hover:overflow-y-scroll overflow-hidden scrollbar focus:outline-blue-600 bg-transparent capitalize py-3 w-full h-[200px] max-h-[200px] text-sm">{{ formData.description }}</textarea>

        <div class="self-end flex items-center justify-end mt-3">
          <button @click="setSubmitting" :disabled="isSubmitting" type="submit" :class="{'cursor-not-allowed' : isSubmitting}" class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold flex items-center">
            <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
            save
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import Loading from "./Loading.vue";
import { dateFormat } from '../utils/dateFormat';
import { useForm } from '@inertiajs/inertia-vue3';
import { be_url } from '../config/config';
import { validURL } from '../utils/validUrl';

const isLoading = ref(false);
const isSubmitting = ref(false);
// form state
// const imgSrc = ref(selectedData.img_link || "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png");
const imgSrc = ref(!selectedData?.img_link ? "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png" : validURL(selectedData.img_link) ? selectedData.img_link : be_url + "/" + selectedData.img_link); // : "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png";

const formData = useForm({
    imgFile: null,
    title: selectedData?.title,
    description: selectedData.description,
});

const { selectedData, handleSubmit } = defineProps({
  showPreviewModal: Function,
  selectedData: {},
  handleSubmit: Function
});

const date = dateFormat(selectedData?.created_at);

// show image preview
const imgRef = ref(null);
function selectNewImgFile() {
  imgRef.value.click();
}

// cancel the new selected image and go back to the default image
function cancelNewImg() {
  imgSrc.value = !selectedData?.img_link ? "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png" : validURL(selectedData.img_link) ? selectedData.img_link : be_url + "/" + selectedData.img_link;
}

function setSubmitting() {
  isSubmitting.value = true;

  // after the loading, then we can submit it now or call the handleSubmit
  setTimeout(() => {
    isSubmitting.value = false;
    handleSubmit(selectedData.id, formData);
  }, 1000);
}

// handle the change event for selecting an image file
function handleSelectImg(e) {
  imgSrc.value = URL.createObjectURL(e.target.files[0]);
  formData.imgFile = e.target.files[0];

  // set the loading animation for 1s
  isLoading.value = true;
  setTimeout(() => {
    isLoading.value = false;
  }, 1000);
}

// add scroll hidden on mount
onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});

</script>