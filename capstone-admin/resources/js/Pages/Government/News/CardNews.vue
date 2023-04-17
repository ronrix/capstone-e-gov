<template>
  <div
    class="relative overflow-hidden flex flex-col md:flex-row shadow-md bg-white border border-r-0 border-y-0 border-l-[5px] border-l-blue-600">

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
    <!-- <div :style="{ backgroundImage: `url(${imgSrc})` }"
      class="bg-no-repeat bg-cover bg-center flex-1 w-full object-cover h-[200px] sm:h-auto"> -->
    <div class="flex-1">
      <img :src="imgSrc" alt="this is the thumbnail of this news" class="object-cover h-full">
    </div>
    <!-- </div> -->
    <!-- content -->
    <div class="flex-1 px-5 pt-5 flex flex-col justify-between gap-3 overflow-hidden">
      <div>
        <h3 class="font-bold capitalize text-xl tracking-wide">
          {{ data.title }}
        </h3>
        <h5 class="text-sm text-gray-600 font-bold capitalize">By {{ data.authors }}</h5>
        <h5 class="text-xs text-gray-500">{{ date }}</h5>
      </div>
      <p class="text-xs overflow-hidden whitespace-pre-wrap h-[100px] marked-desc" v-bind:innerHTML="description">
      </p>
      <button @click="showPreviewModal(data)"
        class="active:-translate-y-[1px] mb-2 rounded-md bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">
        view
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { dateFormat } from "../../../utils/dateFormat";
import { validURL } from "../../../utils/validUrl";
import { be_url } from "../../../config/config";
import DeleteVerificationModal from "../../../Components/DeleteVerificationModal.vue";
import RestoreVerificationModal from "../../../Components/RestoreVerificationModal.vue";

import { marked } from "marked";
import DOMPurify from "dompurify";

const isVerificationModal = ref(false);
const isRestoreModal = ref(false);
const description = DOMPurify.sanitize(marked.parse(data.description));

// function to handle the delete 
function showDeleteVerificationModal() {
  isVerificationModal.value = !isVerificationModal.value;
}

// function to handle the delete 
function showRestoreModal() {
  isRestoreModal.value = !isRestoreModal.value;
}

// the first value of the img_links is a img link but it has a '"' on the first character
// that's why i use replace method.
// the first index of "img_link" will be the default thumbnail of the news data
const imgSrc = ref(validURL(data.img_link.split(",")[0].replace('"', ""))
  ? data.img_link.split(",")[0]
  : be_url + "/" + data.img_link.split(",")[0].replace('"', "")); // : "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png";

const date = dateFormat(data.created_at);

const { data } = defineProps({
  showPreviewModal: Function,
  data: Object,
  handleDelete: Function,
  handleRestore: Function,
});
</script>