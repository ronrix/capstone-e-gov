<template>
       
            <!-- table -->
            <table class="table-auto w-full mt-5">
        <slot></slot>
            </table>
            <!-- add new btn -->
            <button @click="showServiceModal"
                class="w-full md:w-[95px] border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end mt-5 flex items-center justify-center rounded-lg px-5 uppercase text-md font-bold">
                new
                <i class="uil uil-plus-circle m-0 ml-2"></i>
            </button>
             <!-- Services Modal -->
    <ServicesModal v-if="isServiceModal" :showServiceModal="showServiceModal"/>
</template>

<script setup>
import ServicesModal from './ServicesModal.vue';
import { ref } from 'vue';

const isServiceModal = ref(false);
function showServiceModal() {
  isServiceModal.value = ! isServiceModal.value;
}

</script>

<style scoped>

</style>