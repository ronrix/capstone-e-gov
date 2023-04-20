<template>
    <HeadTitle :title="headTitle"></HeadTitle>
    <!-- edit verification modal -->

    <EditVerification :close-modal="closeEditVerificationModal" v-if="isEditVerification" :data="editedInput"
        :handle-edit="handleUpdateIntendedFor" />

    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

        <h3 class="font-bold text-xl text-gray-800">Inteded for</h3>
        <p class="text-gray-600 text-xs">to update "intended for" please separte theme with comma "," </p>
        <textarea @change="(e) => showEditVerification(e.target.value)"
            class="w-full border h-[30px] max-h-[30px] mb-3 resize-none px-2 outline-blue-600"
            :value="intendedFor"></textarea>

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
import ListReq from './Services Components/ListReq.vue';
import Rows from './Services Components/Rows.vue';
import Table from './Services Components/Table.vue';
import RequirementsModal from './Services Components/RequirementsModal.vue';

import { ref, onMounted, onUpdated } from "vue";
import axios from 'axios';
import { be_url } from '../../config/config';
import Notifcation from '../../Components/Notifcation.vue';
import { useRoute } from 'vue-router';
import EditVerification from '../../Components/EditVerification.vue';

const dataServices = ref([]);
const processes = ref([]);
const requirements = ref([]);
const resMsg = ref();
const routes = useRoute();

// function to update one list of requirement with change.capture event.
// will update the data as soon as the user change the list and blur out of the input
async function handleUpdateRequirement(value, arrId, valueId) {
    return await axios.post(be_url + "/services/requirement/edit", {
        rowId: dataServices.value.id,
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
        return;
    });
}


const isRequirementModal = ref(false);
function showRequirementModal() {
    isRequirementModal.value = !isRequirementModal.value;
}

// function to delete requirement
async function handleDeleteRequirement(arrId) {
    return await axios.post(be_url + `/services/${service.value}/requirement/delete`, {
        rowId: dataServices.value.id,
        arrId
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataServices.value = data.services[0];

        /* 
        * this code is to solve of the requirements lists
        * first we are emptying the value of requirements.value = []
        * then just add the updated value with setTimeout with 1ms 
        * that re-renders the updated value of the requirements list
        */
        requirements.value = [];
        setTimeout(() => {
            requirements.value = JSON.parse(dataServices.value.service_requirements);
        }, 1);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return;
    });
}

// function to add new requirement
async function handleCreateRequirement(newRequirement, newWhereToGo) {
    return await axios.post(be_url + `/services/${service.value}/requirement/add`, {
        rowId: dataServices.value.id,
        newRequirement,
        newWhereToGo
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataServices.value = data.services[0];

        /* 
        * this code is to solve of the requirements lists
        * first we are emptying the value of requirements.value = []
        * then just add the updated value with setTimeout with 1ms 
        * that re-renders the updated value of the requirements list
        */
        requirements.value = [];
        setTimeout(() => {
            requirements.value = JSON.parse(dataServices.value.service_requirements);
        }, 1);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return;
    });
}

// function to update the process
async function handleUpdateProcess(value, arrId, key) {
    return await axios.post(be_url + "/services/process/edit", {
        rowId: dataServices.value.id,
        arrId,
        newValue: value,
        key
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
        return;
    });
}

// function to delete a process
async function handleDeleteProcess(arrId) {
    return await axios.post(be_url + `/services/${service.value}/process/delete`, {
        rowId: dataServices.value.id,
        arrId
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);

        dataServices.value = data.services[0];

        // get all the services processes by looping through the data.services
        processes.value = JSON.parse(data.services[0].service_process);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return;
    });
}

// function to add new requirement
async function handleCreateProcess(formData) {
    return await axios.post(be_url + `/services/${service.value}/process/add`, {
        rowId: dataServices.value.id,
        client_steps: formData.client_steps,
        agent_steps: formData.agent_steps,
        fees: formData.fees,
        process_time: formData.process_time,
        person_responsible: formData.person_responsible,
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        dataServices.value = data.services[0];

        // get all the services processes by looping through the data.services
        processes.value = JSON.parse(data.services[0].service_process);
        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return;
    });
}

// save verification on edit
const isEditVerification = ref(false);
const editedInput = ref({ value: "" });
function showEditVerification(inputValue) {
    editedInput.value.value = inputValue;
    intendedFor.value = inputValue;

    isEditVerification.value = !isEditVerification.value; // display the edit verification modal
}
function closeEditVerificationModal() {
    isEditVerification.value = false;
    editedInput.value = intendedFor.value;
}

// function to update the intended for
function handleUpdateIntendedFor(value) {
    axios.post(be_url + "/services/intended-for/edit", {
        id: dataServices.value.id,
        newValue: value
    }).then(({ data }) => {
        // set the response msg
        resMsg.value = data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        isEditVerification.value = false; // close the edit verification modal

        return data;
    }).catch(err => {
        // set the response msg
        resMsg.value = err.response.data.res;
        // hide the notification message in 3s
        setTimeout(() => {
            resMsg.value = null;
        }, 3000);
        return;
    });
}

// string to capitalize the first letter of the word
function toCapitalize(str) {
    // split the string by "space"
    const arrStr = str.split(" ");

    // loop through the string
    str = arrStr.map((s) => {
        return s[0].toUpperCase() + s.slice(1);
    });

    return str.join(",").replace(",", " ");
}

// get data from the server
const service = ref("");
const headTitle = ref("");
const intendedFor = ref([]);
onMounted(() => {
    service.value = routes.path.split("/")[3];
    // make the headTitle capitalize
    headTitle.value = toCapitalize(service.value.replace("-", " "));

    axios
        .get(be_url + "/services/" + service.value)
        .then(({ data }) => {
            // storing the whole data
            dataServices.value = data.services[0];
            intendedFor.value = JSON.parse(dataServices.value.intended_for).join(", ");
            // get all the services processes by looping through the data.services
            processes.value = JSON.parse(data.services[0].service_process);
            // get all the lists of requirements by looping through the data.services
            requirements.value = JSON.parse(data.services[0].service_requirements);
        })
        .catch(err => {
            // set the response msg
            resMsg.value = err.response.data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
        });
});

onUpdated(() => {
    service.value = routes.path.split("/")[3];
    // make the headTitle capitalize
    headTitle.value = toCapitalize(service.value.replace(/-/g, " "));

    axios
        .get(be_url + "/services/" + service.value)
        .then(({ data }) => {
            // storing the whole data
            dataServices.value = data.services[0];
            // get all the services processes by looping through the data.services
            processes.value = [];
            requirements.value = [];
            setTimeout(() => {
                processes.value = JSON.parse(data.services[0].service_process);
                requirements.value = JSON.parse(data.services[0].service_requirements);
            }, 1);

        })
        .catch(err => {
            // set the response msg
            resMsg.value = err.response.data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
        });
});

</script>