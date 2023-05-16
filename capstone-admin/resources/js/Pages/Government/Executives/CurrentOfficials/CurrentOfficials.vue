<template>
  <HeadTitle title="Current Officials"></HeadTitle>
  <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-50" />
  <WrapperContent>
    <h1 class="text-xl font-bold capitalize">
      Current officials of pililla rizal
    </h1>
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
    <div class="flex items-start flex-wrap gap-5 mt-5">
      <CardOfficial v-for="official in dataCurrentOfficials" :key="official.id" :official="official"
        :handleDelete="handleDelete" />
    </div>
    <OfficialModal v-if="isModalShow" :closeModal="toggleShowModal" :handleSubmit="handleSubmit" />

    <!-- add btn -->
    <AddBtn :showAddModal="toggleShowModal" />
  </WrapperContent>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import AddBtn from "../../../../Components/AddModal/AddBtn.vue";
import Loading from "../../../../Components/Loading.vue";
import Notifcation from "../../../../Components/Notifcation.vue";

import { be_url } from "../../../../config/config";
import CardOfficial from "../CardOfficial.vue";
import OfficialModal from "../OfficialModal.vue";

const dataCurrentOfficials = ref([]);
const resMsg = ref();
const isEmpty = ref(false);
const isLoading = ref(true);

const isModalShow = ref(false);
function toggleShowModal() {
  isModalShow.value = !isModalShow.value;
}

// this is for adding new data
async function handleSubmit(formData) {
  return await axios
    .post(
      be_url + "/current-official/add",
      {
        fullName: formData.fullName,
        position: formData.position,
        startTerm: formData.startTerm,
        endTerm: formData.endTerm,
        imgFile: formData.imgFile,
      },
      { headers: { "Content-Type": "multipart/form-data" } }
    )
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
        dataCurrentOfficials.value = data.officialData;
      }

      return data; // for promise response, we can use this data for validation on the method that calls it
    })
    .catch((err) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// this is for deleting a data
function handleDelete(id) {
  axios.post(be_url + "/delete-current-official", { id }).then(({ data }) => {
    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    // this will update the state variable of the officials, if theres officialData response
    if (data.officialData) {
      dataCurrentOfficials.value = data.officialData;
    }
  });
}

// get all the data from the server with axios
onMounted(() => {
  axios
    .get(be_url + "/current-officials")
    .then(({ data }) => {
      dataCurrentOfficials.value = data.currentOfficials;
      if (!dataCurrentOfficials.value.length) isEmpty.value = true;
      isLoading.value = false;
    })
    .catch((err) => console.log(err));
});
</script>