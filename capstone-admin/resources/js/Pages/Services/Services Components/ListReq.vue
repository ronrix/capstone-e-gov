<template>
    <div class="flex justify-between items-center mb-1 mt-2 gap-2">
        <!-- delete verfication modal -->
        <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="idx" :handleDelete="onDelete" />

        <div class= "flex flex-row items-center flex-1">
            <i class="uil uil-check text-2xl mr-2 text-[#48742C]"></i>
            <input @change.capture="(e) => handleUpdateRequirement(e, idx)" v-model="title" type="text" class="text-xs sm:text-base w-full" />
        </div>      
        <div class="bg-white">
            <button @click="showDeleteVerificiationModal" class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-1 sm:px-3 text-xs sm:text-sm rounded-md">delete</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

const isVerificationModal = ref(false);
// function to show the delete verfication modal
function showDeleteVerificiationModal() {
  isVerificationModal.value = !isVerificationModal.value; 
}

// adding new function for delete so we can hide the verification modal after successfully delete attempt
function onDelete () {
    handleDeleteRequirement(idx).then(() => {
        isVerificationModal.value = false;
    });
}

const { handleDeleteRequirement, idx } = defineProps({ title: String, handleUpdateRequirement: Function, idx: Number, handleDeleteRequirement: Function });
</script>