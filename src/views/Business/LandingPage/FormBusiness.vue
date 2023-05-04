<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import { ref } from 'vue'

// select image file
const inputFileForImage = ref(null)

function showInputFileImage() {
  // will click the hidden input file to show the file selection
  inputFileForImage.value.click()
}
// select file pdf
const inputFileForPdf = ref(null)

function showInputFilePdf() {
  // will click the hidden input file to show the file selection
  inputFileForPdf.value.click()
}
</script>

<template>
  <head>
    <title>Apply Form</title>
  </head>
  <HeaderSection />
  <WrapperContainer>
    <div class="mt-10">
      <h1 class="text-center text-4xl font-bold text-dark dark:text-white mb-10">
        Apply your business here
      </h1>
      <form class="mx-3 lg:mx-20" action="submit">
        <div class="flex flex-col md:flex-row gap-1">
          <label class="text-base md:text-lg text-darkgray dark:text-bggray flex-1 w-full"
            >Name
            <p class="text-secondary text-sm font-normal">enter your full name here</p>
            <input
              class="outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1"
            >Email
            <p class="text-secondary text-sm font-normal">enter your email here</p>
            <input
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
        </div>
        <div class="flex flex-col md:flex-row items-start md:items-center mt-2 gap-3 mb-3">
          <label class="text-base md:text-lg text-darkgray dark:text-bggray flex-1 w-full"
            >Business name
            <p class="text-secondary text-sm font-normal">enter your full name here</p>
            <input
              class="outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Address
            <p class="text-secondary text-sm font-normal">enter your business address here</p>
            <input
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
        </div>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1">
          Description
          <p class="text-secondary text-sm font-normal mb-1">enter your business descrition here</p>
          <textarea
            id=""
            name=""
            class="w-full overflow-y-auto scrollbar max-h-[400px] outline-blue-300 bg-white border p-0.5 text-normal rounded-sm"
          ></textarea>
        </label>
        <!-- input file pdf -->
        <div
          class="flex flex-col sm:flex-row items-start sm:items-center gap-4 sm:gap-20 mb-5 mt-3"
        >
          <div>
            <h2 class="text-sm md:text-lg text-darkgray dark:text-bggray">Business permit</h2>
            <p class="text-secondary text-sm font-normal">
              upload pdf file of your business permit
            </p>
          </div>
          <div
            class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl ml-0 sm:ml-20 md:ml-5 cursor-pointer duration-100"
            @click="showInputFilePdf"
          >
            Upload file
            <i class="uil uil-plus"></i>
            <input ref="inputFileForPdf" type="file" class="hidden" />
          </div>
        </div>
        <!-- input image -->
        <div class="flex flex-col sm:flex-row items-start md:items-center gap-4 mt-5">
          <div>
            <h2 class="text-sm md:text-xl text-darkgray dark:text-bggray">Upload an image</h2>
            <p class="text-secondary text-sm font-normal">
              upload images of your business(maximum 3 images)
            </p>
          </div>
          <div
            class="text-center border font-[600] border-primarylight px-3 py-2 md:px-4 md:py-3 text-xs text-primary hover:bg-primarylight hover:text-bggray rounded-3xl ml-0 sm:ml-20 md:ml-5 cursor-pointer duration-100"
            @click="showInputFileImage"
          >
            Add images
            <i class="uil uil-plus"></i>
          </div>
          <input ref="inputFileForImage" type="file" class="hidden" />
        </div>

        <button
          type="submit"
          class="px-3 py-1 bg-primary text-white hover:bg-primarylight w-full rounded-md mt-5"
        >
          Submit
        </button>
      </form>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>