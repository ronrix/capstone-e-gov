<template>
  <div class="backdrop-blue-lg bg-white/50 rounded-md p-5 flex flex-col w-full h-[350px] overflow-hidden relative">
    <!--top  -->
    <div class="flex items-center justify-between mb-5 relative">
      <!-- circle -->
      <div :style="{ backgroundColor: `${bgColor.bgColor || '#f2f2f2'}` }" class="w-14 h-14 rounded-full"></div>
      <span class="font-bold text-gray-400 text-xs">{{ new Date(data.created_at).toLocaleDateString("en-PH", {
        month:
          "long", day: "numeric"
      }) }}</span>

      <!-- delete -->
      <div @click="showDeleteVerificiationModal"
        class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-0 top-0 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
        delete</div>
    </div>

    <!-- delete verfication modal -->
    <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="data.id"
      :handleDelete="onDelete" />

    <!-- job type -->
    <div class="flex-1">
      <h5 class="text-xl font-bold text-gray-800 line-clamp-1">{{ data?.job_title }}</h5>
      <h6 class="text-sm font-bold text-gray-500">{{ data?.job_type }}</h6>
      <div class="flex items-center gap-2 mt-3 overflow-x-scroll">
        <div v-for="jt in workTypes" :key="jt"
          class="px-2 py-1 text-[10px] rounded-full capitalize font-[500] whitespace-nowrap" :style="{
              backgroundColor: (colors.find(col => col.type === jt.trim()))?.bgColor,
              color: (colors.find(col => col.type === jt.trim()))?.textColor,
            }">
          {{ jt }}
        </div>
      </div>
    </div>

    <!-- middle -->
    <div class="mt-8 overflow-hidden flex-1">
      <h5 class="font-bold text-gray-900">{{ new Intl.NumberFormat("en-US", {
        style: "currency", currency: "php"
      }).format(data.job_salary) }}</h5>
      <h6 class="text-gray-600 font-bold text-sm">{{ data.job_location }}</h6>
    </div>

    <button type="button" @click="showModal(data)"
      class="active:-translate-y-1 rounded-md border border-blue-600 hover:bg-blue-600 hover:text-white mt-3 outline-none font-bold text-sm self-end p-3">
      See More
      <i class="uil uil-angle-right"></i>
    </button>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

const workTypes = ref(data.job_schedule.split(","));
const bgColor = ref("");
onMounted(() => {
  const randomIdx = Math.floor(Math.random() * workTypes.value.length);
  bgColor.value = colors.find(col => {
    const type = workTypes.value[randomIdx].trim()
    return col.type === type;
  });
});

const isVerificationModal = ref(false);
// function to show the delete verfication modal
function showDeleteVerificiationModal() {
  isVerificationModal.value = !isVerificationModal.value;
}

// handle delete
function onDelete() {
  handleDelete(data.id).then(() => {
    isVerificationModal.value = false;
  });
}

const { data, colors, handleDelete } = defineProps({
  data: Object,
  showModal: Function,
  colors: Array,
  handleDelete: Function,
});
</script>