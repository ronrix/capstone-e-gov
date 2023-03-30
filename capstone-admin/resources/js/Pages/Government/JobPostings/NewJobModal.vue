<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-50">
    <form @submit.prevent="onSubmit"
      class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border gap-2">

      <!-- close modal btn -->
      <i @click="closeModal" class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <div>
        <h3 class="font-bold text-xl text-gray-900 capitalize">Add new Job</h3>
        <p class="text-sm text-gray-500">Make sure to fill all the fields before submitting</p>
      </div>

      <!-- inputs  -->
      <div class="overflow-y-scroll h-[400px] scrollbar">
        <label class="flex flex-col">
          <span class="text-sm font-bold mb-2 text-gray-600">Tell us what is position of the job is this</span>
          <input v-model="formData.job_title" name="title" type="text" placeholder="Type the job title here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_title.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_title.$errors[0].$message }} </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold mb-2 text-gray-600">Tell us where is the job located</span>
          <input v-model="formData.job_location" name="title" type="text" placeholder="Type the job location here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_location.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_location.$errors[0].$message }}
          </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold mb-2 text-gray-600">Tell us the job description</span>
          <textarea v-model="formData.job_description" name="description" placeholder="Type the content here..."
            class="rounded-md p-2 h-[80px] sm:max-h-[200px] focus:outline-blue-600 scrollbar touch-auto text-sm"></textarea>
          <p v-if="v$.job_description.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_description.$errors[0].$message }}
          </p>
        </label>
        <div class="flex items-center gap-2">
          <label class="flex flex-col">
            <span class="text-sm font-bold mb-2 text-gray-600">Type of this job?</span>
            <input v-model="formData.job_type" name="title" type="text" placeholder="Type it here..."
              class="rounded-md p-2 focus:outline-blue-600 text-sm">
            <p v-if="v$.job_type.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_type.$errors[0].$message }}
            </p>
          </label>
          <label class="flex flex-col">
            <span class="text-sm font-bold mb-2 text-gray-600">Salary range</span>
            <input v-model="formData.job_salary" name="title" type="text" placeholder="Type the salary range here..."
              class="rounded-md p-2 focus:outline-blue-600 text-sm">
            <p v-if="v$.job_salary.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_salary.$errors[0].$message }}
            </p>
          </label>
        </div>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Job schedules</span>
          <span class="text-xs text-gray-500 mb-2">Add comma "," separated. e.g (remote, full time, part time)</span>
          <input v-model="formData.job_schedule" name="title" type="text" placeholder="Type the schedules here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_schedule.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_schedule.$errors[0].$message }}
          </p>
        </label>
      </div>

      <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
        class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center">
        <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" />
        save
      </button>
    </form>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, computed, ref } from 'vue';
// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers } from "@vuelidate/validators"
import { useForm } from "@inertiajs/inertia-vue3";

const { handleCreate } = defineProps({
  closeModal: Function,
  handleCreate: Function,
});

// adding rules for validation of the form
const rules = computed(() => ({
  job_title: { required: helpers.withMessage("The field job title is required", required) },
  job_location: { required: helpers.withMessage("The field job location is required", required) },
  job_description: { required: helpers.withMessage("The field job description is required", required) },
  job_type: { required: helpers.withMessage("The field job type is required", required) },
  job_salary: { required: helpers.withMessage("The field job salary is required", required) },
  job_schedule: { required: helpers.withMessage("The field job schedule is required", required) },
}));
const formData = useForm({
  job_title: "",
  job_type: "",
  job_location: "",
  job_description: "",
  job_salary: "",
  job_schedule: "",
});
const v$ = useVuelidate(rules, formData);
const isError = ref(false);
const isSubmitting = ref(false);

async function onSubmit() {
   // invoke validation
  // return when not inputs are not valid
  const valid = await v$.value.$validate();
  if (!valid) {
    isError.value = true;
    return;
  }

  isSubmitting.value = true;
  handleCreate(formData).then((data) => {
    isSubmitting.value = false;
    if (data.res.status >= 400) {
      formData.imgFile = null;
      selectedImg.value = "";
      return;
    }
    formData.reset();
  });
}

// add scroll hidden on mount
onMounted(() => {
  document.body.classList.add("overflow-hidden");
});

// remove scroll hidden on unmount
onUnmounted(() => {
  document.body.classList.remove("overflow-hidden");
});

</script>