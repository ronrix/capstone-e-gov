<template>
    <div class="bg-white rounded-md gap-2 p-3 duration-75">

        <!-- delete verfication modal -->
        <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="tableId"
            :handleDelete="handleDelete" />

        <AddSectionModal v-if="isAddNewSection" :close-modal="showAddNewSection"
            :handle-add-new-section-permit="handleAddNewSectionPermit" :id="tableId" />

        <EditModal v-if="isShowEditModal" :close-modal="showEditModal" :data="permit"
            :handle-update-permit="handleUpdatePermit" :table-id="tableId" />

        <div>
            <div class="flex  flex-col relative">
                <h3 class="font-[600] text-lg capitalize">{{ permit.title }}</h3>
                <p>{{ permit.description }}</p>
                <div class="mt-3 marked-desc line-clamp-5"
                    :innerHTML="DOMPurify.sanitize(marked.parse(permit.requirements))"></div>

                <!-- delete btn -->
                <button @mouseleave="handleMouseLeave" @mouseenter="handleMouseEnter" @click="showDeleteVerificiationModal"
                    class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md absolute right-0 top-0">
                    delete
                </button>

                <!-- view to edit btn -->
                <button @click="showEditModal" class="bg-blue-600 text-white px-3 text-sm rounded-md capitalize self-end">
                    edit
                </button>
            </div>

        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../../Components/DeleteVerificationModal.vue';
import AddSectionModal from './AddSectionModal.vue';
import EditModal from './EditModal.vue';

import { marked } from "marked";
import DOMPurify from "dompurify";

const isVerificationModal = ref(false);
const isShowEditModal = ref(false);

function showEditModal() {
    isShowEditModal.value = !isShowEditModal.value
}

// add hover background
function handleMouseEnter(e) {
    e.target.parentElement.parentElement.parentElement.classList.add("!bg-red-500");
    e.target.parentElement.parentElement.parentElement.classList.add("text-white");
}
function handleMouseLeave(e) {
    e.target.parentElement.parentElement.parentElement.classList.remove("!bg-red-500");
    e.target.parentElement.parentElement.parentElement.classList.remove("text-white");
}

// to handle the delete of the whole permit
async function handleDelete() {
    await handleDeleteWholePermit(tableId);
    // hide the delete verification modal
    isVerificationModal.value = false;
}

// function to toggle the delete verification modal
function showDeleteVerificiationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

const { tableId, handleDeleteWholePermit } = defineProps({
    permit: Object,
    tableId: Number,
    handleUpdatePermit: Function,
    handleDeleteWholePermit: Function,
})
</script>


<style>
.marked-desc h4 {
    font-size: 1em;
    font-weight: bold;
}

.marked-desc ul {
    list-style-type: disc;
    margin-left: 1em;
}
</style>