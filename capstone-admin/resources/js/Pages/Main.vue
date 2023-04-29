<template>
  <!-- create new service | modal -->
  <CreateServiceModal v-if="isShowCreateServiceModal" :close-modal="showCreateServiceModal"
    :handle-create-service="handleCreateService" />
  <MainWrapper :show-create-service="showCreateServiceModal" :showAddModal="showAddModal" :service-types="serviceTypes"
    class="h-full min-h-full bg-slate-200">
    <!-- show this modal when add new button was clicked -->
    <AddModal v-if="addModal" :showAddModal="showAddModal" />

    <!-- this will render other pages (news, job postings, etc) -->
    <RouterView :key="$route.fullPath" />
  </MainWrapper>
</template>

<script setup>
import MainWrapper from "../Components/MainWrapper.vue";
import { ref, onMounted } from "vue";
import { RouterView } from "vue-router";
import AddModal from "../Components/AddModal/AddModal.vue";
import CreateServiceModal from "../Components/CreateServiceModal.vue";
import axios from 'axios';
import { be_url } from '../config/config';

const addModal = ref(false);
const isShowCreateServiceModal = ref(false);
function showCreateServiceModal() {
  isShowCreateServiceModal.value = !isShowCreateServiceModal.value;
}

function showAddModal() {
  addModal.value = !addModal.value;
}

// get all the service types and display to the navs
const serviceTypes = ref([]);
onMounted(() => {
  axios.get(be_url + "/service-types")
    .then(({ data }) => {
      serviceTypes.value = data.service_types;
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

// function to create new service and that will automatically shows to the sidenavs
async function handleCreateService(formData) {
  return await axios.post(be_url + "/service/create", {
    department: formData.department,
    intendedFor: formData.intendedFor,
    serviceType: formData.serviceType,
  })
    .then(({ data }) => {
      serviceTypes.value = data.service_types;
      return data;
    })
    .catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      return;
    });
}

</script>

<style lang="scss" scoped></style>