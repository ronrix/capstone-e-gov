<template>
    <HeadTitle title="Scholarship Program"></HeadTitle>
    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

        <h3 class="font-bold text-xl mb-3 text-gray-800">Checklist of Requirements</h3>
        <div class="bg-white rounded-lg p-4">
            <div class="grid grid-cols-1 gap-x-3">
                <div class="flex justify-start items-center">
                    <h3 class="font-bold flex-1">Requirements</h3>
                    <h3 class="font-bold flex-1">Where to go?</h3>
                    <div class="bg-white">
                        <div class="invisible ">dummy</div>
                    </div>
                </div>
                <ListReq v-for="(list, key, idx) in requirements" :key="idx" :value="list" :key-prop="key" :idx="idx"
                    :handleUpdateRequirement="handleUpdateRequirement" :handleDeleteRequirement="handleDeleteRequirement" />
            </div>

            <!-- add new btn -->
            <button @click="showRequirementModal"
                class="ml-auto mr-0 border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white mt-5 flex items-center justify-center rounded-md px-3 uppercase text-md font-bold">
                new
                <i class="uil uil-plus-circle m-0 ml-2"></i>
            </button>
            <!-- Services Modal -->
            <RequirementsModal v-if="isRequirementModal" :showRequirementModal="showRequirementModal"
                :handleCreateRequirement="handleCreateRequirement" />
        </div>

        <h3 class="font-bold text-xl mt-3 mb-3 text-gray-800">What's the process?</h3>
        <div class="w-full flex flex-col bg-white rounded-lg mt-5 p-4">
            <Table :handleCreateProcess="handleCreateProcess">
                <Rows v-for="(data, index) in processes" :key="index" :data="data" :idx="index"
                    :handleUpdateProcess="handleUpdateProcess" :handleDeleteProcess="handleDeleteProcess" />
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

const dataScholarship = ref([]);
const processes = ref([]);
const requirements = ref([]);
const resMsg = ref();

// function to update one list of requirement with change.capture event.
// will update the data as soon as the user change the list and blur out of the input
async function handleUpdateRequirement(value, arrId, valueId) {
    return await axios.post(be_url + "/scholarship/requirement/edit", {
        rowId: dataScholarship.value.id,
        arrId,
        valueId,
        newValue: value
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}


const isRequirementModal = ref(false);
function showRequirementModal() {
    isRequirementModal.value = !isRequirementModal.value;
}

// function to delete requirement
async function handleDeleteRequirement(arrId) {
    return await axios.post(be_url + "/scholarship/requirement/delete", {
        rowId: dataScholarship.value.id,
        arrId
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataScholarship.value = data.scholarship[0];

        /* 
        * this code is to solve of the requirements lists
        * first we are emptying the value of requirements.value = []
        * then just add the updated value with setTimeout with 1ms 
        * that re-renders the updated value of the requirements list
        */
        requirements.value = [];
        setTimeout(() => {
            requirements.value = JSON.parse(dataScholarship.value.service_requirements);
        }, 1);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// function to add new requirement
async function handleCreateRequirement(newRequirement, newWhereToGo) {
    return await axios.post(be_url + "/scholarship/requirement/add", {
        rowId: dataScholarship.value.id,
        newRequirement,
        newWhereToGo
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataScholarship.value = data.scholarship[0];

        /* 
        * this code is to solve of the requirements lists
        * first we are emptying the value of requirements.value = []
        * then just add the updated value with setTimeout with 1ms 
        * that re-renders the updated value of the requirements list
        */
        requirements.value = [];
        setTimeout(() => {
            requirements.value = JSON.parse(dataScholarship.value.service_requirements);
        }, 1);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
    });
}

// function to update the process
async function handleUpdateProcess(value, arrId, key) {
    return await axios.post(be_url + "/scholarship/process/edit", {
        rowId: dataScholarship.value.id,
        arrId,
        newValue: value,
        key
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
            return data;
        })
        .catch(err => console.log(err));
}

// function to delete a process
async function handleDeleteProcess(arrId) {
    return await axios.post(be_url + "/scholarship/process/delete", {
        rowId: dataScholarship.value.id,
        arrId
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataScholarship.value = data.scholarship[0];

            // get all the services processes by looping through the data.scholarship
            processes.value = JSON.parse(data.scholarship[0].service_process);
            return data;
        })
        .catch(err => {
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
    return await axios.post(be_url + "/scholarship/process/add", {
        rowId: dataScholarship.value.id,
        client_steps: formData.client_steps,
        agent_steps: formData.agent_steps,
        fees: formData.fees,
        process_time: formData.process_time,
        person_responsible: formData.person_responsible,
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
            dataScholarship.value = data.scholarship[0];

            // get all the services processes by looping through the data.scholarship
            processes.value = JSON.parse(data.scholarship[0].service_process);
            return data;
        })
        .catch(err => {
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
    axios.get(be_url + "/scholarship")
        .then(({ data }) => {
            // storing the whole data
            dataScholarship.value = data.scholarship[0];

            // get all the services processes by looping through the data.scholarship
            processes.value = JSON.parse(data.scholarship[0].service_process);

            // get all the lists of requirements by looping through the data.scholarship
            requirements.value = JSON.parse(data.scholarship[0].service_requirements);
        })
        .catch(err => console.log(err));
});

</script>