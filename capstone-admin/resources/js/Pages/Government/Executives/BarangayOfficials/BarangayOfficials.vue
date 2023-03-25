<template>
  <HeadTitle title="Former Officials"></HeadTitle>
  <WrapperContent>
    <h1 class="text-xl font-bold capitalize">Current officials of pililla rizal</h1>

    <!-- cards -->
    <div class="flex items-center flex-wrap gap-3 mt-5">
      <CardOfficial v-for="official in dataBarangayOfficials" :official="official" />
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

import { be_url } from '../../../../config/config';
import CardOfficial from '../CardOfficial.vue';
import OfficialModal from '../OfficialModal.vue';

const dataBarangayOfficials = ref([]);

const isModalShow = ref(false);
function toggleShowModal() {
  isModalShow.value = !isModalShow.value;
}

function handleSubmit(formData) {
  console.log(formData);
}

// get all the data from the server with axios
onMounted(() => {
  axios.get(be_url + "/barangay-officials")
  .then(({data}) => {
    dataBarangayOfficials.value = data.barangayOfficials;
  })
  .catch(err => console.log(err));
});
</script>