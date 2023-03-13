<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex items-start">
      <!-- close modal btn -->
      <i @click="showNewsModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <!-- left -->
      <!-- news thumbnail -->
      <div class="flex-1 overflow-hidden mt-5 group relative">
        <!-- hover design -->
        <div class="absolute top-0 bottom-0 right-0 left-0 flex justify-center bg-black/10 text-white font-bold opacity-0 group-hover:opacity-100 duration-100">
          <span class="uppercase border p-2 bg-black/30 cursor-pointer">view</span>
        </div>
        <img :src="selectedData?.img" alt="this is the thumbnail of news">
      </div>

      <!-- right -->
      <div class="flex-1 p-3">
        <!-- title -->
        <h4 class="font-bold text-2xl flex items-center">
          <span class="cursor-pointer capitalize">{{ selectedData?.title }}</span>
          <i class="uil uil-edit-alt ml-3 text-base"></i>
        </h4>
        <h5 class="text-xs text-gray-500 font-bold">{{ new Date() }}</h5>
        <!-- content -->
        <p class="text-sm mt-5 cursor-pointer overflow-scroll no-scrollbar h-[200px]">
          {{ selectedData?.content }}
          {{ selectedData?.content }}
          {{ selectedData?.content }}
          {{ selectedData?.content }}
          {{ selectedData?.content }}
          {{ selectedData?.content }}
          {{ selectedData?.content }}
        </p>

        <div class="flex items-center justify-end mt-10">
          <button class="px-4 border border-blue-600 hover:bg-blue-600 hover:text-white">cancel</button>
          <button class="px-4 bg-blue-600 ml-3 text-white">save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  showNewsModal: Function,
  selectedData: {}
});

</script>

<style scroped>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>