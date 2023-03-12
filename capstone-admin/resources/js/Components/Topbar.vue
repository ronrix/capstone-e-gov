<template>
  <div class="h-[30px] flex justify-between items-center relative">
    <Navs v-show="isMobileNavsVisible" :isWholeSidebar="true" class="w-screen fixed top-10 left-0 right-0 bottom-0 z-20 h-screen bg-white text-black sm:hidden" />
    <div class="flex flex-col items-start pt-7">
      <div class="m-0 p-0 sm:hidden">
        <i :class="{'block': !isMobileNavsVisible, 'hidden': isMobileNavsVisible}" @click="showMovileNavs" class="uil uil-list-ui-alt text-gray-800 sm:hidden hover:text-blue-800 text-4xl"></i>
        <i :class="{'!block': isMobileNavsVisible}" @click="showMovileNavs" class="hidden uil uil-times text-gray-800 sm:hidden hover:text-blue-800 text-4xl slef-start"></i>
      </div>
      <h3 class="font-bold text-sm"> you are in <span class="text-blue-600">{{ currentRoute }}</span></h3>
    </div>

    <div class="flex items-end md:items-center justify-center">
      <!-- notification -->
      <div class="relative flex mr-5">
        <i class="uil uil-bell text-xl text-gray-700 hover:text-slate-500"></i>
        <!-- notif animation -->
        <div class="absolute -right-2 -top-1">
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
        <div class="absolute -right-2 -top-1">
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
import { ref, onUpdated } from 'vue';
import Navs from './Sidebar/Navs.vue';

const isMobileNavsVisible = ref(false);

function showMovileNavs() {
  isMobileNavsVisible.value = !isMobileNavsVisible.value;
}

onUpdated(() => {
  // prevent the document from scrolling if the mobile nav is visible
  if(isMobileNavsVisible.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});

defineProps({
  currentRoute: String,
})
</script>