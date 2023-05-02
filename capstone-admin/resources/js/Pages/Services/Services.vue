<template>
    <HeadTitle :title="headTitle"></HeadTitle>
    <!-- edit verification modal -->

    <EditVerification :close-modal="closeEditVerificationModal" v-if="isEditVerification" :data="editedInput"
        :handle-edit="handleUpdateTitleDescription" />

    <!-- delete one service -->
    <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
        :handle-delete="handleDeleteService" :id="dataServices.id" />

    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

        <!-- delete btn - deleting this whole service -->
        <button title="delete this whole service"
            class="px-3 py-1 bg-red-600 text-white hover:bg-red-700 rounded-lg ml-auto mr-0 mb-3 block"
            @click="showDeleteVerificationModal">
            <i class="uil uil-times-circle"></i>
            delete
        </button>

        <h3 class="font-bold text-xl text-gray-800">Title</h3>
        <textarea @change="(e) => showEditVerification(e.target.value, 'title')"
            class="w-full border h-[30px] max-h-[30px] mb-3 resize-none px-2 outline-blue-600" :value="title"></textarea>

        <h3 class="font-bold text-xl text-gray-800">Description</h3>
        <textarea @change="(e) => showEditVerification(e.target.value, 'description')"
            class="w-full border mb-3 max-h-[400px] px-2 outline-blue-600" :value="description"></textarea>

        <h3 class="font-bold text-xl mb-3 text-gray-800">
            Checklist of Requirements
        </h3>
        <div class="bg-white rounded-lg p-4">
            <div class="grid grid-cols-1 gap-x-3">
                <div class="flex justify-start items-center">
                    <h3 class="font-bold flex-1">Requirements</h3>
                    <h3 class="font-bold flex-1">Where to go?</h3>
                    <div class="bg-white">
                        <div class="invisible">dummy</div>
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

        <h3 class="font-bold text-xl mt-3 mb-3 text-gray-800">
            What's the process?
        </h3>
        <div class="w-full flex flex-col bg-white rounded-lg mt-5 p-4">
            <Table :handleCreateProcess="handleCreateProcess">
                <Rows v-for="(data, index) in processes" :key="index" :data="data" :idx="index"
                    :handleUpdateProcess="handleUpdateProcess" :handleDeleteProcess="handleDeleteProcess" />
            </Table>
        </div>
    </WrapperContent>
</template>

<script setup>
import ListReq from "./Services Components/ListReq.vue";
import Rows from "./Services Components/Rows.vue";
import Table from "./Services Components/Table.vue";
import RequirementsModal from "./Services Components/RequirementsModal.vue";

import { ref, onMounted, watchEffect } from "vue";
import axios from "axios";
import { be_url } from "../../config/config";
import Notifcation from "../../Components/Notifcation.vue";
import { useRoute } from "vue-router";
import EditVerification from "../../Components/EditVerification.vue";
import DeleteVerificationModal from "../../Components/DeleteVerificationModal.vue";
import { router } from "../../router/";

const dataServices = ref([]);
const processes = ref([]);
const requirements = ref([]);
const resMsg = ref();
const routes = useRoute();
const isVerificationModal = ref(false);

// function to verifify the deleting of the service
function showDeleteVerificationModal() {
    isVerificationModal.value = !isVerificationModal.value;
}

// function to update one list of requirement with change.capture event.
// will update the data as soon as the user change the list and blur out of the input
async function handleUpdateRequirement(value, arrId, valueId) {
    return await axios
        .post(be_url + "/services/requirement/edit", {
            rowId: dataServices.value.id,
            arrId,
            valueId,
            newValue: value,
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
        .catch((err) => {
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
    return await axios
        .post(be_url + `/services/${service.value}/requirement/delete`, {
            rowId: dataServices.value.id,
            arrId,
        })
        .then(({ data }) => {
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
                requirements.value = JSON.parse(
                    dataServices.value.service_requirements
                );
            }, 1);
            return data;
        })
        .catch((err) => {
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
    return await axios
        .post(be_url + `/services/${service.value}/requirement/add`, {
            rowId: dataServices.value.id,
            newRequirement,
            newWhereToGo,
        })
        .then(({ data }) => {
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
                requirements.value = JSON.parse(
                    dataServices.value.service_requirements
                );
            }, 1);
            return data;
        })
        .catch((err) => {
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
    return await axios
        .post(be_url + "/services/process/edit", {
            rowId: dataServices.value.id,
            arrId,
            newValue: value,
            key,
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
        .catch((err) => {
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
    return await axios
        .post(be_url + `/services/${service.value}/process/delete`, {
            rowId: dataServices.value.id,
            arrId,
        })
        .then(({ data }) => {
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
        })
        .catch((err) => {
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
    return await axios
        .post(be_url + `/services/${service.value}/process/add`, {
            rowId: dataServices.value.id,
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
            dataServices.value = data.services[0];

            // get all the services processes by looping through the data.services
            processes.value = JSON.parse(data.services[0].service_process);
            return data;
        })
        .catch((err) => {
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
const type = ref("");
function showEditVerification(inputValue, type) {
    editedInput.value.value = inputValue;

    isEditVerification.value = !isEditVerification.value; // display the edit verification modal
}
function closeEditVerificationModal() {
    isEditVerification.value = false;
    editedInput.value = title.value;
}

// function to update the intended for
function handleUpdateTitleDescription(value) {
    axios
        .post(be_url + "/services/title-description/edit", {
            id: dataServices.value.id,
            newValue: value,
            type
        })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
            isEditVerification.value = false; // close the edit verification modal
            if (type === 'title') {
                title.value = value;
            }
            else {
                description.value = value;
            }

            return data;
        })
        .catch((err) => {
            // set the response msg
            resMsg.value = err.response.data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
            return;
        });
}

// function to delete the service
async function handleDeleteService(id) {
    return await axios
        .post(be_url + "/services/delete", {
            id
        })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
            isVerificationModal.value = false; // close the edit verification modal
            router.go(-1) // go back last route after successfull delete of service

            return data;
        })
        .catch((err) => {
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
const title = ref("");
const description = ref("");
onMounted(() => {
    service.value = routes.path.split("/")[3];
    // make the headTitle capitalize
    headTitle.value = toCapitalize(service.value.replace("-", " "));

    axios
        .get(be_url + "/services/" + service.value)
        .then(({ data }) => {
            // storing the whole data
            dataServices.value = data.services[0];
            title.value = dataServices.value.title;
            description.value = dataServices.value.description;
            // get all the services processes by looping through the data.services
            processes.value = JSON.parse(data.services[0].service_process);
            // get all the lists of requirements by looping through the data.services
            requirements.value = JSON.parse(data.services[0].service_requirements);
        })
        .catch((err) => {
            // set the response msg
            resMsg.value = err.response.data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);
        });
});

watchEffect([routes], () => {
    if (routes.path.split("/")[1] === "services") {
        service.value = routes.path.split("/")[3];
        // make the headTitle capitalize
        headTitle.value = toCapitalize(service.value.replace(/-/g, " "));

        axios
            .get(be_url + "/services/" + service.value)
            .then(({ data }) => {
                // storing the whole data
                dataServices.value = data.services[0];
                title.value = dataServices.value.title;
                description.value = dataServices.value.description;
                // get all the services processes by looping through the data.services
                processes.value = [];
                requirements.value = [];
                setTimeout(() => {
                    processes.value = JSON.parse(data.services[0].service_process);
                    requirements.value = JSON.parse(
                        data.services[0].service_requirements
                    );
                }, 1);
            })
            .catch((err) => {
                // set the response msg
                resMsg.value = err.response.data.res;
                // hide the notification message in 3s
                setTimeout(() => {
                    resMsg.value = null;
                }, 3000);
            });
    }
});
</script>