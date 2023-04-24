<template>
  <HeadTitle title="Department Heads"></HeadTitle>
  <WrapperContent>
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />
    <h1 class="text-xl font-bold capitalize">Department heads in pililla rizal</h1>

    <!-- empty: this will display when there is no data to display -->
    <h5 v-if="isEmpty" class="font-bold text-xl capitarize text-red-600 mt-5 border border-x-0 border-b-0">
      <i class="uil uil-folder-times text-3xl"></i>
      Empty Collection
    </h5>
    <div v-if="isLoading" class="flex items-center justify-center">
      <Loading class="w-8 h-8" />
      <p>Loading...</p>
    </div>

    <!-- cards -->
    <div class="flex items-center flex-wrap gap-3 mt-5">
      <CardOfficial v-for="official in dataDepartmentHeads" :key="official.id" :official="official"
        :handleDelete="handleDelete" />
    </div>
    <OfficialModal v-if="isModalShow" :closeModal="toggleShowModal" :handleSubmit="handleSubmit" />

    <!-- add btn -->
    <AddBtn :showAddModal="toggleShowModal" />


  </WrapperContent>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted } from 'vue';
import AddBtn from '../../../../Components/AddModal/AddBtn.vue';
import Loading from '../../../../Components/Loading.vue';
import Notifcation from '../../../../Components/Notifcation.vue';

import { be_url } from '../../../../config/config';
import CardOfficial from '../CardOfficial.vue';
import OfficialModal from '../OfficialModal.vue';

const dataDepartmentHeads = ref([]);
const resMsg = ref();
const isEmpty = ref(false);
const isLoading = ref(true);

const isModalShow = ref(false);
function toggleShowModal() {
  isModalShow.value = !isModalShow.value;
}

// this is for adding new data
async function handleSubmit(formData) {
  return await axios.post(be_url + "/department-head/add", { fullName: formData.fullName, position: formData.position + "," + formData.optionalPosition, startTerm: formData.startTerm, endTerm: formData.endTerm, imgFile: formData.imgFile }, { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      // this will update the state variable of the officials, if theres officialData response
      console.log(data);
      if (data.officialData) {
        dataDepartmentHeads.value = data.officialData;
      }

      return data; // for promise response, we can use this data for validation on the method that calls it
    })
    .catch(err => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// this is for deleting a data
function handleDelete(id, deleteRef) {
  axios.post(be_url + "/delete-department-head/", { id }).then(({ data }) => {
    // this will remove the displaying of the delete modal
    deleteRef.classList.remove("!translate-y-0");
    deleteRef.classList.remove("!translate-x-0");

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    // this will update the state variable of the officials, if theres officialData response
    console.log(data);
    if (data.officialData) {
      dataDepartmentHeads.value = data.officialData;
    }
  });
}

// get all the data from the server with axios
onMounted(() => {
  axios.get(be_url + "/department-heads")
    .then(({ data }) => {
      dataDepartmentHeads.value = data.departmentHeads;
      if (!dataDepartmentHeads.value.length) isEmpty.value = true;
      isLoading.value = false;
    })
    .catch(err => console.log(err));
});
</script>