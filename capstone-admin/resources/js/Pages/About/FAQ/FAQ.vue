<template>
  <HeadTitle title="FAQs" />
  <!-- response message -->
  <Notifcation :msg="resMsg" class="z-[1000]" />

  <WrapperContent>
    <h3 class="font-bold text-lg lg:text-2xl">Frequently Asked Questions</h3>

    <FAQCard v-for="(data, idx) in faqs" :key="idx" :data="data" :handle-update-f-a-q="handleUpdateFAQ"
      :handle-delete-f-a-q="handleDeleteFAQ" />

    <!-- add new news btn -->
    <AddBtn :showAddModal="showAddModal" class="z-20" />
    <AddFAQModal v-if="isAddModal" :close-modal="showAddModal" :handle-create-f-a-q="handleCreateFAQ" />
  </WrapperContent>
</template>

<script setup>
import AddBtn from '../../../Components/AddModal/AddBtn.vue';
import Notifcation from '../../../Components/Notifcation.vue';
import AddFAQModal from './AddFAQModal.vue';
import FAQCard from './FAQCard.vue';
import { ref, onMounted } from "vue"
import axios from 'axios';

const resMsg = ref();
const isAddModal = ref(false);
function showAddModal() {
  isAddModal.value = !isAddModal.value;
}

async function handleUpdateFAQ(formData, id) {
  return await axios.post('/faq/edit', {
    id,
    question: formData.question,
    answer: formData.answer,
  }).then(({ data }) => {
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    faqs.value = data.faqs;
    return data
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

async function handleDeleteFAQ(id) {
  return await axios.post('/faq/delete', {
    id
  }).then(({ data }) => {
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    faqs.value = data.faqs;
    return data
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

async function handleCreateFAQ(formData) {
  return await axios.post('/faq/add', {
    question: formData.question,
    answer: formData.answer,
  }).then(({ data }) => {
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    faqs.value = data.faqs;
    return data
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

const faqs = ref([]);

onMounted(() => {
  axios.get("/faq")
    .then(({ data }) => {
      faqs.value = data.faqs;
    })
});
</script>