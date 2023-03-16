<template>
  <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
      <!-- close modal btn -->
      <i @click="showHotlineModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
      <h4 class="font-bold text-xl text-gray-900">Create new hotline</h4>
      <p class="text-sm text-gray-500">Create new hotline number to help citizens contact departments when emergency comes.</p>

      <form @submit="submitFn" class="w-full mt-3 flex flex-col gap-3">
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Department</span>
          <p class="text-xs text-gray-500">add the department name below</p>
          <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
        <label class="flex flex-col w-full">
          <span class="font-bold text-gray-500">Number</span>
          <p class="text-xs text-gray-500">add the contact number below</p>
          <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
        </label>
      
        <input type="submit" value="Save" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer">
      </form>
    </div>
  </div>
</template>

<script setup>

function submitFn(e) {
  console.log("you submit me");
  e.preventDefault();
}

defineProps({
  showHotlineModal: Function,
})
</script>