<template>
    <div class="flex justify-between items-center mb-1 mt-2 gap-5">
        <!-- delete verfication modal -->
        <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="idx"
            :handleDelete="onDelete" />
        <!-- edit verification modal -->
        <EditVerification :close-modal="closeEditVerificationModal" v-if="isEditVerification" :data="editedInput"
            :handle-edit="onUpdateRequirement" />

        <input @change.capture="(e) => showEditVerification(e.target.value, idx, 0)" v-model="keyPropRef" type="text"
            class="text-xs sm:text-base w-full border outline-blue-600" />
        <input @change.capture="(e) => showEditVerification(e.target.value, idx, 1)" v-model="valueRef" type="text"
            class="text-xs sm:text-base w-full border outline-blue-600" />
        <div class="bg-white">
            <button @click="showDeleteVerificiationModal"
                class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-1 sm:px-3 text-xs sm:text-sm rounded-md">delete</button>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import EditVerification from "../../../Components/EditVerification.vue";

const keyPropRef = ref(keyProp);
const valueRef = ref(value);
const isVerificationModal = ref(false);
// function to show the delete verfication modal
function showDeleteVerificiationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

function closeEditVerificationModal() {
    isEditVerification.value = false;
    keyPropRef.value = keyProp;
    valueRef.value = value;
}

// save verification on edit
const isEditVerification = ref(false);
const editedInput = ref({ value: "", id: null, type: "", idx: null });
function showEditVerification(inputValue, id, valueId) {
    editedInput.value.value = inputValue;
    editedInput.value.id = id;
    editedInput.value.idx = valueId;

    isEditVerification.value = !isEditVerification.value;
}

// function to call by editverification, so after submission
// we can do something like hide the edit verification modal
function onUpdateRequirement(value, arrId, type, valueId) {
    handleUpdateRequirement(value, arrId, valueId).then(() => {
        isEditVerification.value = false; // hide the edit verification modal
    });
}

// adding new function for delete so we can hide the verification modal after successfully delete attempt
function onDelete() {
    handleDeleteRequirement(idx).then(() => {
        isVerificationModal.value = false;
    });
}

const { handleUpdateRequirement, handleDeleteRequirement, idx, keyProp, value } = defineProps({
    value: String,
    keyProp: String,
    handleUpdateRequirement: Function,
    idx: Number,
    handleDeleteRequirement: Function
});
</script>