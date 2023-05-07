<template>
  <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-50">
    <form @submit.prevent="onSubmit"
      class="backdrop-blur-xl bg-white/70 sm:w-[500px] p-5 rounded-lg flex flex-col border gap-2">

      <!-- close modal btn -->
      <i @click="closeModal"
        class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

      <div>
        <h3 class="font-bold text-xl text-gray-900 capitalize">Add new Job</h3>
        <p class="text-sm text-gray-500">Make sure to fill all the fields before submitting</p>
      </div>

      <!-- inputs  -->
      <div class="overflow-y-auto h-[400px] scrollbar flex flex-col gap-3">
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Company logo</span>
          <input name="logo" type="file" @change="handleSelectLogo" class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.logo.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.logo.$errors[0].$message
          }} </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Author</span>
          <input v-model="formData.author" name="author" type="text" placeholder="Enter the author of this job post..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.author.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.author.$errors[0].$message
          }}
          </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Email</span>
          <input v-model="formData.email" name="email" type="text" placeholder="Enter the email for the job hunters..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.email.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.email.$errors[0].$message
          }}
          </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Company name</span>
          <input v-model="formData.companyName" name="email" type="text" placeholder="Enter the company name..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.companyName.$error && isError" class="text-xs text-red-400 mb-2"> {{
            v$.companyName.$errors[0].$message
          }}
          </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">What is job position</span>
          <input v-model="formData.job_title" name="postiion" type="text" placeholder="Type the job title here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_title.$error && isError" class="text-xs text-red-400 mb-2"> {{ v$.job_title.$errors[0].$message
          }} </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Where is the job located</span>
          <input v-model="formData.job_location" name="location" type="text" placeholder="Type the job location here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_location.$error && isError" class="text-xs text-red-400 mb-2"> {{
            v$.job_location.$errors[0].$message }}
          </p>
        </label>
        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Job description</span>
          <textarea v-model="formData.job_description" name="description" placeholder="Type the content here..."
            class="rounded-md py-1 h-[80px] resize-none sm:max-h-[200px] focus:outline-blue-600 scrollbar touch-auto text-sm"></textarea>
          <p v-if="v$.job_description.$error && isError" class="text-xs text-red-400 mb-2"> {{
            v$.job_description.$errors[0].$message }}
          </p>
        </label>

        <label class="flex flex-col">
          <span class="text-sm font-bold text-gray-600">Salary range</span>
          <input v-model="formData.job_salary" name="salary" type="text" placeholder="Type the salary range here..."
            class="rounded-md p-2 focus:outline-blue-600 text-sm">
          <p v-if="v$.job_salary.$error && isError" class="text-xs text-red-400 mb-2"> {{
            v$.job_salary.$errors[0].$message }}
          </p>
        </label>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1">
          <span class="text-sm font-bold text-gray-600">Working Schedule</span>
          <div class="grid grid-cols-2 gap-y-2">
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="full time" name="job_schedule" />
              Full time
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="part time" name="job_schedule" />
              Part time
            </label>

            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="internship" name="job_schedule" />
              Internship
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="remote" name="job_schedule" />
              Remote
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="freelance" name="job_schedule" />
              Freelance
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="temporary" name="job_schedule" />
              Temporary
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="fixed term" name="job_schedule" />
              Fixed Term
            </label>
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="contractual" name="job_schedule" />
              Contractual
            </label>

            <!-- <div class="sm:flex items-center mr-4 sm:mb-2 gap-2"> -->
            <label class="text-secondary text-sm font-normal flex items-center gap-1">
              <input v-model="formData.job_schedule" type="checkbox" value="fixed" name="job_schedule" />
              Fixed
            </label>
          </div>
          <p v-if="v$.job_schedule.$error && isError" class="text-xs text-red-400 mb-2">
            {{ v$.job_schedule.$errors[0].$message }}
          </p>
        </label>
      </div>

      <button :disabled="isSubmitting" type="submit" :class="{ 'bg-blue-500': isSubmitting }"
        class="active:-translate-y-[1px] mt-5 bg-blue-600 px-5 py-2 text-white rounded-md font-bold uppercase flex items-center justify-center">
        <Loading class="w-5 h-5 mr-2" v-if="isSubmitting" color="#fff" />
        <span v-if="!isSubmitting">save</span>
      </button>
    </form>
  </div>
</template>

<script setup>
import { onMounted, onUnmounted, computed, ref } from 'vue';
// validation
import useVuelidate from "@vuelidate/core";
import { required, helpers, email } from "@vuelidate/validators"
import { useForm } from "@inertiajs/inertia-vue3";
import Loading from '../../../Components/Loading.vue';

const { handleCreate } = defineProps({
  closeModal: Function,
  handleCreate: Function,
});

// adding rules for validation of the form
const rules = computed(() => ({
  logo: { required: helpers.withMessage("Logo is required", required) },
  job_title: { required: helpers.withMessage("The field job title is required", required) },
  companyName: { required: helpers.withMessage("The field company name is required", required) },
  author: { required: helpers.withMessage("The field author is required", required) },
  email: { required: helpers.withMessage("The field email is required", required, email) },
  job_location: { required: helpers.withMessage("The field job location is required", required) },
  job_description: { required: helpers.withMessage("The field job description is required", required) },
  job_salary: { required: helpers.withMessage("The field job salary is required", required) },
  job_schedule: {
    required: helpers.withMessage("The field job schedule is required", required),
    array: helpers.withMessage('At least one schedule is required', (value) => value.length > 0)
  },
}));
const formData = useForm({
  logo: null,
  job_title: "",
  companyName: "",
  author: "",
  email: "",
  job_location: "",
  job_description: "",
  job_salary: "",
  job_schedule: [],
});
const v$ = useVuelidate(rules, formData);
const isError = ref(false);
const isSubmitting = ref(false);

function handleSelectLogo(e) {
  formData.logo = e.target.files[0];
}

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