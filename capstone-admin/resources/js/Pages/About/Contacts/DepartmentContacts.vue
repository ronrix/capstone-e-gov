<template>
  <!-- list -->
  <div class="flex items-center gap-2 mt-2">
    <p class="w-[150px] text-xs md:text-sm text-gray-700 font-medium capitalize">
      {{ keyName }}
    </p>
    <div class="flex flex-wrap items-center gap-2">
      <input v-for="(num, arrId) in nums" :key="num" :value="num" type="number"
        @change.capture="(e) => showEditVerification(e.target.value, id, keyName, arrId)"
        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
        maxlength="11"
        class="focus:outline-blue-500 border p-2 overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx]">

      <button v-if="!isNewNumber" @click="addNewContact" type="button"
        class="text-xl cursor-pointer rounded-full text-blue-600 hover:text-blue-400 ml-3">
        <i class="uil uil-plus-circle pointer-events-none"></i>
      </button>

      <!-- save btn -->
      <button v-if="isNewNumber" @click="onAddNew" type="button"
        class="text-sm cursor-pointer rounded-full text-green-600 hover:text-green-400 ml-3 border border-green-600 px-3">
        save
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

// reference the element when it is ready to be saved
// so when user click cancel, we can removed the element
const toBeSavedNumber = ref();

// this will be the state to display the save btn
// and hide te add new btn
const isNewNumber = ref(false);

// this function adds new requirement
function addNewContact(e) {
  const input = document.createElement('input');
  input.className = "focus:outline-blue-500 border p-2 overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx]";
  // focus the input
  input.focus();
  input.maxLength = "11";
  input.oninput = function (e) {
    if (e.target.value.length > e.target.maxLength) {
      e.target.value = e.target.value.slice(0, e.target.maxLength);
    }
  }

  // function for save btn
  input.addEventListener("change", (ev) => {
    toBeSavedNumber.value = ev.target;
  });
  toBeSavedNumber.value = null;

  isNewNumber.value = true;
  e.target.parentElement.insertBefore(input, e.target);
}

// create new function to handle the adding new number
// the "handleAddNewNumber" returns a promise which used in here so we can hide the edit verification modal
// after submitting the request
function onAddNew() {
  handleAddNewNumber(toBeSavedNumber.value.value, id, keyName.replace(" ", "_")).then(() => {
    isVerification.value = false;
  });
  toBeSavedNumber.value = null;
  isNewNumber.value = false;
}

const { id, nums, keyName, handleAddNewNumber, showEditVerification } = defineProps({
  keyName: String,
  nums: Array,
  showEditVerification: Function,
  handleAddNewNumber: Function,
  id: Number
})
</script>

<style lang="scss" scoped></style>