<template>
    <HeadTitle title="BPLO"></HeadTitle>
    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

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
        <BPermit v-for="permit in dataRequirements" :tableId="permit.id" :title="permit.title"
            :requirements="permit.requirements" class="mb-3" :handleUpdatePermit="handleUpdatePermit"
            :handleUpdatePermitTitle="handleUpdatePermitTitle" :saveNewRequirement="saveNewRequirement"
            :handleDeleteWholePermit="handleDeleteWholePermit" :handleDeleteRequirement="handleDeleteRequirement"
            :handleDeleteSectionPermit="handleDeleteSectionPermit"
             />
        <AddPermit v-if="isPermitModal" :showPermitModal="showPermitModal" />
        <AddPDF v-if="isAddPDF" :closeAddPDF="showAddPDF" />

    </WrapperContent>
</template>

<script setup>
import AddPDF from './BPLOFormComponents/AddPDF.vue';
import AddPermit from './BPLOFormComponents/AddPermit.vue';
import BPermit from './BPLOFormComponents/BPermit.vue';
import { ref, onMounted } from 'vue';
import axios from "axios";
import { be_url } from "../../../config/config";
import Notifcation from '../../../Components/Notifcation.vue';

const dataRequirements = ref([]);
const isPermitModal = ref(false);
const isAddPDF = ref(false);
const resMsg = ref();

function showPermitModal() {
    isPermitModal.value = !isPermitModal.value;
}

function showAddPDF() {
    isAddPDF.value = !isAddPDF.value;
}

// this is a function to handle the updating of permit data
function handleUpdatePermitTitle(e, id) {
    axios.post(be_url + "/permit/title/edit", {
        id,
        newTitle: e.target.value
    })
        .then(({ data }) => {
            console.log(data);
        })
        .catch(err => console.log(err));
}

// function to save new added requirement
function saveNewRequirement(value, tableId, perId, div) {
    axios.post(be_url + "/permit/add/requirement", {
        tableId,
        perId,
        value
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataRequirements.value = data.permits;

            // after successfully adding new requirement
            // remove the new input added
            div.remove();
        })
        .catch(err => console.log(err));
}

// this is a function to handle the updating of permit data
function handleUpdatePermit(e, tableId, perId, reqId, isReq) {
    axios.post(be_url + "/permit/edit", {
        tableId,
        perId,
        reqId,
        newValue: e.target.value,
        isReq,
    })
        .then(({ data }) => {
            console.log(data);
        })
        .catch(err => console.log(err));
}

// this function is to delete the whole permit
function handleDeleteWholePermit(tableId) {
    axios.post(be_url + "/delete-whole-permit", {
        tableId,
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataRequirements.value = data.permits;
        })
        .catch(err => console.log(err));
}

// this function is to delete the one requirement
function handleDeleteSectionPermit(tableId, permitKey) {
    axios.post(be_url + "/delete-section-permit", {
        tableId,
        permitKey,
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataRequirements.value = data.permits;
        })
        .catch(err => console.log(err));
}

// this function is to delete the one requirement
function handleDeleteRequirement(tableId, permitKey, reqId) {
    axios.post(be_url + "/delete-permit-req", {
        tableId,
        permitKey,
        reqId,
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataRequirements.value = data.permits;
        })
        .catch(err => console.log(err));
}

// get all the permits from the server
onMounted(() => {
    axios.get(be_url + "/permits")
        .then(({ data }) => {
            dataRequirements.value = data.permits;
        })
});

</script>