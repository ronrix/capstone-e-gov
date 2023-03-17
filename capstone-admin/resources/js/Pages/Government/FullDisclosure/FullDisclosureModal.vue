<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative">
      <!-- close modal btn -->
      <i @click="showModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h4 class="font-bold text-xl capitalize text-gray-800">Upload new report</h4>

      <!-- form -->
      <form @submit.prevent="" class="flex flex-col gap-3">
        <div class="w-full mt-3">
          <p class="text-sm text-gray-500 font-bold">select the category of the report you are going to upload</p>
          <select class="w-full p-3 mb-2 capitalize focus:outline focus:outline-blue-600">
            <option v-for="cat in categories" :value="cat">{{ cat }}</option>
          </select>
        </div>
        <label class="flex flex-col">
          <p class="text-sm text-gray-500 font-bold flex items-center">
            Upload PDF File
            <button @click="showInputFileSelection" class="ml-3 border text-white bg-blue-600 text-left p-3 rounded-full w-5 h-5 flex items-center justify-center">
              <i class="uil uil-plus-circle"></i>
            </button>
          </p>
          <input ref="inputFile" @change="handleSelectFile" type="file" class="hidden" />
        </label>

        <!-- display the selected file -->
        <div v-if="file.length" class="flex items-center text-sm text-gray-600">
          {{ file }}

          <!-- close modal btn -->
          <i @click="removeSelectedFile" class="uil uil-times cursor-pointer text-red-600 bg-red-200 rounded-full w-5 h-5 flex items-center justify-center ml-3"></i>
        </div>

        <input type="submit" value="Save" class="p-3 bg-blue-600 text-white font-bold">
      </form>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const file = ref("");
const inputFile = ref(null);
const categories = [
  "annual report",
  "statement of debt service"
]

function showInputFileSelection() {
  // will click the hidden input file to show the file selection
  inputFile.value.click();
}

function handleSelectFile() {
  // get the file name of the selected file
  file.value = inputFile.value.files[0].name
}

function removeSelectedFile() {
  // reset the value of inputFile and file state
  inputFile.value = "";
  file.value = "";
}

defineProps({
  showModal: Function
})
</script>