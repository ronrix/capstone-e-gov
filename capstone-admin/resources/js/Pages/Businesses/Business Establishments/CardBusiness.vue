<template>
  <div
    class="relative overflow-hidden flex flex-col lg:flex-row justify-between w-full p-0 bg-white border-y-0 border-l-[6px] border-l-blue-600 mt-3">
    <!-- restore button -->
    <div v-if="data.deleted_at" @click="showRestoreModal"
      class="bg-blue-300 text-blue-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-blue-400 hover:text-blue-200 cursor-pointer">
      restore</div>

    <!-- delete button -->
    <div v-else @click="showDeleteVerificationModal"
      class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
      delete</div>

    <!-- restore -->
    <RestoreVerificationModal v-if="isRestoreModal" :close-modal="showRestoreModal" :handle-restore="handleRestore"
      :id="data.id" />

    <!-- delete -->
    <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
      :handle-delete="handleDelete" :id="data.id" />


    <!-- image -->
    <img class="h-[300px] max-h-[400px] w-full lg:w-[400px] object-cover" :src="imgSrc" alt="this is bulawan resort">
    <!-- content -->
    <div class="flex-1 px-5 pt-5 flex flex-col justify-between">
      <h3 class="font-bold capitalize text-xl tracking-wide">{{ data?.title }}</h3>
      <h5 class="text-sm text-gray-600 font-bold capitalize">By {{ data.authors }}</h5>
      <h5 class="text-xs text-gray-500 font-bold">{{ date }}</h5>
      <p v-bind:innerHTML="description" class="mt-5 text-xs whitespace-pre-wrap line-clamp-6"></p>
      <!-- button view -->
      <button @click="showPreviewModal(data)"
        class="w-[70px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5 lg:mt-10">view
      </button>
    </div>
  </div>
</template>

<script setup>
import { dateFormat } from '../../../utils/dateFormat';
import { formatImgs } from '../../../utils/formatImgs';

import { ref } from 'vue';
import { marked } from "marked";
import DOMPurify from 'dompurify';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import RestoreVerificationModal from '../../../Components/RestoreVerificationModal.vue';

// the first value of the img_links is a img link but it has a '"' on the first character 
// that's why i use replace method. 
// the first index of "img_link" will be the default thumbnail of the news data
const imgSrc = formatImgs(data.img_link.split(","))[0];
const date = dateFormat(data.created_at);
const description = DOMPurify.sanitize(marked.parse(data.description));

const isVerificationModal = ref(false);
const isRestoreModal = ref(false);

// function to handle the delete 
function showDeleteVerificationModal() {
  isVerificationModal.value = !isVerificationModal.value;
}

// function to handle the delete 
function showRestoreModal() {
  isRestoreModal.value = !isRestoreModal.value;
}
const { data } = defineProps({
  showPreviewModal: Function,
  handleDelete: Function,
  handleRestore: Function,
  data: Object,
});
</script>