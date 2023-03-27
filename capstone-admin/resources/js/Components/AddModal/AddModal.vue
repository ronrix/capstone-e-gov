<template>
  <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-50 z-20">
    <div class="backdrop-blur-xl bg-white/70 sm:w-[700px] mx-auto p-5 flex flex-col relative overflow-hidden rounded-lg">
      <!-- close btn -->
      <i @click="showAddModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h2 class="font-bold text-2xl capitalize mb-0 text-gray-900">Create new {{ title }}</h2>
      <p class="text-sm text-gray-600 whitespace-pre-wrap"> 
        To format for your content appropriately, you should understand how markdown works
      </p>
      <!-- link to go the markdown document -->
      <a target="_blank" href="https://www.markdownguide.org/basic-syntax/" class="m-0 text-sm mb-5 text-blue-600 underline font-[500] self-start">
        <i class="uil uil-info-circle"></i>
        click here to learn how to format your contents
      </a>

      <form method="POST" action="/create-news" @submit.prevent="onSubmit" class="flex flex-col">
        <label class="flex flex-col">
          <span class="text-sm font-bold capitalize mb-2">title:</span>
          <input v-model="formData.title" name="title" type="text" placeholder="Type the title here..." class="rounded-md mb-5 p-2 focus:outline-blue-600">
          <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.title.$errors[0].$message }} </p>
        </label>
        <label v-if="location" class="flex flex-col">
          <span class="text-sm font-bold capitalize mb-2">location:</span>
          <input v-model="formData.location" name="title" type="text" placeholder="Type the title here..." class="rounded-md mb-5 p-2 focus:outline-blue-600">
          <p v-if="v$.location.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.location.$errors[0].$message }} </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold capitalize mb-2">content:</span>
          <textarea v-model="formData.content" name="description" placeholder="Type the content here..." class="rounded-md p-2 h-[80px] sm:max-h-[200px] focus:outline-blue-600 scrollbar touch-auto"></textarea>
          <p v-if="v$.content.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.content.$errors[0].$message }} </p>
        </label>

        <!-- imput options -->
        <!-- when this clicked it will show choices of elements, when one is clicked it will add new element to the form -->
        <div class="flex items-start mt-5 flex-col gap-2">
          <!-- text instructions -->
          <div>
            <h5 class="text-gray-800 text-sm font-[500] capitalize">Image Assets</h5>
            <p class="text-gray-500 text-xs font-[500]">Click one of the image to select the default thumbnail</p>
            <p v-if="v$.imgFile.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.imgFile.$errors[0].$message }} </p>
          </div>

          <div class="flex items-center w-full gap-2">
            <!-- TODO: add images here -->
            <div ref="assetDiv" class="flex items-start flex-wrap gap-2 sm:h-[150px] overflow-y-scroll py-2 scrollbar w-full el-main">
              <div v-for="img, idx in toUploadImgs" class="border border-gray-500 p-2 rounded-md w-[50px] sm:w-[100px] h-[50px] sm:h-[100px] relative cursor-pointer">
                <!-- remove btn -->
                <div :id="idx" @click="handleRemoveImg" class="absolute -top-2 -right-2 cursor-pointer bg-red-600 flex items-center justify-center w-5 h-5 rounded-full hover:bg-red-500">
                  <i class="uil uil-times text-white pointer-events-none"></i>
                </div>
                <img @click="handleSelectDefaultThumbnail" :id="idx" :src="img" alt="this is an image of something" class="w-full h-full prev-img">
              </div>
              <!-- upload btn -->
              <div @click="addNewImg" class="text-center flex items-center justify-center rounded-md px-2 border-blue-600 cursor-pointer border-2 ml-2 w-[50px] sm:w-[100px] h-[50px] sm:h-[100px] el-btn">
                  <i class="uil uil-image-plus text-2xl sm:text-5xl pointer-events-none"></i>
                </div>
              </div>
            </div>

        </div>

        <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }" class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center">
          <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
          save
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted, computed } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import Loading from "../Loading.vue";

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"

// adding rules for validation of the form
const rules = computed(() => ({
    title: { required: helpers.withMessage("The field title is required", required) },
    location: { required: helpers.withMessage("The field location is required", required) },
    content: { required: helpers.withMessage("The field content is required", required) },
    imgFile: { 
      required: helpers.withMessage("The image is required", required), 
      array: helpers.withMessage("At least one image file is reuqired", (value) => value.length > 0), 
    },
}));

const isSubmitting = ref(false);
const assetDiv = ref(null);
const formData = useForm({
  title: "",
  location: "",
  content: "",
  imgFile: [],
});
const toUploadImgs = ref([]);
const isError = ref(false);
const v$ = useVuelidate(rules, formData);

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
  const selectedImg = formData.imgFile[e.target.id]; // get the selected img before deleting it
  delete formData.imgFile[e.target.id]; // delete the selected img
  formData.imgFile.splice(0, 0, selectedImg); // this put the selected img on the first index
}

function handleRemoveImg(e) {
  formData.imgFile.splice(e.target.id, 1);
  toUploadImgs.value.splice(e.target.id, 1);
}

// handle change event for input file
function handleChangeEvent(e) {
  const file = e.target.files[0];
  formData.imgFile.push(file);
  toUploadImgs.value = formData.imgFile.map(img => URL.createObjectURL(img)); // this state will copy the formData.imgFile but in createObjectURL to display to the DOM
}

// adding new element to the form
function addNewImg() {
  const el = document.createElement("input");
  el.type = "file";
  el.name = "img";
  el.classList.add('hidden');
  el.onchange = (e) => handleChangeEvent(e);
  el.click();
}

// add scroll hidden on mount and fix the style when vh is <= 630px so the "AddModal"
// is not going to overflow on the screen
onMounted(() => {
  document.body.classList.add("overflow-hidden");

  // Get the viewport height
  const vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);

  // Check if the viewport height is below 600px
  if (vh <= 630) {
    // Update the style of the elements
    const elMain = document.querySelector(".el-main");
    elMain.style.height = "80px";
    elMain.classList.add("small");

    const elBtn = document.querySelector(".el-btn");
    elBtn.firstElementChild.classList.add("!text-2xl");
  }
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});

async function onSubmit() {
 // invoke validation
  // return when not inputs are not valid
  const valid = await v$.value.$validate();
  if (!valid) {
    isError.value = true;
    return;
  }

  return;
  isSubmitting.value = true;
  if(isError.value) isError.value = false; // remove the error message from displaying when validation passed
  handleCreateSubmit(formData).then(data => {
    if(data.res.status >= 400) {
      formData.imgFile = null;
      selectedImg.value = "";
      return;
    }
    isSubmitting.value = false;
    formData.reset();
    toUploadImgs.value = [];
  });
}

const { handleCreateSubmit } = defineProps({
  showAddModal: Function,
  handleCreateSubmit: Function,
  title: String,
  location: Boolean,
})
</script>

<style scoped>
div.el-main.small > * {
  height: 50px;
  width: 50px;
}
</style>