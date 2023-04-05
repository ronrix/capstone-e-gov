<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <form class="backdrop-blur-xl bg-white/70 sm:w-[1000px] p-5 rounded-lg flex flex-col md:flex-row border" enctype="multipart/form-data">
      <!-- close modal btn -->
      <i @click="showPreviewModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!-- left -->
      <!-- news thumbnail -->
      <div class="overflow-hidden group relative md:h-auto w-full md:w-1/2 flex flex-col items-start justify-start">
        <div class="overflow-hidden h-[300px] max-h-[300px] flex items-center justify-center w-full border-2 border-blue-600 rounded-md">
          <Loading class="w-8 h-8" v-if="isLoading" />
          <img v-if="!isLoading" :src="imgSrc" alt="this is the thumbnail of news" class="align-middel shadow-lg w-full h-full">
        </div>
        <div class="flex items-start gap-2 sm:h-[150px] overflow-x-scroll scrollbar py-2 w-full el-main">
          <div v-for="img, idx in imgs"  :class="{ '!border-2 !border-blue-600': selectedImgId === idx }" class="border border-gray-500 p-2 rounded-md w-[50px] sm:w-[100px] h-[50px] sm:h-[100px] relative cursor-pointer">
            <!-- remove btn -->
            <div :id="idx" @click="handleRemoveImg" class="absolute -top-2 -right-2 cursor-pointer bg-red-600 flex items-center justify-center w-5 h-5 rounded-full hover:bg-red-500">
              <i class="uil uil-times text-white pointer-events-none"></i>
            </div>
            <img @click="handleSelectDefaultThumbnail" :id="idx" :src="img" alt="this is an image of something" class="w-full h-full prev-img">
          </div>
        </div>
        <div>
          <input  @change="handleSelectImg" ref="imgRef" type="file" class="hidden" >
          <button type="button" @click="selectNewImgFile" class="px-4 mt-3 self-end border border-blue-600 rounded-md font-bold capitalize text-sm hover:bg-blue-600 hover:text-white duration-75">upload new photo</button>
        </div>
      </div>

      <!-- right -->
      <div class="flex-1 pl-5 w-full flex flex-col justify-start mt-3 md:mt-0 gap-3">
        <div>
          <!-- title -->
          <textarea v-model="formData.title" class="hover:overflow-y-scroll overflow-hidden scrollbar focus:outline-blue-600 bg-transparent capitalize w-full text-xl font-bold max-h-[71px]">{{ formData.title }}</textarea>
          <!-- date -->
          <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
        </div>
        <!-- location, if exists -->
        <div>
          <span v-if="selectedData.location" class="font-[500] text-xs capitalize mt-2">address</span>
          <input v-if="selectedData.location" v-model="formData.location" class="hover:overflow-y-scroll overflow-hidden scrollbar focus:outline-blue-600 bg-transparent w-full text-sm">

          <!-- category -->
          <span v-if="selectedData.category" class="font-[500] text-xs capitalize mt-2">category</span>
          <input v-if="selectedData.category" v-model="formData.category" class="hover:overflow-y-scroll overflow-hidden scrollbar focus:outline-blue-600 bg-transparent w-full text-sm">
        </div>
        <!-- content -->
        <div class="h-full">
          <span class="font-[500] text-xs capitalize mt-3">
            content
            <button ref="editBtn" type="button" @click="startEditing" class="text-blue-600 cursor-pointer hover:text-blue-500 self-start text-xs ml-2">edit</button>
          </span>
          <div class="hover:overflow-y-scroll overflow-y-scroll scrollbar h-[300px]">
            <div ref="descEl" v-bind:innerHTML="description" class="text-sm"></div>
            <textarea ref="descText" @blur="stopEditing" v-model="formData.description" class="hidden overflow-y-scroll scrollbar bg-transparent py-3 w-full h-full text-sm outline-none">{{ formData.description }}</textarea>
          </div>
        </div>

        <div class="self-end flex items-center mb-0 mt-auto">
          <button @click="setSubmitting" :disabled="isSubmitting" type="submit" :class="{'cursor-not-allowed' : isSubmitting}" class="px-4 bg-blue-600 ml-3 text-white rounded-md font-bold flex items-center">
            <Loading color="#fff" class="w-5 h-5 mr-2" v-if="isSubmitting" />
            <span v-if="!isSubmitting">save</span>
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

import { marked } from "marked";
import DOMPurify from 'dompurify';
import { formatImgs } from '../utils/formatImgs';

const { selectedData, handleSubmit } = defineProps({
  showPreviewModal: Function,
  selectedData: {},
  handleSubmit: Function,
});

const descEl = ref(null);
const descText = ref(null);
const isLoading = ref(false);
const isSubmitting = ref(false);
const editBtn = ref(null);

// form state
const origImgSrc = formatImgs(selectedData.img_link.split(","));
const imgSrc = ref(origImgSrc[0]); // this is the big image to display, on default it will display the first img on the array
const imgs = ref(origImgSrc);
const selectedImgId = ref(0);
const deleteImgIds = ref([]);

// when img is selected to be the default thumbnail, it will the first element on the formData.imgFile
// user should expect one selected img
function handleSelectDefaultThumbnail(e) {
  // remove first, the styles from other imgs
  // it will remove the border set to the selected imgs, if user clicks on another img
  document.querySelectorAll(".prev-img").forEach(el => {
    el.parentElement.classList.remove("!border-blue-600");
    el.parentElement.classList.remove("!border-2");
  });

  // select the img
  e.target.parentElement.classList.toggle("!border-blue-600");
  e.target.parentElement.classList.toggle("!border-2");
  // TODO: put the selected img on the first index of formData.imgFile
  // splice or delete the selected img first and store it to a variable
  const selectedImg = imgs.value[e.target.id]; // get the selected img 
  imgSrc.value = selectedImg; // change the displayed image

  selectedImgId.value = parseInt(e.target.id); // store the selected id for remove functionality
  formData.defaultThumbnailId = selectedImgId.value;
}

function handleRemoveImg(e) {
  const id = parseInt(e.target.id);
  imgs.value.splice(id, 1);
  deleteImgIds.value.push(id); // add the id of the deleted img

  // if there are no imgs in the "imgs" state, display the default img 
  if(!imgs.value.length) {
    imgSrc.value = "https://cdn4.iconfinder.com/data/icons/ionicons/512/icon-image-512.png";
    return;
  }

  // after removing the img, select the first image, if no img exist then display the default one
  // if the stored id of the selected img is equal to the one to be removed
  if(selectedImgId.value === id) {
    imgSrc.value = imgs.value[0];
    selectedImgId.value = 0;
    formData.defaultThumbnailId = selectedImgId.value;
  }
}

const formData = useForm({
    newImgs: [],
    defaultThumbnailId: selectedImgId.value,
    deletedImgIds: deleteImgIds.value,
    title: selectedData?.title,
    location: selectedData.location,
    category: selectedData.category,
    description: selectedData.description,
});

// sanitazing the markdown html strings so that it can render correctly in the DOM
const description = ref(DOMPurify.sanitize(marked.parse(formData.description)));

// this function is for "description". when p tag is clicked it will turn the element to textarea for editing
function startEditing(e) {
  descEl.value.classList.add("hidden");
  descText.value.classList.remove("hidden");
  descText.value.focus();
  editBtn.value.classList.add("hidden") // hide the edit btn
}
function stopEditing(e) {
  editBtn.value.classList.remove("hidden") // remove hidden class of edit btn
  descEl.value.classList.remove("hidden"); // show the desc
  e.target.classList.add("hidden"); // hide the textarea
}

const date = dateFormat(selectedData?.created_at);

// show image preview
const imgRef = ref(null);
function selectNewImgFile() {
  imgRef.value.click();
}

function setSubmitting() {
  isSubmitting.value = true;
  description.value = DOMPurify.sanitize(marked.parse(formData.description)); // update the div content

  // after the loading, then we can submit it now or call the handleSubmit
  setTimeout(() => {
    isSubmitting.value = false;
    handleSubmit(selectedData.id, formData);
  }, 1000);
}

// handle the change event for selecting an image file
function handleSelectImg(e) {
  imgs.value.push(URL.createObjectURL(e.target.files[0]));
  formData.newImgs.push(e.target.files[0]);

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