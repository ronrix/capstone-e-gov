<template>
  <div class="flex flex-col bg-white rounded-md p-3 shadow-md relative overflow-hidden">
    <!-- delete -->
    <Delete new_class="md:translate-x-[90%]" />

    <img class="h-[250px]" :src="official.img" :alt="official.name">

    <h5 class="text-gray-500 text-base font-bold uppercase">{{ official.position }}</h5>
    <h3 class="text-gray-800 text-2xl font-bold capitalize">{{ official.name }}</h3>

  </div>
</template>

<script setup>
import Delete from '../../../Components/Delete.vue';

defineProps({
  official: Object
})
</script>