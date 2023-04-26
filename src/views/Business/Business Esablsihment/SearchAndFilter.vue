<script setup>
</script>

<template>
  <div class="w-full flex flex-col md:flex-row items-start md:items-center gap-2 md:gap-3 mt-12">
    <!-- search  -->
    <div
      class="w-full md:w-60 flex flex-row gap-3 items-center bg-white dark:bg-dark border border-gray-400 rounded-lg py-2 px-3"
    >
      <i class="uil uil-search text-sm text-dark dark:text-white"></i>
      <input
        class="w-full border-none outline-none bg-white dark:bg-dark text-sm text-dark dark:text-white placeholder:dark:text-white"
        type="text"
        placeholder="search business"
      />
    </div>
    <!-- filter by -->
    <select
      class="w-full md:w-auto outline-none py-1 items-center border border-gray-400 bg-white dark:bg-dark rounded-lg relative text-sm text-dark dark:text-white">
        <option value="" selected>All</option>
        <option value="hulo">Hulo</option>
        <option value="takungan">Takungan</option>
        <option value="imatong">Imatong</option>
        <option value="bagumbayan">Bagumbayan</option>
        <option value="wawa">Wawa</option>
        <option value="halayhayin">Halayhayin</option>
        <option value="quisao">Quisao</option>
        <option value="malaya">Malaya</option>
        <option value="niogan">Niogan</option>
    </select>
  </div>
</template>

<style lang="scss" scoped>
</style>