<template>
    <MainWrapper :showAddModal="showAddModal" class="h-auto min-h-full bg-slate-100">
      <!-- show this modal when add new button was clicked -->
      <AddModal v-if="addModal" :showAddModal="showAddModal" />

      <!-- this will render other pages (news, job postings, etc) -->
      <RouterView />
    </MainWrapper>
</template>

<script setup>
import MainWrapper from "../Components/MainWrapper.vue";
import { ref } from "vue";
import { RouterView } from "vue-router";
import AddModal from "../Components/AddModal/AddModal.vue";

const addModal = ref(false);

function showAddModal() {
  console.log("toggle add modal");
  addModal.value = !addModal.value;
}

</script>

<style lang="scss" scoped>

</style>