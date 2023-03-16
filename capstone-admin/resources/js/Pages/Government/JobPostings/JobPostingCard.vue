<template>
  <div class="bg-white rounded-md p-3 flex flex-col shadow-md w-full sm:w-auto">
     <!--top  -->
    <div>
      <p class="text-gray-600 uppercase font-bold text-sm">{{ data?.category }}</p>
      <h5 class="text-xl font-bold mt-2">{{ data?.titlePosition }}</h5>
    </div>

    <!-- middle -->
    <div class="my-8">
      <h6 class="text-gray-600 font-bold text-sm">Candidate:</h6>

      <!-- total needed employees -->
      <div class="rounded-lg bg-gray-200 text-center text-xl font-bold uppercase p-2 mt-2">
        total {{data?.totalCandidates }}
      </div>
    </div>

    <!-- bottom -->
    <div class="text-gray-600 flex items-center text-sm capitalize whitespace-pre-wrap">
      {{ data?.location }} 
      <i class="uil uil-angle-right"></i>
      {{ data?.workType.join(" | ") }}
    </div>

    <button class="mt-3 outline-none font-bold text-sm text-gray-600 self-end hover:text-gray-500">
      See Details
      <i class="uil uil-angle-right"></i>
    </button>
  </div>
</template>

<script setup>
defineProps({
  data: Object,
});
</script>