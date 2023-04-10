<template>
    <!-- delete verfication modal -->
    <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="idx" :handleDelete="onDelete" />

    <tbody class="text-left">
        <tr class="text-xs md:text-sm lg:text-md text-gray-700">
            <td class="">
                <textarea @change.capture="(e) => handleUpdateProcess(e, idx, 'client_steps')" v-model="data.client_steps" class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => handleUpdateProcess(e, idx, 'agent_steps')" v-model="data.agent_steps" class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => handleUpdateProcess(e, idx, 'fees')" v-model="data.fees" class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td class="text-center">
                <textarea @change.capture="(e) => handleUpdateProcess(e, idx, 'process_time')" v-model="data.process_time" class="p-2 w-full min-h-[200px] max-h-[200px] focus:outline-blue-500 py-3 overflow-scroll no-scrollbar"></textarea>
            </td>
            <td>
                <button @click="showDeleteVerificiationModal" type="button" class="mx-auto bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">delete</button>
            </td>
        </tr>
    </tbody>
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
    handleDeleteProcess(idx).then(() => {
        isVerificationModal.value = false;
    });
}

const { handleDeleteProcess, idx } = defineProps({ data: Array, handleUpdateProcess: Function, idx: Number, handleDeleteProcess: Function });
</script>

<style scoped>
th, td {
    border: 1px solid rgb(170, 166, 166);
}
</style>