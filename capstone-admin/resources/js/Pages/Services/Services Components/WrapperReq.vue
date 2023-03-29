<template>
    <div class="bg-white rounded-lg p-4">
        <div class="grid grid-cols-1 lg:grid-cols-2">

            <slot></slot>
        </div>
          <!-- add new btn -->
          <div class="flex flex-col ">
                <button @click="showRequirementModal"
                class="w-full md:w-[95px] border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end mt-5 flex items-center justify-center rounded-lg px-5 uppercase text-md font-bold">
                new
                <i class="uil uil-plus-circle m-0 ml-2"></i>
            </button>
             </div>
             
             <!-- Services Modal -->
    <RequirementsModal v-if="isRequirementModal" :showRequirementModal="showRequirementModal"/>
    </div>
</template>

<script setup>
import RequirementsModal from './RequirementsModal.vue';
import { ref } from 'vue';

const isRequirementModal = ref(false);
function showRequirementModal() {
    isRequirementModal.value = ! isRequirementModal.value;
}
</script>

<style lang="scss" scoped></style>