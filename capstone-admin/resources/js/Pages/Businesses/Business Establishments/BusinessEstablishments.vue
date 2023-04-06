<template>
    <HeadTitle title="Ease of Doing Business"></HeadTitle>
    <WrapperContent>
        <!-- response message -->
        <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

        <!--businesses -->
        <h4 class=" text-xl lg:text-2xl font-bold text-gray-800 my-5">Businesses</h4>
        <!-- filter -->

        <div class="w-full flex flex-col md:flex-row md:self-center">
            <SearchInput placeholder="search" class="mr-2 w-auto" @searchFn="searchFn" />
            <SelectTag class="mt-3" type="category" value="All" :filterFn="filterBy" :filterArray="filterBusiness" addedClass="max-h-[300px] !w-[300px] overflow-y-scroll scrollbar" />
        </div>
        <div v-for="(group, category) in groupedItems" :key="category" class="flex flex-col mt-10">
            <div class="flex items-center">
                <span class="font-bold text-2xl text-gray-500 mr-5 capitalize">
                    <h3>{{ category }}</h3>
                </span>
                <div class="flex-1 border"></div>
            </div>

            <!-- card businesses -->
            <CardBusiness v-for="data in group" :data="data" :showPreviewModal="showPreviewModal" :key="data.id" :showTouristSpotPreviewModal="showPreviewModal" :handleDelete="handleDeleteEstablishment"  />
        </div> 

        <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isBusinessPreviewModal" :handleSubmit="handleUpdateEstablishment" />

        <!-- add new news btn -->
        <AddBtn :showAddModal="showAddNewModal" class="z-20" />

        <!-- add modal -->
        <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
            :handleCreateSubmit="handleCreateEstablishment" title="Business" :location="true" :category="true" />
    </WrapperContent>
</template>
<script setup>
import { computed, ref, onMounted } from 'vue';
import SearchInput from '../../../Components/SearchInput.vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import SelectTag from '../../../Components/SelectTag.vue';
import AddBtn from '../../../Components/AddModal/AddBtn.vue';
import Notifcation from "../../../Components/Notifcation.vue";
import PreviewModal from '../../../Components/PreviewModal.vue';
import CardBusiness from './CardBusiness.vue';

import axios from 'axios';
import { be_url } from "../../../config/config";

// init variables
const isBusinessPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();
const dataBusiness = ref([]);
const originalDataBusiness = ref([]);

const filterValue = ref("All");
const resMsg = ref();

// get all the categories
const filterBusiness = computed(() => {
    const categories = originalDataBusiness.value.map(og => og.category);
    categories.unshift("All");
    return new Set(categories);
});

const groupedItems = computed(() => {
    const groups = {};
    for (const item of dataBusiness.value) {
        if (!groups[item.category]) {
            groups[item.category] = [];
        }
        groups[item.category].push(item);
    }
    return groups;

}, [dataBusiness]);

function filterBy(type, value) {
    filterValue.value = value;

    if (value === "All") {
        dataBusiness.value = originalDataBusiness.value;
    }
    else {
        dataBusiness.value = originalDataBusiness.value.filter(el => {
            if (el.category.toLocaleLowerCase() === value.toLowerCase()) {
                return el;
            }
        });
    }
}

function showAddNewModal() {
    isAddNewModal.value = !isAddNewModal.value;
}

// search filtering
function searchFilter(value) {
    // first option: will check the titlePosition match value
    const first_option = dataBusiness.value.filter(d => {
        return d.title.toLowerCase().includes(value.toLowerCase());
    });

    // first option: will check the description match value
    const second_option = dataBusiness.value.filter(d => {
        return d.location.toLowerCase().includes(value.toLowerCase());
    });

    // first option: will check the description match value
    const third_option = dataBusiness.value.filter(d => {
        return d.category.toLowerCase().includes(value.toLowerCase());
    });

    // returning the data sorted by date
    if (first_option.length) {
        return first_option;
    }
    if (third_option.length) {
        return third_option;
    }
    return second_option;
}

function searchFn(value) {
    if (value.length) {
        dataBusiness.value = searchFilter(value);
        return;
    }
    dataBusiness.value = originalDataBusiness.value;
}

function showPreviewModal(data) {
  isBusinessPreviewModal.value = !isBusinessPreviewModal.value;
  selectedData.value = data;
}

// this function is for updating one tourist attraction
async function handleUpdateEstablishment(id, formData) {
    return await axios.post(be_url + '/businesses/edit', {
        id,
        title: formData.title,
        description: formData.description,
        location: formData.location,
        category: formData.category,
        newImgs: formData.newImgs,
        deletedImgs: formData.deletedImgIds,
        defaultThumbnailId: formData.defaultThumbnailId
    }, { headers: { "Content-Type": "multipart/form-data" } })
        .then(({ data }) => {

            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataBusiness.value = data.businesses;
            originalDataBusiness.value = data.businesses;
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

// function to handle the delete request
async function handleDeleteEstablishment(id, deleteRef) {
    return await axios.post(be_url + '/delete-businesses', { id })
        .then(({ data }) => {
            // this will remove the displaying of the delete modal
            deleteRef.classList.remove("!translate-y-0");
            deleteRef.classList.remove("!translate-x-0");

            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            dataBusiness.value = data.businesses;
            originalDataBusiness.value = data.businesses;
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

// function to handle create request
async function handleCreateEstablishment(formData) {
    return await axios.post(be_url + "/businesses/add", {
        title: formData.title,
        description: formData.content,
        location: formData.location,
        category: formData.category,
        imgFile: formData.imgFile,
    },
        { headers: { "Content-Type": "multipart/form-data" } })
        .then(({ data }) => {

            // set the response msg
            resMsg.value = data.res;
            // hide the notification message in 3s
            setTimeout(() => {
                resMsg.value = null;
            }, 3000);

            originalDataBusiness.value = data.businesses;
            dataBusiness.value = data.businesses;
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

// get the data from the server
onMounted(() => {
    axios.get(be_url + '/businesses')
        .then(({ data }) => {
            dataBusiness.value = data.businesses;
            originalDataBusiness.value = data.businesses;
        })
        .catch(err => console.log(err));

});

</script>