<template>
    <!-- delete verfication modal -->
    <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="idx"
        :handleDelete="onDelete" />
    <!-- edit verification modal -->
    <EditVerification :close-modal="closeEditVerificationModal" v-if="isEditVerification" :data="editedInput"
        :handle-edit="onUpdatedProcess" />

    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md text-gray-700">
            <td class="">
                <textarea @change.capture="(e) => showEditVerification(e.target.value, idx, 'client_steps')"
                    v-model="clientSteps"
                    class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => showEditVerification(e.target.value, idx, 'agency_steps')"
                    v-model="agencySteps"
                    class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => showEditVerification(e.target.value, idx, 'fees')" v-model="fees"
                    class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => showEditVerification(e.target.value, idx, 'process_time')"
                    v-model="processTime"
                    class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => showEditVerification(e.target.value, idx, 'person_responsible')"
                    v-model="personResponsible"
                    class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td>
                <button @click="showDeleteVerificiationModal" type="button"
                    class="mx-auto bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button>
            </td>
        </tr>
    </tbody>
</template>

<script setup>
import { ref } from 'vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';
import EditVerification from '../../../Components/EditVerification.vue';

const isVerificationModal = ref(false);

// save verification on edit
const isEditVerification = ref(false);
const editedInput = ref({ value: "", id: null, type: "" });
function showEditVerification(inputValue, id, key) {
    editedInput.value.value = inputValue;
    editedInput.value.id = id;
    editedInput.value.type = key;

    isEditVerification.value = !isEditVerification.value;
}

// function to show the delete verfication modal
function showDeleteVerificiationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

function closeEditVerificationModal() {
    isEditVerification.value = false;

    agencySteps.value = data.agency_steps;
    clientSteps.value = data.client_steps;
    fees.value = data.fees;
    processTime.value = data.process_time;
    personResponsible.value = data.person_responsible;
}

// function to call by editverification, so after submission
// we can do something like hide the edit verification modal
function onUpdatedProcess(value, arrId, key) {
    handleUpdateProcess(value, arrId, key).then(() => {
        isEditVerification.value = false; // hide the edit verification modal
    });
}

// save 
// adding new function for delete so we can hide the verification modal after successfully delete attempt
function onDelete() {
    handleDeleteProcess(idx).then(() => {
        isVerificationModal.value = false;
    });
}

const agencySteps = ref(data.agency_steps);
console.log(data);
const fees = ref(data.fees);
const clientSteps = ref(data.client_steps);
const processTime = ref(data.process_time);
const personResponsible = ref(data.person_responsible);
const { handleUpdateProcess, handleDeleteProcess, idx, data } = defineProps({
    data: Array,
    handleUpdateProcess: Function,
    idx: Number,
    handleDeleteProcess: Function
});
</script>

<style scoped>
th,
td {
    border: 1px solid rgb(170, 166, 166);
}
</style>