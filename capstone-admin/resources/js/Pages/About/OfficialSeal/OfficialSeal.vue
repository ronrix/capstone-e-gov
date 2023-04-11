<template>
  <HeadTitle title="Official Seals"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <h1 class="font-bold text-xl text-center mb-5 lg:mb-3 text-gray-800 uppercase">PHOTOGRAPHS AND SYMBOLISMS OF<span
        class="block">COMPONENT OF PILILLA LOGO</span></h1>

    <div class="flex flex-col">
      <div class="w-[460px] md:w-[480px] lg:w-[500px] flex flex-col bg-white rounded-lg pt-0 self-center">
        <img class="w-[460px] md:w-[480px] lg:w-[500px]"
          :src="showSymbolImg ? showSymbolImg : validURL(dataOfficialSeal?.symbol_logo_img_link) ? dataOfficialSeal?.symbol_logo_img_link : be_url + '/' + dataOfficialSeal?.symbol_logo_img_link"
          alt="">

        <button v-if="!showSymbolImg" type="button" @click="showInputFileSelection"
          class="px-3 py-2 mt-10 mb-0 md:mb-2 md:mr-2 font-bold text-xs border border-blue-600 w-full md:w-[118px] rounded-lg  hover:bg-blue-600 hover:text-white self-end items-center">Change
          Image</button>
        <input ref="inputFile" @change="handleSelectFile" type="file" class="hidden" />
        <!-- saving the new img when the original image change. this button will show -->
        <button v-if="showSymbolImg" @click="saveNewSymbolImg" type="button"
          class="active:-translate-y-1 px-3 py-2 mt-10 mb-0 md:mb-2 md:mr-2 font-bold text-xs border bg-blue-600 w-full md:w-[118px] text-white rounded-lg self-end items-center">save</button>
      </div>
    </div>

    <!-- card -->
    <CardSeal v-for="(data, index) in logos" :data="data" :index="index" :showPreviewModal="showPreviewModal"
      :handleDelete="handleDeleteOfficialSeal" />

    <OfficialSealModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal"
      :date="dataOfficialSeal.created_at" :handleSubmit="handleUpdateOfficialSeal" />

    <!-- add new news btn -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />

    <!-- add modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal"
      :handleCreateSubmit="handleCreateOfficialSeal" title="Official Seal" />

  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import CardSeal from './CardSeal.vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import AddBtn from '../../../Components/AddModal/AddBtn.vue';
import { ref, onMounted } from 'vue'
import axios from 'axios';
import { be_url } from '../../../config/config';
import OfficialSealModal from './OfficialSealModal.vue';
import Notifcation from "../../../Components/Notifcation.vue";
import { validURL } from '../../../utils/validUrl';

const dataOfficialSeal = ref();
const logos = ref([]);
const resMsg = ref();

// select file
const inputFile = ref(null);

function showInputFileSelection() {
  // will click the hidden input file to show the file selection
  inputFile.value.click();
}

const newSymbolImg = ref();
const showSymbolImg = ref();
function handleSelectFile(e) {
  showSymbolImg.value = URL.createObjectURL(e.target.files[0]);
  newSymbolImg.value = e.target.files[0];
  console.log(newSymbolImg.value);
  console.log(showSymbolImg.value);
}

// saving new symbol image
function saveNewSymbolImg() {
  axios.post(be_url + "/official-seal/symbol-img/save", {
    id: dataOfficialSeal.value.id,
    newImg: newSymbolImg.value
  }, { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataOfficialSeal.value = data.official_seal[0];
    })
    .catch(err => console.log(err));
}

// preview modal
const isPreviewModal = ref(false)
const selectedData = ref();
const selectedId = ref();

function showPreviewModal(data, index) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
  selectedId.value = index;
}

// AddModal
const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}

async function handleUpdateOfficialSeal(formData) {
  return await axios.post(be_url + "/official-seal/edit", {
    id: dataOfficialSeal.value.id,
    arrId: selectedId.value,
    title: formData.title,
    description: formData.description,
    newImg: formData.newImg,
  }, { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataOfficialSeal.value = data.official_seal[0];
      logos.value = JSON.parse(data.official_seal[0].logo);
      return data;
    })
    .catch(err => console.log(err));
}

// function to remove one official seal
async function handleDeleteOfficialSeal(id, deleteRef) {
  return await axios.post(be_url + "/official-seal/delete", {
    id: dataOfficialSeal.value.id,
    arrId: id,
  }, { headers: { "Content-Type": "multipart/form-data" } })
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

      dataOfficialSeal.value = data.official_seal[0];
      logos.value = JSON.parse(data.official_seal[0].logo);
      return data;
    })
    .catch(err => console.log(err));
}

// function to create new official seal
async function handleCreateOfficialSeal(formData) {
  return await axios.post(be_url + "/official-seal/add", {
    id: dataOfficialSeal.value.id,
    title: formData.title,
    description: formData.content,
    newImg: formData.imgFile[0],
  }, { headers: { "Content-Type": "multipart/form-data" } })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      dataOfficialSeal.value = data.official_seal[0];
      logos.value = JSON.parse(data.official_seal[0].logo);
      return data;
    })
    .catch(err => console.log(err));
}

// get the data from the server
onMounted(() => {
  axios.get(be_url + "/official-seal")
    .then(({ data }) => {
      dataOfficialSeal.value = data.official_seal[0];
      logos.value = JSON.parse(data.official_seal[0].logo);
    })
    .catch(err => console.log(err));
});

</script>