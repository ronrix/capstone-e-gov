<template>
  <HeadTitle title="Hotlines"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- delete modal -->
    <DeleteVerificationModal :closeModal="showDelete" v-if="isShowDelete" :id="deleteId" :handle-delete="handleDelete" />
    <!-- edit verification modal -->
    <EditVerification :close-modal="closeEditVerification" v-if="isEditVerification" :data="editedInput"
      :handle-edit="handleEdit" />

    <h3 class="font-bold text-xl mb-3 text-gray-800 here" ref="h1">Municipal Hotlines</h3>

    <!-- add btn -->
    <button @click="showHotlineModal"
      class="border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end mt-5 flex items-center justify-center rounded-lg px-5 uppercase text-md font-bold mr-0 ml-auto mb-3">
      new
      <i class="uil uil-plus-circle m-0 ml-2"></i>
    </button>

    <!-- hotlines table -->
    <div class="w-full flex flex-col gap-3">
      <div v-for="a in hotlines" :key="a.id" class="bg-white p-3 rounded-md relative shadow-sm">
        <textarea v-model="a.department" @change.capture="(e) => showEditVerification(e.target.value, a.id, 'department')"
          class="focus:outline-blue-500 py-3 w-full font-bold overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx] capitalize border"></textarea>
        <div class="flex items-start sm:items-center flex-col sm:flex-row gap-5">
          <NumberInput :id="a.id" :handleEdit="handleEdit" type="smart" :number="a.smart"
            :show-edit-verification="showEditVerification" />
          <NumberInput :id="a.id" :handleEdit="handleEdit" type="globe" :number="a.globe"
            :show-edit-verification="showEditVerification" />
          <NumberInput :id="a.id" :handleEdit="handleEdit" type="landline" :number="a.landline"
            :show-edit-verification="showEditVerification" />
        </div>

        <button type="button" @click="showDelete(a.id)"
          class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-2 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
          delete</button>
      </div>
    </div>

    <!-- hotline modal -->
    <HotlineModal v-if="isHotlineModal" :showHotlineModal="showHotlineModal" :sample_data="sample_data"
      :handleSubmit="handleSubmit" />

  </WrapperContent>
</template>

<script setup defer>
import HotlineModal from "./HotlineModal.vue";
import { ref, onMounted } from 'vue';

import NumberInput from "./NumberInput.vue";
import DeleteVerificationModal from "../../../Components/DeleteVerificationModal.vue";
import axios from "axios";
import { be_url } from "../../../config/config";
import Notifcation from "../../../Components/Notifcation.vue";
import EditVerification from "../../../Components/EditVerification.vue";

const hotlines = ref([]);
const isShowDelete = ref(false);
const deleteId = ref();
const resMsg = ref();

const isHotlineModal = ref(false);
function showHotlineModal() {
  isHotlineModal.value = !isHotlineModal.value;
}

function showDelete(id) {
  isShowDelete.value = !isShowDelete.value;
  deleteId.value = id;
}

// save verification on edit
const isEditVerification = ref(false);
const editedInput = ref({ value: "", id: null, type: "" });
function showEditVerification(inputValue, id, type) {
  editedInput.value.value = inputValue;
  editedInput.value.id = id;
  editedInput.value.type = type;

  isEditVerification.value = !isEditVerification.value;
}
function closeEditVerification() {
  isEditVerification.value = false;

  // pinagbabawal na teknik
  // set the hotines to empty array but store the value first to a variable
  const tempHotlines = [...hotlines.value];
  hotlines.value = [];
  setTimeout(() => {
    hotlines.value = tempHotlines;
  }, 1);
}

// delete request to delete the hotline number
function handleDelete() {
  axios.post(be_url + "/hotlines/delete", { id: deleteId.value })
    .then(({ data }) => {
      hotlines.value = data.hotlines
      isShowDelete.value = false;
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

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

// update the data when input change
function handleEdit(number, id, prov) {
  axios.post(be_url + "/hotlines/edit", { id, number, provider: prov })
    .then(({ data }) => {
      editedInput.value = { value: "", id: null, type: "" };
      isEditVerification.value = false;

      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

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

// handle add new hotline numbers
async function handleSubmit(formData) {
  return await axios.post(be_url + "/hotlines/create", { department: formData.department, smart: formData.smart, globe: formData.globe, landline: formData.landline })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      hotlines.value = data.hotlines;
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

// get all hotlines from the server
onMounted(() => {
  axios.get(be_url + "/hotlines")
    .then(({ data }) => hotlines.value = data.hotlines)
    .catch(err => console.log(err));
});

</script>

<style scoped></style>