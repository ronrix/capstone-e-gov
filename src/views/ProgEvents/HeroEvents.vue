<template>
  <div
    class="relative bg-no-repeat bg-cover h-[500px] overflow-hidden bg-opacity-40 bg-[url('https://images.unsplash.com/photo-1531686264889-56fdcabd163f?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80')] flex items-center justify-center after:absolute after:content-[''] after:top-0 after:left-0 after:bottom-0 after:right-0 after:bg-black/70"
  >
    <!-- overlay -->
    <div class="absolute top-0 left-0 bottom-0 right-0 bg-black/50"></div>
    <!-- text content -->
    <div class="z-10">
      <h1
        class="text-5xl font-bold text-bggray border-2 border-b-0 border-x-0 border-primarylight py-3 text-center"
      >
        Programs and Events
      </h1>
      <h2 class="text-3xl font-bold text-center text-primary flex items-center">
        <!-- line -->
        <div class="h-[2px] w-full bg-primarylight"></div>
        <span class="flex-1 capitalize">in pililla</span>
        <!-- line -->
        <div class="h-[2px] w-full bg-primarylight"></div>
      </h2>
    </div>
  </div>
</template>

<script setup>
</script>