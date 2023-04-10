<template>
    <HeadTitle title="Replacement of Senior Citizen"></HeadTitle>
    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

        <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requirements</h3>
        <div class="bg-white rounded-lg p-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-3">
                <ListReq v-for="(list, idx) in requirements" :title="list" :idx="idx" :handleUpdateRequirement="handleUpdateRequirement" :handleDeleteRequirement="handleDeleteRequirement" />
            </div>

            <!-- add new btn -->
            <button @click="showRequirementModal"
                class="ml-auto mr-0 border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white mt-5 flex items-center justify-center rounded-md px-3 uppercase text-md font-bold">
                new
                <i class="uil uil-plus-circle m-0 ml-2"></i>
            </button>
            <!-- Services Modal -->
            <RequirementsModal v-if="isRequirementModal" :showRequirementModal="showRequirementModal" :handleCreateRequirement="handleCreateRequirement" />
        </div>

        <h3 class="font-bold text-xl mt-3 mb-3 text-gray-800">What's the process?</h3>
        <div class="w-full flex flex-col bg-white rounded-lg mt-5 p-4">
            <Table :handleCreateProcess="handleCreateProcess">
                <Rows v-for="(data, index) in processes" :data="data" :idx="index" :handleUpdateProcess="handleUpdateProcess" :handleDeleteProcess="handleDeleteProcess" />
            </Table>
            
        </div>
    </WrapperContent>
</template>

<script setup>
import ListReq from '../../Services Components/ListReq.vue';
import Rows from '../../Services Components/Rows.vue';
import Table from '../../Services Components/Table.vue';
import RequirementsModal from '../../Services Components/RequirementsModal.vue';

import { ref, onMounted } from "vue";
import axios from 'axios';
import { be_url } from '../../../../config/config';
import Notifcation from '../../../../Components/Notifcation.vue';

const dataSeniorCitizen = ref([]);
const processes = ref([]);
const requirements = ref([]);
const resMsg = ref();

// function to update one list of requirement with change.capture event.
// will update the data as soon as the user change the list and blur out of the input
function handleUpdateRequirement(e, arrId) {
    axios.post(be_url + "/replacement-senior-citizen/requirement/edit", {
        rowId: dataSeniorCitizen.value.id,
        arrId,
        newValue: e.target.value
    })
    .then(({data}) => {
       console.log(data.senior_citizen);
    })
    .catch(err => console.log(err));
}


const isRequirementModal = ref(false);
function showRequirementModal() {
    isRequirementModal.value = !isRequirementModal.value;
}

// function to delete requirement
async function handleDeleteRequirement(arrId) {
    return await axios.post(be_url + "/replacement-senior-citizen/requirement/delete", {
        rowId: dataSeniorCitizen.value.id,
        arrId
    })
    .then(({data}) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataSeniorCitizen.value = data.senior_citizen[0];

        // get all the lists of requirements by looping through the data.senior_citizen
        requirements.value = data.senior_citizen[0].service_requirements.split(",");
        return data;
    })
    .catch(err =>  {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// function to add new requirement
async function handleCreateRequirement(newRequirement) {
    return await axios.post(be_url + "/replacement-senior-citizen/requirement/add", {
        rowId: dataSeniorCitizen.value.id,
        newRequirement
    })
    .then(({data}) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataSeniorCitizen.value = data.senior_citizen[0];

        // get all the lists of requirements by looping through the data.senior_citizen
        requirements.value = data.senior_citizen[0].service_requirements.split(",");
        return data;
    })
    .catch(err =>  {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// function to update the process
async function handleUpdateProcess(e, arrId, key) {
    return await axios.post(be_url + "/replacement-senior-citizen/process/edit", {
        rowId: dataSeniorCitizen.value.id,
        arrId,
        newValue: e.target.value,
        key
    })
    .then(({data}) => {
       console.log(data.senior_citizen[0]);
    })
    .catch(err => console.log(err));
}

// function to delete a process
async function handleDeleteProcess(arrId) {
    return await axios.post(be_url + "/replacement-senior-citizen/process/delete", {
        rowId: dataSeniorCitizen.value.id,
        arrId
    })
    .then(({data}) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataSeniorCitizen.value = data.senior_citizen[0];

        // get all the services processes by looping through the data.senior_citizen
        processes.value = JSON.parse(data.senior_citizen[0].service_process);
        return data;
    })
    .catch(err =>  {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// function to add new requirement
async function handleCreateProcess(formData) {
    return await axios.post(be_url + "/replacement-senior-citizen/process/add", {
        rowId: dataSeniorCitizen.value.id,
        client_steps: formData.client_steps,
        agent_steps: formData.agent_steps,
        fees: formData.fees,
        process_time: formData.process_time,
    })
    .then(({data}) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        dataSeniorCitizen.value = data.senior_citizen[0];

        // get all the services processes by looping through the data.senior_citizen
        processes.value = JSON.parse(data.senior_citizen[0].service_process);
        return data;
    })
    .catch(err =>  {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// get data from the server
onMounted(() => {
    axios.get(be_url + "/replacement-senior-citizen")
    .then(({ data }) => {
        // storing the whole data
        dataSeniorCitizen.value = data.senior_citizen[0];
        
        // get all the services processes by looping through the data.senior_citizen
        processes.value = JSON.parse(data.senior_citizen[0].service_process);

        // get all the lists of requirements by looping through the data.senior_citizen
        requirements.value = data.senior_citizen[0].service_requirements.split(",");
    })
    .catch(err => console.log(err));
});

</script>