<template>
    <HeadTitle title="Ordinances"></HeadTitle>
    <!-- response message -->
    <Notifcation :msg="resMsg" class="z-[1000]" />

    <WrapperContent>
        <div class="flex items-center gap-2 mb-3">
            <h3 class="text-xl font-bold">List of Ordinances</h3>
            <!-- filter the deleted data -->
            <span class="text-gray-500 font-bold text-sm mx-2 capitalize">active: </span>
            <SelectTag type="active" :filterFn="filterDelete" :value="activeData" :filterArray="['active', 'deleted']"
                added-class="!w-[200px]" />

        </div>
        <!-- empty: this will display when there is no data to display -->
        <h5 v-if="isEmpty"
            class="font-bold text-xl capitarize text-red-500 mt-5 border border-x-0 border-b-0 flex items-center">
            <i class="uil uil-folder-times text-3xl"></i>
            Empty Collection
        </h5>
        <div v-if="isLoading" class="flex items-center justify-center">
            <Loading class="w-8 h-8" />
            <p>Loading...</p>
        </div>

        <OrdinanceCard v-else v-for="ordinance in dataOrdinances" :key="ordinance.id" :ordinance="ordinance"
            :handle-update-ordinance="handleUpdateOrdinance" :handle-delete-ordinance="handleDeleteOrdinance" />

        <!-- add new news btn -->
        <AddBtn :showAddModal="showAddNewModal" class="z-20" />
        <OrdinanceCreateNew v-if="isAddNewModal" :close-modal="showAddNewModal"
            :handle-create-new-ordinance="handleCreateNewOrdinance" />
    </WrapperContent>
</template>
<script setup>
import { ref, onMounted } from "vue";
import AddBtn from "../../../Components/AddModal/AddBtn.vue";
import OrdinanceCard from "./OrdinanceCard.vue";
import Notifcation from "../../../Components/Notifcation.vue";
import Loading from "../../../Components/Loading.vue";
import { be_url } from "../../../config/config";
import SelectTag from "../../../Components/SelectTag.vue";
import OrdinanceCreateNew from "./OrdinanceCreateNew.vue";

const activeData = ref("active");
const isEmpty = ref(false);
// filter delete
// requesting for active and deleted data
function filterDelete(type, value) {
    activeData.value = value;
    isLoading.value = true;

    // get request for deleted data
    if (activeData.value === 'deleted') {
        axios.get(be_url + '/ordinances/deleted')
            .then(({ data }) => {
                isLoading.value = false;
                // add deleted data to dataNews and originalDataNews
                if (data.ordinances.length) {
                    dataOrdinances.value = data.ordinances;
                    originalDataOrdinances.value = data.ordinances;
                    isEmpty.value = false;
                    return;
                }
                // else just render "empty collection" text
                isEmpty.value = true; // set the isEmpty to true, so there would be an indication that data is empty
                dataOrdinances.value = data.ordinances;
                originalDataOrdinances.value = data.ordinances;
            })
            .catch(err => {
                // set the response msg
                resMsg.value = err.response.data.res;
                // hide the notification message in 3s
                setTimeout(() => {
                    resMsg.value = null;
                }, 3000);
            });
        return;
    }
    // else the undeleted data
    axios.get(be_url + '/ordinances')
        .then(({ data }) => {
            isLoading.value = false;
            isEmpty.value = false;
            if (data.ordinances) {
                dataOrdinances.value = data.ordinances;
                originalDataOrdinances.value = data.ordinances;
                return;
            }
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

const isAddNewModal = ref(false);
function showAddNewModal() {
    isAddNewModal.value = !isAddNewModal.value;
}

const dataOrdinances = ref([{ id: 1, title: "Ordinances for requiring mandatory disclosure of minimun relavant information", pdf_path: "/sample-pdf.pdf" }]);
const originalDataOrdinances = ref([]);
const isLoading = ref(true);

const resMsg = ref();
async function handleUpdateOrdinance(id, formData) {
    return await axios.post("/ordinances/edit", {
        id,
        title: formData.title,
        pdfFile: formData.pdfFile,
    }, {
        headers: {
            "Content-Type": "multipart/form-data"
        }
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataOrdinances.value = data.ordinances;
            originalDataOrdinances.value = data.ordinances;
            if (!dataOrdinances.value.length) isEmpty.value = true;
            isLoading.value = false;

            return;
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

// function to delete ordinance
async function handleDeleteOrdinance(id) {
    return await axios.post("/delete-ordinances", {
        id,
    })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataOrdinances.value = data.ordinances;
            originalDataOrdinances.value = data.ordinances;
            if (!dataOrdinances.value.length) isEmpty.value = true;
            isLoading.value = false;

            return;
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

// function to create new ordinance
async function handleCreateNewOrdinance(formData) {
    return await axios.post("/ordinances/add", {
        title: formData.title,
        pdfFile: formData.pdfFile,
    }, { headers: { "Content-Type": "multipart/form-data" } })
        .then(({ data }) => {
            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataOrdinances.value = data.ordinances;
            originalDataOrdinances.value = data.ordinances;
            if (!dataOrdinances.value.length) isEmpty.value = true;
            isLoading.value = false;

            return;
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

onMounted(() => {
    axios.get(be_url + "/ordinances")
        .then(({ data }) => {
            isLoading.value = false;
            dataOrdinances.value = data.ordinances;
            originalDataOrdinances.value = data.ordinances;
        })
        .catch(err => console.log(err));
});

</script>