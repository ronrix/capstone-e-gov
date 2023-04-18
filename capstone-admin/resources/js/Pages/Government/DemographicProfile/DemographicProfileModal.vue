<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-20">
    <div class="bg-white sm:w-[700px] p-5 rounded-lg relative">
      <!-- close modal btn -->
      <i @click="showModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <h4 class="capitalize font-bold text-gray-800 text-xl">Add new census</h4>
      <p class="text-gray-500 text-sm mb-3">Add the current census gathered for each barangays</p>
      <form @submit.prevent="onSubmit" class="flex flex-col gap-5">
        <label class="w-full flex flex-col text-gray-800">
          <span class="font-bold text-sm uppercase">
            cencus year
            <i class="uil uil-angle-down"></i>
          </span>
          <input type="text" v-model="formData.census_year" class="border p-3 focus:outline-blue-600"
            placeholder="set year">
          <p v-if="v$.census_year.$error && isError" class="text-xs text-red-400 mb-2"> {{
            v$.census_year.$errors[0].$message }}</p>
        </label>

        <div class="overflow-y-scroll h-[300px] scrollbar">
          <table class="text-left w-full">
            <thead>
              <tr class="bg-neutral-200 text-xs md:text-sm">
                <th class="px-2 text-center"><i class="uil uil-list-ui-alt"></i></th>
                <th class="pl-2 py-2 text-neutral-600">
                  Barangay
                  <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
                </th>
                <th class="pl-2 py-2 text-neutral-600">
                  Male
                  <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
                </th>
                <th class="pl-2 py-2 text-neutral-600">
                  Female
                  <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
                </th>
                <th class="pl-2 py-2 text-neutral-600">
                  Religion
                </th>
                <th class="pl-2 py-2 text-neutral-600">
                  Number of Household
                  <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="barangay, idx in barangays" :key="idx" class="text-xs md:text-sm font-medium border">
                <td class="bg-white text-center">{{ idx + 1 }}</td>
                <td class="bg-white border pl-2 border-l-0"> {{ barangay }}</td>
                <td class="bg-white border pl-2 border-l-0">
                  <input type="number" v-model="formData.barangays[idx].census.male"
                    class="focus:outline-blue-500 py-2 w-full overflow-scroll no-scrollbar m-0 text-sm">
                </td>
                <td class="bg-white border pl-2 border-l-0">
                  <input type="number" v-model="formData.barangays[idx].census.female"
                    class="focus:outline-blue-500 py-2 w-full overflow-scroll no-scrollbar m-0 text-sm">
                </td>
                <td class="bg-white border pl-2 border-l-0">
                  <div class="overflow-y-scroll scrollbar h-[50px]">
                    <div v-for="rel, relId in religions" :key="relId">
                      <span class="capitalize font-semibold">{{ rel }}</span>
                      <input type="number" v-model="formData.barangays[idx].religion[relId].count"
                        class="focus:outline-blue-500 w-full overflow-scroll no-scrollbar m-0 text-sm">
                    </div>
                  </div>
                </td>
                <td class="bg-white border pl-2 border-l-0">
                  <input type="number" v-model="formData.barangays[idx].census.household"
                    class="focus:outline-blue-500 py-2 w-full overflow-scroll no-scrollbar m-0 text-sm">
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <button type="submit"
          class="active:-translate-y-1 p-2 bg-blue-600 text-white font-bold cursor-pointer uppercase flex items-center justify-center rounded-md text-sm">
          <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" color="#fff" />
          <span v-if="!isSubmitting">save</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { computed, ref, onMounted, onUnmounted } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import Loading from '../../../Components/Loading.vue';
import { populationFormData } from "../../../config/config";

// adding rules for validation of the form
const rules = computed(() => ({
  census_year: { required: helpers.withMessage("The field census year is required", required) },
}));

const formData = useForm(populationFormData);

const isError = ref(false);
const v$ = useVuelidate(rules, formData);
const isSubmitting = ref(false);

const barangays = [
  "Bagumbayan",
  "Halayhayin",
  "Hulo",
  "Imatong",
  "Malaya",
  "Niogan",
  "Quisao",
  "Takungan",
  "Wawa"
];
const religions = [
  "Roman Catholic",
  "Aglipay",
  "Iglesia ni cristo",
  "Islam",
  "Others",
];

async function onSubmit() {
  // invoke validation
  // return when not inputs are not valid
  const valid = await v$.value.$validate();
  if (!valid) {
    isError.value = true;
    return;
  }

  isSubmitting.value = true;
  if (isError.value) isError.value = false; // remove the error message from displaying when validation passed
  handleCreate(formData).then(() => {
    isSubmitting.value = false;
    formData.reset();
  })
}

const { handleCreate } = defineProps({
  showModal: Function,
  handleCreate: Function
});

// add scroll hidden on unmount
onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});
</script>