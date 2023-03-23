<template>
  <!-- add new news btn -->
  <button @click="showAddModal"
    class="active:-translate-y-[1px] rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
    <i class="uil uil-plus text-2xl text-white"></i>
  </button>
</template>

<script setup>
defineProps({
  showAddModal: Function
})
</script>