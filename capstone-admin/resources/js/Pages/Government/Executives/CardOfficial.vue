<template>
  <div class="flex flex-col bg-white rounded-md p-3 shadow-md relative overflow-hidden w-[250px] h-[300px]">

    <!-- delete button -->
    <div @click="showDeleteVerificationModal"
      class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-1 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
      delete</div>

    <!-- delete -->
    <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
      :handle-delete="handleDelete" :id="official.id" />

    <div class="overflow-hidden h-full flex-1">
      <img class="w-[250px] h-full mx-auto rounded-md object-cover" :src="imgSrc" :alt="official.name">
    </div>
    <h5 class="text-gray-500 text-sm font-bold uppercase mt-3 whitespace-pre-wrap">{{ official.position }}
    </h5>

    <p class="text-gray-600 text-xs font-[500] capitalize">
      term
      ({{ new Date(official.start_term).getFullYear() }} - {{ new Date(official.end_term).getFullYear() }})
    </p>
    <h3 class="text-gray-800 text-sm sm:text-xl font-bold capitalize">{{ official.executive_name }}</h3>

  </div>
</template>

<script setup>
import { ref } from 'vue';
import { be_url } from '../../../config/config';
import { validURL } from "../../../utils/validUrl";
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

const isVerificationModal = ref(false);
const imgSrc = validURL(official.img_link) ? official.img_link : be_url + "/" + official.img_link; // : "https://www.nbmchealth.com/wp-content/uploads/2018/04/default-placeholder.png";

// function to handle the delete 
function showDeleteVerificationModal() {
  isVerificationModal.value = !isVerificationModal.value;
}

const { official } = defineProps({
  official: Object,
  handleDelete: Function,
})
</script>