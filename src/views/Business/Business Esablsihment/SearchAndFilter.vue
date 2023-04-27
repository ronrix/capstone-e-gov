<script setup>
</script>

<template>
  <div class="w-full flex flex-col md:flex-row items-center justify-center gap-2 md:gap-3 mt-16">
    <!-- search  -->
    <div
      class="w-full md:w-80 flex flex-row gap-3 items-center bg-white dark:bg-dark border border-gray-400 rounded-lg p-1 md:p-2"
    >
      <i class="uil uil-search text-lg text-dark dark:text-white"></i>
      <input
        class="w-full border-none outline-none bg-white dark:bg-dark text-sm text-dark dark:text-white placeholder:dark:text-white"
        type="text"
        placeholder="search business"
      />
    </div>
    <!-- filter by -->
    <select
      class="w-full md:w-auto outline-none px-2 py-1 md:py-2 items-center border border-gray-400 bg-white dark:bg-dark rounded-lg relative text-lg text-dark dark:text-white">
        <option value="" selected>All</option>
        <option value="">Restaurant</option>
        <option value="">Department Store</option>
        <option value="">Gas Station</option>
        <option value="">Pharmacy</option>
        <option value="">Bank</option>
    </select>
  </div>
</template>

<style lang="scss" scoped>
</style>