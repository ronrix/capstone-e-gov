<template>
  <div class="flex flex-col md:flex-row items-start shadow-lg bg-white rounded-lg">
    <!-- image -->
    <div class="bg-no-repeat bg-cover bg-center h-[300px] w-full md:w-[300px] lg:w-[500px] relative bg-[url('https://images.unsplash.com/photo-1557992260-ec58e38d363c?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1374&q=80')] after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/80 after:to-white/10 after:absolute after:blur-sm"> </div>
    <!-- content -->
    <div class="flex-1 p-5 flex flex-col items-start justify-between">
      <h3 class="font-bold uppercase text-xl tracking-wide">{{ title }}</h3>
      <h5 class="text-xs text-gray-500 font-bold">{{ new Date() }}</h5>
      <p class="mt-5 text-ellipsis text-sm h-[100px] overflow-hidden">
        {{ content }}
      </p>
      <button @click="showNewsModal" class="bg-blue-400 px-3 py-2 text-white font-bold text-xs self-end mt-5 uppercase">view </button>
    </div>
  </div>
</template>

<script setup>
defineProps({
  title: String,
  content: String,
  showNewsModal: Function
});
</script>