<template>
    <HeadTitle title="BPLO"></HeadTitle>


    <WrapperContent>
        <!--For File-->
        <div class="flex flex-cols items-center">
            <span class="font-bold text-2xl text-gray-500 mr-5">Application Form</span>
            <div class="flex-1 border"></div>
        </div>
        <div class="flex flex-col">
            <a class=" inline-block mt-3 text-blue-600 mr-2 font-semibold p-1">
                application_form.pdf
            </a>
            <div class="flex flex-row self-end">
                <button
                class="w-[100px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase mt-5"
                @click="showAddPDF">
                Add Form
            </button>
           
             <button
            class="w-[120px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end uppercase"
            @click="showPermitModal">
            Add Permit
        </button> 
            </div>
           
        </div>


        <!--For Permit-->
        <!-- to get "title" and "requirements", you have to use defineProps inside the component file BPermit -->
        <BPermit v-for="permit in requirements" :title="permit.title" :requirements="permit.requirements" class="mb-3"/>
        <AddPermit v-if="isPermitModal" :showPermitModal="showPermitModal"/>
        <AddPDF v-if="isAddPDF" :closeAddPDF="showAddPDF"/>

    </WrapperContent>
</template>

<script setup>
import AddPDF from './BPLOFormComponents/AddPDF.vue';
import AddPermit from './BPLOFormComponents/AddPermit.vue';
import BPermit from './BPLOFormComponents/BPermit.vue';
import { ref } from 'vue';

const isPermitModal = ref(false);
const isAddPDF = ref(false);
function showPermitModal() {
    isPermitModal.value = ! isPermitModal.value;
}

function showAddPDF() {
    isAddPDF.value = !isAddPDF.value;
}


const requirements = [
    {
        title: "amending permit",
        requirements: ["proof of enrollment", "copy of grades of last semester", "photocopy of school ID", "letter of requeset"]
    },
    {
        title: "renewing permit",
        requirements: ["proof of enrollment", "copy of grades of last semester", "photocopy of school ID", "letter of requeset"]
    }
]

</script>

<style lang="scss" scoped></style>