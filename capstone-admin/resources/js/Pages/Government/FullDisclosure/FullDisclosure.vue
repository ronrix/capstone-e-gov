<template>
  <HeadTitle title="Full Disclosure"></HeadTitle>

  <!-- response message -->
  <Notifcation :msg="resMsg" class="z-[1000]" />
  <!-- delete -->
  <DeleteVerificationModal v-if="isVerificationModal" :close-modal="showDeleteVerificationModal"
    :handle-delete="handleDelete" :id="null" />

  <WrapperContent>
    <h3 class="font-bold text-xl mb-3">Full Disclosure Reports</h3>

    <!-- add new report btn and modal -->
    <AddPDF v-if="isShowModal" :closeAddPDF="showModal" :handle-upload-file="handleUploadFile" filetype="fdr" />
    <!-- add new btn -->
    <button @click="showModal" class="bg-blue-600 py-1 px-3 rounded-lg text-white font-bold text-sm mb-2">Add
      new file</button>

    <!-- report files -->
    <h4 v-if="!fullDisclosureReports.length" class="text-2xl font-bold mt-5 text-primary-dark">
      <i class="uil uil-file-times"></i>
      No files uploaded yet!
    </h4>
    <div v-else class="bg-white">
      <div v-for="file in fullDisclosureReports" :key="file.id"
        class="border border-x-0 border-b-0 border-t-2 border-t-slate-100 py-2 px-3 text-sm text-gray-800 my-2 flex items-center justify-between">
        <span class="font-semibold">{{ file.filename }}</span>
        <div>
          <a :href="`${be_url}/file/download/${file.filepath.split('/')[2] + '_' + file.filename}`">
            <i title="download" class="uil uil-download-alt text-blue-600 text-lg cursor-pointer"></i>
          </a>
          <i @click="showDeleteVerificationModal(file.id, 'fdr')" title="delete"
            class="uil uil-trash-alt text-red-600 text-base ml-3 cursor-pointer"></i>
        </div>
      </div>
    </div>

  </WrapperContent>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import AddPDF from '../../../Components/AddPDF.vue';
import axios from 'axios';
import { be_url } from '../../../config/config';
import Notifcation from '../../../Components/Notifcation.vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

const isShowModal = ref(false);
const resMsg = ref();
function showModal() {
  isShowModal.value = !isShowModal.value;
}

const fullDisclosureReports = ref([]);

const isVerificationModal = ref(false);
// function to handle the delete 
const deleteData = ref({ id: null, filetype: null });
function showDeleteVerificationModal(id, filetype) {
  isVerificationModal.value = !isVerificationModal.value;
  deleteData.value.id = id;
  deleteData.value.filetype = filetype;
}

async function handleUploadFile(formData) {
  return await axios.post(be_url + "/upload-file", {
    filename: formData.filename,
    filetype: formData.filetype,
    file: formData.file,
  }, {
    headers: { "Content-Type": "multipart/form-data" }
  }).then(({ data }) => {

    // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    fullDisclosureReports.value = data.full_disclosure;

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

function handleDelete() {
  deleteFile(deleteData.value.id, deleteData.value.filetype);
}

function deleteFile(id, filetype) {
  axios.post(be_url + "/file/delete", {
    id,
    filetype
  })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      isVerificationModal.value = false;
      fullDisclosureReports.value = data.full_disclosure;
    }).catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

onMounted(() => {
  // TODO: get all the full disclosure reports file
  axios.get(be_url + "/full-disclosure-reports")
    .then(({ data }) => {
      fullDisclosureReports.value = data.full_disclosure;
    }).catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
});

</script>