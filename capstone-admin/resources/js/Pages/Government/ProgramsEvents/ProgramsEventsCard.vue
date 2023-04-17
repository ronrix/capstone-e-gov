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
    <div :style="{ backgroundImage: `url(${imgSrc})` }"
      class="bg-no-repeat bg-cover bg-center h-[350px] max-h-[400px] w-full md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm after:block md:after:hidden">
    </div>
    <!-- content -->
    <div class="flex-1 flex flex-col px-5 justify-between">
      <div>
        <p class="text-gray-500 text-sm">
          <span class="font-bold text-blue-600">
            <i class="uil uil-archive"></i>
            Programs and Events
          </span>
          {{ data.date }}
        </p>
        <h5 class="font-bold mt-2 capitalize line-clamp-3">{{ data.title }}</h5>

        <p class="mb-3 text-sm font-[500] capitalize">
          {{ data.location }}
        </p>
      </div>
      <div v-bind:innerHTML="description" class="text-sm text-gray-700 h-[100px] overflow-hidden line-clamp-5"></div>
      <button @click="showPreviewModal(data)"
        class="active:-translate-y-[1px] mb-2 bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase rounded-md">
        view
      </button>
    </div>
  </div>
</template>

<script setup>
import { formatImgs } from "../../../utils/formatImgs";

import { ref } from "vue";
import { marked } from "marked";
import DOMPurify from "dompurify";
import RestoreVerificationModal from "../../../Components/RestoreVerificationModal.vue";
import DeleteVerificationModal from "../../../Components/DeleteVerificationModal.vue";

const isVerificationModal = ref(false);
const isRestoreModal = ref(false);
const origImgSrc = formatImgs(data.img_link.split(","));
const imgSrc = origImgSrc[0];
const description = DOMPurify.sanitize(marked.parse(data.description));

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