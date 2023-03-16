<template>
  <WrapperContent>
    <h3 class="font-bold text-xl mb-3">Municipal Hotlines</h3>
    <!-- hotlines table -->
    <div class="w-full flex flex-col">
      <table class="text-left border-separate w-full">
        <thead>
          <tr class="bg-gray-200 text-xs md:text-sm">
            <th class="flex items-center justify-between">
              Departments
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th>Numbers</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="a in filteredData" class="text-xs md:text-sm font-medium">
            <td class="bg-white">
              <textarea v-model="a.department" class="p-3 w-full overflow-scroll no-scrollbar m-0 text-sm font-bold h-[40px] max-h-[40ppx]">{{ a.department }}</textarea>
            </td>
            <td class="bg-white">
              <textarea v-model="a.number" class="p-3 w-full overflow-scroll no-scrollbar m-0 text-sm font-bold h-[40px] max-h-[40ppx]">{{ a.number }}</textarea>
            </td>
            <td class="bg-white text-center"><button class="border border-red-600 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm font-bold rounded-md">delete</button></td>
          </tr>
        </tbody>
      </table>
      <!-- add btn -->
      <button @click="showHotlineModal" class="border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end mt-5 flex items-center justify-center rounded-lg px-5 uppercase text-md font-bold">
        new
        <i class="uil uil-plus-circle m-0 ml-2"></i>
      </button>
    </div>

    <!-- hotline modal -->
    <HotlineModal v-if="isHotlineModal" :showHotlineModal="showHotlineModal" :sample_data="sample_data" />

  </WrapperContent>
</template>

<script setup>
import HotlineModal from "./HotlineModal.vue";
import { ref } from 'vue';

const hotlines = [
  {
    department: "Bureau of Fire Protection",
    number: "091283109",
  },
  {
    department: "Department of Health",
    number: "09981298",
  },
  {
    department: "Department oF Agriculture",
    number: "09292992",
  },
  {
    department: "Department of Sky",
    number: "091290848",
  },
]
const isSortedIncrease = ref(true);
const filteredData = ref(hotlines);

const isHotlineModal = ref(false);
function showHotlineModal() {
  isHotlineModal.value = !isHotlineModal.value;
}

function sortFn() {
  isSortedIncrease.value = !isSortedIncrease.value;

  // incresing
  if(isSortedIncrease.value) {
    filteredData.value.sort((a, b) => {
      let fa = a.department.toLowerCase(),
      fb = b.department.toLowerCase();

      if (fa < fb) {
          return -1;
      }
      if (fa > fb) {
          return 1;
      }
      return 0;
    });

    return;
  }
  // decreasing
  filteredData.value.sort((a, b) => {
    let fa = a.department.toLowerCase(),
    fb = b.department.toLowerCase();

    if (fa > fb) {
        return -1;
    }
    if (fa < fb) {
        return 1;
    }
    return 0;
  });
}

</script>

<style scoped>
td, th {
}

</style>