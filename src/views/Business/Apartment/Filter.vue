<script setup>

function showFilter() {
    const dropdown = document.querySelector('.dropdown')
    // console.log(e.target);
    dropdown.classList.toggle('hidden');

    // e.target.nextElementSibling.classList.toggle('hidden')
}
</script>

<template>
  <div class="w-full flex flex-col">
    <p class="text-xs text-secondary dark:text-gray-100 font-light ml-3 mt-0 mb-1">
      filter by different barangay
    </p>
    <div
      class="cursor-pointer w-full sm:w-[50%] md:w-[15%] rounded-md border border-gray-300 ml-2 py-1 px-2 flex items-center justify-between gap-3 relative mb-3"
      @click="showFilter"
    >
      <h1 class="text-sm lg:text-lg text-gray-600 dark:text-white">Filter by</h1>
      <i class="uil uil-filter text-lg lg:text-2xl text-gray-600 dark:text-white"></i>
      <!-- dropdown -->
      <div
        class="w-full hidden left-0 top-10 rounded-b-md dropdown absolute border bg-white dark:bg-dark border-gray-300"
      >
        <div class="flex flex-col">
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">
            Hulo
          </div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Takungan</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Imatong</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Wawa</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Bagumbayan</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Halayhayin</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Quisao</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Malaya</div>
          <div class="text-sm md:text-lg text-dark dark:text-white px-2 pb-1 hover:text-white hover:bg-blue-400">Niogan</div>
        </div>
      </div>
    </div>
    <div class="w-full h-0.5 bg-gray-300"></div>
  </div>
</template>

<style lang="scss" scoped>
</style>