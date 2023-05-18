<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import axios from 'axios'
import { onMounted, ref } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { helpers, required, email } from '@vuelidate/validators'
import { be_url } from '../../assets/config/config'
import Notification from '../../components/Notification.vue'
import Loading from '../../components/Loading.vue'

const notification = ref()
const inputFileForPdf = ref(null)
const inputFileForLogo = ref([])
const isSubmitting = ref(false)
// state
const form = ref({
  fullname: '',
  email: '',
  logo: '',
  title: '',
  companyName: '',
  address: '',
  salary: '',
  jobDescription: '',
  schedules: [],
  pdfFile: null
})
// rules for validation
const rules = {
  fullname: { required: helpers.withMessage('Authors name is a required field', required) },
  email: { required: helpers.withMessage('Email is a required field', required, email) },
  title: { required: helpers.withMessage('Job title is a required field', required) },
  logo: { required: helpers.withMessage('Company Logo is a required field', required) },
  companyName: { required: helpers.withMessage('Company name is a required field', required) },
  address: { required: helpers.withMessage('Address is a required field', required) },
  jobDescription: { required: helpers.withMessage('Description is a required field', required) },
  schedules: {
    required: helpers.withMessage('Schedules is a required field', required),
    array: helpers.withMessage('At least one schedule is required', (value) => value.length > 0)
  },
  pdfFile: {
    required: helpers.withMessage(
      'Business permit a required field to prove that your company is legit',
      required
    ),
    fileSize: helpers.withMessage(
      'File size should not exceed 5MB',
      (value) => value && value.size <= 5242880
    ),
    fileExtension: helpers.withMessage('Only PDF files are allowed', (value) => {
      if (!value) return true // Allow empty value (optional field)
      const allowedExtensions = ['pdf']
      const fileExtension = value.name.split('.').pop().toLowerCase()
      return allowedExtensions.includes(fileExtension)
    })
  }
}
const isError = ref(false) // this state is used to display the error message when inputs are not valid
const v$ = useVuelidate(rules, form)

function showInputFilePdf() {
  // will click the hidden input file to show the file selection
  inputFileForPdf.value.click()
}

function handleFile(e) {
  form.value.pdfFile = e.target.files[0]
}

function showInputFileLogo() {
  // will click the hidden input file to show the file selection
  inputFileForLogo.value.click()
}

function handleFileLogo(e) {
  form.value.logo = e.target.files[0]
}

async function onSubmit() {
  const valid = await v$.value.$validate()
  if (!valid) {
    isError.value = true
    return
  }
  isSubmitting.value = true

  axios
    .post(
      be_url + '/api/event',
      {
        author: form.value.fullname,
        email: form.value.email,
        typeOfRequest: 'job opportunity',
        data: {
          title: form.value.title,
          logo: form.value.logo,
          companyName: form.value.companyName,
          description: form.value.jobDescription,
          location: form.value.address,
          salary: form.value.salary,
          schedules: form.value.schedules
        },
        imgs: Array.from([form.value.logo]),
        proofFiles: form.value.pdfFile
      },
      {
        headers: {
          'Content-Type': 'multipart/form-data'
        },
        withCredentials: true
      }
    )
    .then(({ data }) => {
      notification.value = data.res
      setTimeout(() => {
        notification.value = null
      }, 5000)
      // reset the states
      form.value = {
        fullname: '',
        email: '',
        title: '',
        logo: '',
        companyName: '',
        address: '',
        salary: '',
        jobDescription: '',
        schedules: [],
        pdfFile: null
      }
      // set the isSubmitting to false to remove the loading animation
      isSubmitting.value = false
    })
    .catch((err) => {
      notification.value = err.response.data.res
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)
})
</script>
<template>
  <head>
    <title>Job Form</title>
  </head>
  <HeaderSection />
  <WrapperContainer>
    <div class="grid place-items-center my-10">
      <h1 class="text-3xl md:text-5xl text-center text-dark dark:text-bggray">
        Submit a request to post Job opportunity
      </h1>
      <form class="mx-3 lg:mx-10 w-full md:w-[700px] p-5 mt-5" @submit.prevent="onSubmit">
        <Notification v-if="notification" :notification="notification" />
        <div class="flex flex-col gap-1">
          <label class="text-base md:text-lg text-darkgray dark:text-bggray flex-1 w-full"
            >Name
            <p class="text-secondary text-sm font-normal">enter your full name here</p>
            <input
              v-model="form.fullname"
              class="outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
            <p v-if="v$.fullname.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.fullname.$errors[0].$message }}
            </p>
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1"
            >Email
            <p class="text-secondary text-sm font-normal">enter your email here</p>
            <input
              v-model="form.email"
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="email"
            />
            <p v-if="v$.email.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.email.$errors[0].$message }}
            </p>
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1"
            >Job title
            <p class="text-secondary text-sm font-normal">enter the job title or position</p>
            <input
              v-model="form.title"
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
            <p v-if="v$.title.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.title.$errors[0].$message }}
            </p>
          </label>
        </div>
        <div class="flex flex-col md:flex-row items-start md:items-center mt-2 gap-3 mb-3">
          <label class="text-base md:text-lg text-darkgray dark:text-bggray flex-1 w-full"
            >Company name
            <p class="text-secondary text-sm font-normal">enter your company name here</p>
            <input
              v-model="form.companyName"
              class="outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
            <p v-if="v$.companyName.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.companyName.$errors[0].$message }}
            </p>
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Address
            <p class="text-secondary text-sm font-normal">enter your business address here</p>
            <input
              v-model="form.address"
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
            <p v-if="v$.address.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.address.$errors[0].$message }}
            </p>
          </label>
        </div>
        <div></div>
        <div class="flex flex-col md:flex-row gap-3 sm:mb-2">
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Salary
            <p class="text-secondary text-sm font-normal">enter your salary here</p>
            <input
              v-model="form.salary"
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Working Schedule
            <div class="grid grid-cols-2 gap-y-2">
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="full time"
                  name="schedules"
                />
                Full time
              </label>
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="part time"
                  name="schedules"
                />
                Part time
              </label>

              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="contractual"
                  name="schedules"
                />
                Contractual
              </label>
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="freelance"
                  name="schedules"
                />
                Freelance
              </label>
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="internship"
                  name="job_schedule"
                />
                Internship
              </label>
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input
                  v-model="form.schedules"
                  type="checkbox"
                  value="remote"
                  name="job_schedule"
                />
                Remote
              </label>

              <!-- <div class="sm:flex items-center mr-4 sm:mb-2 gap-2"> -->
              <label class="text-secondary text-sm font-normal flex items-center gap-1">
                <input v-model="form.schedules" type="checkbox" value="fixed" name="schedules" />
                Fixed
              </label>
            </div>
            <p v-if="v$.schedules.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.schedules.$errors[0].$message }}
            </p>
          </label>
        </div>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1">
          Job Description
          <p class="text-secondary text-sm font-normal mb-1">enter your job description here</p>
          <textarea
            v-model="form.jobDescription"
            class="w-full overflow-y-auto scrollbar h-[400px] max-h-[400px] outline-blue-300 bg-white border p-0.5 text-normal rounded-sm"
          ></textarea>
          <p v-if="v$.jobDescription.$error && isError" class="text-xs text-red-400 mb-2">
            {{ v$.jobDescription.$errors[0].$message }}
          </p>
        </label>
        <!-- input file logo -->
        <div class="flex items-center gap-10 mb-5 mt-3">
          <div>
            <h2 class="text-sm md:text-lg text-darkgray dark:text-bggray">Company Logo</h2>
            <p class="text-secondary text-sm font-normal">
              we need company logo to provide authenticity
            </p>
            <p v-if="v$.logo.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.logo.$errors[0].$message }}
            </p>
            <p class="italic font-[600] text-primarylight">{{ form.logo?.name }}</p>
          </div>
          <div
            class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl cursor-pointer duration-100"
            @click="showInputFileLogo"
          >
            Upload file
            <i class="uil uil-plus"></i>
            <input ref="inputFileForLogo" type="file" class="hidden" @change="handleFileLogo" />
          </div>
        </div>
        <!-- input file pdf -->
        <div class="flex items-center gap-10 mb-5 mt-3">
          <div>
            <h2 class="text-sm md:text-lg text-darkgray dark:text-bggray">Business permit</h2>
            <p class="text-secondary text-sm font-normal">
              upload a file to prove that you a legit company
            </p>
            <p v-if="v$.pdfFile.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.pdfFile.$errors[0].$message }}
            </p>
            <p class="italic font-[600] text-primarylight">{{ form.pdfFile?.name }}</p>
          </div>
          <div
            class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl cursor-pointer duration-100"
            @click="showInputFilePdf"
          >
            Upload file
            <i class="uil uil-plus"></i>
            <input ref="inputFileForPdf" type="file" class="hidden" @change="handleFile" />
          </div>
        </div>
        <button
          type="submit"
          class="px-3 py-1 bg-primary text-white hover:bg-primarylight w-full rounded-md"
        >
          <Loading v-if="isSubmitting" class="text-white w-10 h-10 mx-auto" stroke="#fff" />
          <span v-else>Submit</span>
        </button>
      </form>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>
