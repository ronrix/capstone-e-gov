<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import axios from 'axios'
import { ref, onMounted } from 'vue'
import { useVuelidate } from '@vuelidate/core'
import { helpers, required, email } from '@vuelidate/validators'
import { be_url } from '../../../assets/config/config'
import Notification from '../../../components/Notification.vue'
import Loading from '../../../components/Loading.vue'

const notification = ref()
const inputFileForPdf = ref(null)
const inputFileForImage = ref([])
const isSubmitting = ref(false)
// state
const form = ref({
  fullname: '',
  email: '',
  companyName: '',
  description: '',
  location: '',
  category: 'convenience store',
  imgs: [],
  pdfFile: null
})
// rules for validation
const rules = {
  fullname: { required: helpers.withMessage('Authors name is a required field', required) },
  email: { required: helpers.withMessage('Email is a required field', required, email) },
  companyName: { required: helpers.withMessage('Company name is a required field', required) },
  description: { required: helpers.withMessage('Description is a required field', required) },
  category: { required: helpers.withMessage('Category is a required field', required) },
  location: { required: helpers.withMessage('Description is a required field', required) },
  imgs: {
    required: helpers.withMessage('Images field is a required field', required),
    array: helpers.withMessage('At least one image is required', (value) => value.length > 0)
  },
  pdfFile: {
    required: helpers.withMessage(
      'Business permit a required field to prove that your company is legit',
      required
    )
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

function showInputFileImgs() {
  // will click the hidden input file to show the file selection
  inputFileForImage.value.click()
}

function handleFileImgs(e) {
  form.value.imgs.push(e.target.files[0])
}

function removeImg(_img) {
  form.value.imgs = form.value.imgs.filter((img) => img !== _img)
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
        typeOfRequest: 'business',
        data: {
          companyName: form.value.companyName,
          description: form.value.description,
          category: form.value.category,
          location: form.value.location
        },
        imgs: form.value.imgs,
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
        companyName: '',
        description: '',
        location: '',
        category: 'convenience store',
        imgs: [],
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
    <title>Apply Form</title>
  </head>
  <HeaderSection />
  <WrapperContainer>
    <div class="mt-10">
      <h1 class="text-center text-4xl text-dark dark:text-white mb-10">Apply your business here</h1>
      <form class="mx-3 lg:mx-20" @submit.prevent="onSubmit">
        <Notification v-if="notification" :notification="notification" />
        <div class="flex flex-col md:flex-row gap-1">
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
              type="text"
            />
            <p v-if="v$.email.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.email.$errors[0].$message }}
            </p>
          </label>
        </div>
        <div class="flex flex-col md:flex-row items-start md:items-center mt-2 gap-3 mb-3">
          <label class="text-base md:text-lg text-darkgray dark:text-bggray flex-1 w-full"
            >Business name
            <p class="text-secondary text-sm font-normal">enter your full name here</p>
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
              v-model="form.location"
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
            <p v-if="v$.location.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.location.$errors[0].$message }}
            </p>
          </label>
        </div>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1 block mb-3"
          >Category
          <p class="text-secondary text-sm font-normal">which category your business belongs to</p>
          <select v-model="form.category" class="bg-slate-100 px-2">
            <option value="convenience store" selected>convenience store</option>
            <option value="mall">mall</option>
            <option value="restaurant">restaurant</option>
            <option value="apartment">apartment</option>
            <option value="bank">bank</option>
          </select>
          <p v-if="v$.category.$error && isError" class="text-xs text-red-400 mb-2">
            {{ v$.category.$errors[0].$message }}
          </p>
        </label>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1">
          Description
          <p class="text-secondary text-sm font-normal mb-1">enter your business descrition here</p>
          <textarea
            v-model="form.description"
            class="w-full overflow-y-auto scrollbar h-[400px] max-h-[400px] outline-blue-300 bg-white border p-0.5 text-normal rounded-sm"
          ></textarea>
          <p v-if="v$.description.$error && isError" class="text-xs text-red-400 mb-2">
            {{ v$.description.$errors[0].$message }}
          </p>
        </label>
        <!-- input file pdf -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center mb-5 mt-3">
          <div class="flex-1">
            <h2 class="text-sm md:text-lg text-darkgray dark:text-bggray">Business permit</h2>
            <p class="text-secondary text-sm font-normal">
              upload pdf file of your business permit
            </p>
            <p v-if="v$.pdfFile.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.pdfFile.$errors[0].$message }}
            </p>
            <p class="italic font-[600] text-primarylight">{{ form.pdfFile?.name }}</p>
          </div>
          <div class="flex-1">
            <button
              type="button"
              class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl cursor-pointer duration-100"
              @click="showInputFilePdf"
            >
              Upload file
              <i class="uil uil-plus"></i>
            </button>
            <input ref="inputFileForPdf" type="file" class="hidden" @change="handleFile" />
          </div>
        </div>
        <!-- input image -->
        <div class="flex flex-col sm:flex-row items-start md:items-center mt-5">
          <div class="flex-1">
            <h2 class="text-sm md:text-xl text-darkgray dark:text-bggray">Upload an image</h2>
            <p class="text-secondary text-sm font-normal">
              upload images of your business(maximum 3 images)
            </p>
            <p v-if="v$.imgs.$error && isError" class="text-xs text-red-400 mb-2">
              {{ v$.imgs.$errors[0].$message }}
            </p>
            <p v-for="(img, id) in form.imgs" :key="id" class="italic font-[600] text-primarylight">
              {{ img.name }}
              <i class="uil uil-times-square ml-5" @click="removeImg(img)"></i>
            </p>
          </div>
          <div class="flex-1">
            <button
              type="button"
              class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl cursor-pointer duration-100"
              @click="showInputFileImgs"
            >
              Add images
              <i class="uil uil-plus"></i>
            </button>
          </div>
          <input ref="inputFileForImage" type="file" class="hidden" @change="handleFileImgs" />
        </div>

        <button
          type="submit"
          class="px-3 py-1 bg-primary text-white hover:bg-primarylight w-full rounded-md mt-5"
        >
          <Loading v-if="isSubmitting" class="text-white w-10 h-10 mx-auto" stroke="#fff" />
          <span v-else>Submit</span>
        </button>
      </form>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped></style>