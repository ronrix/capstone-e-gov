<template>
  <div @click="showDeleteOption" class="w-full h-full flex items-center justify-center bg-red-500 top-0 left-0 absolute text-white rounded-bl-lg -translate-y-[95%] md:-translate-y-[90%] translate-x-[95%] md:translate-x-[97%] duration-500 cursor-pointer ease-in-out">
    <div class="text-center delay-300 flex flex-col">
      <i class="uil uil-trash text-3xl"></i>
      <h5 class="text-lg font-bold">Are you sure you want to delete this?</h5>
      <button @click="cancel" class="w-full border py-2 px-5 mt-3 bg-gray-500 hover:bg-gray-400 font-bold text-sm">No, I don't want to delete this</button>
      <button class="w-full border py-2 px-5 hover:bg-red-600 hover:border-red-600 font-bold text-sm">Yes, I want to delete this</button>
    </div>
  </div>

  <i class="uil uil-times absolute top-0 right-0 lg:right-2 text-white pointer-events-none text-xs md:text-lg"></i>
</template>

<script setup>

function showDeleteOption(e) {
  e.target.classList.add("!translate-y-0");
  e.target.classList.add("!translate-x-0");
}

function cancel(e) {
  e.target.parentElement.parentElement.classList.remove("!translate-y-0");
  e.target.parentElement.parentElement.classList.remove("!translate-x-0");
}


</script>

<style lang="scss" scoped>

</style>