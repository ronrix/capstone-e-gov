<template>
  <div class="h-[30px] flex justify-between items-center">
    <h3 class="font-bold text-sm"> you are in <span class="text-blue-600">{{ currentRoute }}</span></h3>

    <div class="flex items-center justify-center">
      <!-- notification -->
      <div class="relative flex mr-5">
        <i class="uil uil-bell text-xl text-gray-700 hover:text-slate-500"></i>
        <!-- notif animation -->
        <div class="absolute -right-2 -top-3">
          <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
          </span>
        </div>
      </div>

      <!-- messages -->
      <div class="relative flex mr-5">
        <i class="uil uil-comment-alt-message text-xl text-gray-700 hover:text-slate-500"></i>
          <!-- notif animation -->
        <div class="absolute -right-2 -top-3">
          <span class="relative flex h-3 w-3">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
          </span>
        </div>
      </div>

      <!-- avatar -->
      <img class="w-[30px] rounded-full" src="https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg"
        alt="">
      <i class="uil uil-angle-down text-gray-700 text-2xl"></i>
    </div>
  </div>
</template>

<script setup>
defineProps({
  currentRoute: String,
})
</script>