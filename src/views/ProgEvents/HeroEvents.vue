<template>
  <div
    class="relative bg-no-repeat bg-cover h-[500px] overflow-hidden bg-[url('https://images.unsplash.com/photo-1531686264889-56fdcabd163f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80')] flex items-center justify-center">
    <!-- overlay -->
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50"></div>
    <!-- text content -->
    <div class="z-10">
      <h1 class="uppercase text-5xl font-bold text-bggray border-2 border-b-0 border-x-0 border-primarylight py-3">
        the best events
      </h1>
      <h2 class="text-3xl font-bold text-center text-primary flex items-center">
        <!-- line -->
        <div class="h-[2px] w-full bg-primarn dylight"></div>
        <span class="flex-1 capitalize">in pililla</span>
        <!-- line -->
        <div class="h-[2px] w-full bg-primarylight"></div>
      </h2>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { axiosInstance } from "../../utils/axios-instance";

onMounted(() => {
  axiosInstance().get('http://localhost:8000/news', { withCredentials: true })
    .then(response => {
      console.log(response.data);
    })
    .catch(err => console.log(err));
});
</script>