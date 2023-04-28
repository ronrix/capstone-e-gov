<script setup>
import BploModal from './BploModal.vue'

defineProps({
  data : {type : Object, required : true}
})

import { ref } from 'vue'

const isPermitModal = ref(false)
function showPermitModal(){
  isPermitModal.value = !isPermitModal.value;
}
</script>

<template>
      <div
        class="flex items-center justify-between bg-white dark:bg-dark rounded-lg border py-5 px-3 border-gray-300 shadow-sm mb-1"
      >
        <h4 class="flex-1 text-dark dark:text-white text-sm md:text-base lg:text-lg font-bold capitalize">
         {{ data.name }}
        </h4>
        <button class="flex items-center gap-1 bg-gray-100 hover:bg-gray-200 rounded-full ml-2 py-1 px-4 md:px-5 lg:px-6 text-xs sm:text-sm text-gray-500 hover:text-gray-600 uppercase font-bold" @click="showPermitModal" 
        >
          view
          <i
            class="uil uil-angle-right-b text-gray-500 hover:text-gray-600 text-lg md:text-xl font-bold"
          ></i>
        </button>
      </div>
      <!-- business permit modal -->
      <BploModal v-if="isPermitModal" :show-permit-modal="showPermitModal" />
</template>


<style lang="scss" scoped>
</style>