<template>
    <div class="bg-white rounded-md gap-2 p-3 duration-75">

        <!-- delete verfication modal -->
        <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="tableId"
            :handleDelete="handleDelete" />

        <AddSectionModal v-if="isAddNewSection" :close-modal="showAddNewSection"
            :handle-add-new-section-permit="handleAddNewSectionPermit" :id="tableId" />

        <WrapperReq>
            <div class="flex items-center">
                <input type="text" @change.capture="(e) => handleUpdatePermitTitle(e, tableId)" :value="title"
                    class="font-bold text-base sm:text-xl text-gray-500 mr-5 uppercase outline-blue-600 flex-1 bg-transparent" />

                <!-- delete btn -->
                <button @mouseleave="handleMouseLeave" @mouseenter="handleMouseEnter"
                    @click="showDeleteVerificiationModal('whole', null, null)"
                    class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md rotate-180">
                    <i class="uil uil-cancel"></i>
                </button>
            </div>
            <!-- requirements -->
            <div v-for="lists, key, id  in JSON.parse(requirements)" :key="id" :id="key" class="mt-5">
                <div class="flex items-center">
                    <input type="text" @change.capture="(e) => handleUpdatePermit(e, tableId, id, null, false)" :value="key"
                        class="text-sm sm:text-base flex-1 outline-blue-600 capitalize font-[500] w-full bg-transparent">
                    <!-- delete btn -->
                    <button @mouseleave="handleMouseLeave2" @mouseenter="handleMouseEnter2"
                        @click="showDeleteVerificiationModal('section', key, null)"
                        class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md rotate-180">
                        <i class="uil uil-cancel pointer-events-none"></i>
                    </button>
                </div>
                <div class="border-2 border-y-0 border-r-0 border-blue-600 pl-3">
                    <BList v-for="list, reqId in lists" :key="reqId" :list="list" :permitKey="key" :perId="id"
                        :reqId="reqId" :handleUpdatePermit="handleUpdatePermit" :tableId="tableId"
                        :showDeleteVerificiationModal="showDeleteVerificiationModal" />
                    <!-- add new requirement -->
                    <button @click="(e) => addNewRequirement(e, id)"
                        class="bg-blue-600 text-white hover:bg-bue-500 hover:text-white px-3 text-sm rounded-md mt-5">
                        <i class="uil uil-plus pointer-events-none"></i>
                    </button>
                </div>
            </div>

            <!-- add new permit section btn -->
            <button type="button" @click="showAddNewSection"
                class="bg-blue-600 text-white hover:bg-bue-500 hover:text-white px-3 text-sm rounded-md mt-5">
                <i class="uil uil-plus pointer-events-none"></i>
                Add new section
            </button>
        </WrapperReq>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../../Components/DeleteVerificationModal.vue';
import BList from './BList.vue';
import AddSectionModal from './AddSectionModal.vue';

const isVerificationModal = ref(false);
const deleteType = ref("");
const permitKey = ref();
const requirementId = ref();

// show the add new section for one permit
// so users can add new section of permit { "section": ["requirements", "requirements"] }
const isAddNewSection = ref(false);
function showAddNewSection() {
    console.log("clicked");
    isAddNewSection.value = !isAddNewSection.value;
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

// add hover background on section of the permit
function handleMouseEnter2(e) {
    e.target.parentElement.parentElement.classList.add("!bg-red-500");
    e.target.parentElement.parentElement.classList.add("text-white");
}
function handleMouseLeave2(e) {
    e.target.parentElement.parentElement.classList.remove("!bg-red-500");
    e.target.parentElement.parentElement.classList.remove("text-white");
}

// this function adds new requirement
function addNewRequirement(e, id) {
    const div = document.createElement("div");
    const input = document.createElement('input');
    const cancelBtn = document.createElement('button');
    const saveBtn = document.createElement('button');

    saveBtn.textContent = "save";
    cancelBtn.textContent = "cancel";

    input.className = "border text-base font-normal flex-1 outline-blue-600 capitalize bg-transparent px-2 py-1 rounded-md";
    saveBtn.className = "bg-green-100 text-green-600 hover:bg-green-600 hover:text-white px-3 text-sm rounded-md text-white";
    cancelBtn.className = "bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md text-white";

    div.className = "flex justify-between items-center mb-1 mt-2 gap-2 duration-75";
    div.appendChild(input);
    div.appendChild(saveBtn)
    div.appendChild(cancelBtn)

    // focus the input
    input.focus();

    // TODO: function for save btn
    saveBtn.addEventListener("click", (e) => saveNewRequirement(input.value, tableId, id, div));

    // TODO: function for cancel btn or remove the new added input
    cancelBtn.addEventListener("click", function (e) {
        div.remove();
    });

    e.target.parentElement.insertBefore(div, e.target);
}

// to handle the delete of the whole permit
async function handleDelete() {
    if (deleteType.value === "whole") {
        await handleDeleteWholePermit(tableId);
    }
    else if (deleteType.value === "section") {
        await handleDeleteSectionPermit(tableId, permitKey.value);
    }
    else {
        await handleDeleteRequirement(tableId, permitKey.value, requirementId.value);
    }

    // hide the delete verification modal
    isVerificationModal.value = false;
}

// function to toggle the delete verification modal
function showDeleteVerificiationModal(type, perId, reqId) {
    isVerificationModal.value = !isVerificationModal.value;
    deleteType.value = type;
    permitKey.value = perId;
    requirementId.value = reqId;
}

const { saveNewRequirement, tableId, handleDeleteRequirement, handleDeleteSectionPermit, handleDeleteWholePermit } = defineProps({
    title: String,
    tableId: Number,
    requirements: Array,
    handleUpdatePermit: Function,
    handleAddNewSectionPermit: Function,
    handleUpdatePermitTitle: Function,
    handleDeleteWholePermit: Function,
    handleDeleteRequirement: Function,
    handleDeleteSectionPermit: Function,
    saveNewRequirement: Function,
})
</script>