<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
</script>
<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="grid place-items-center my-10">
      <h1 class="text-5xl text-center text-dark dark:text-bggray">
        Submit a request to post Job opportunity
      </h1>
      <form
        class="mx-3 lg:mx-10 w-full md:w-[700px] border border-dark dark:border-secondary p-5 mt-5"
        action="submit"
      >
        <div class="flex flex-col gap-1">
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
            >Company name
            <p class="text-secondary text-sm font-normal">enter your company name here</p>
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
        <div>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Contact Number
            <p class="text-secondary text-sm font-normal">enter your contact number here</p>
            <input
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
        </div>
        <div class="flex gap-3">
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Salary
            <p class="text-secondary text-sm font-normal">enter your salary here</p>
            <input
              class="flex-1 outline-blue-300 bg-white border p-2 md:p-0.5 text-normal rounded-sm w-full"
              type="text"
            />
          </label>
          <label class="text-sm md:text-lg text-darkgray dark:text-bggray w-full flex-1"
            >Working Schedule
            <div class="flex items-center mr-4 mb-2 gap-2">
              <label class="text-secondary text-sm font-normal flex items-center">
                <input type="checkbox" value="yes" />
                Full time
              </label>
              <label class="text-secondary text-sm font-normal flex items-center">
                <input type="checkbox" value="yes" />
                Part time
              </label>
            </div>
          </label>
        </div>
        <label class="text-sm md:text-lg text-darkgray dark:text-bggray flex-1">
          Job Description
          <p class="text-secondary text-sm font-normal mb-1">enter your job description here</p>
          <textarea
            id=""
            name=""
            class="w-full overflow-y-auto scrollbar max-h-[400px] outline-blue-300 bg-white border p-0.5 text-normal rounded-sm"
          ></textarea>
        </label>
        <!-- input file pdf -->
        <div class="flex items-center gap-20 mb-5 mt-3">
          <div>
            <h2 class="text-sm md:text-lg text-darkgray dark:text-bggray">Business permit</h2>
            <p class="text-secondary text-sm font-normal">
              upload pdf file of your business permit
            </p>
          </div>
          <div class="flex items-center gap-4">
            <div class="text-sm md:text-normal">Upload file</div>
            <i
              class="uil uil-plus-circle text-dark hover:text-blue-600 text-xl :text-2xl cursor-pointer"
              @click="showInputFilePdf"
            ></i>
            <input ref="inputFileForPdf" type="file" class="hidden" />
          </div>
        </div>
        <!-- input image -->
        <!-- <div class="flex flex-col sm:flex-row md:items-center gap-4 mt-5">
          <div class="flex-1">
            <h2 class="text-sm md:text-xl text-darkgray dark:text-bggray">Upload an image</h2>
            <p class="text-secondary text-sm font-normal">
              upload images of your business(maximum 3 images)
            </p>
          </div>
          <div
            class="bg-blue-600 dark:bg-blue-700 hover:bg-blue-500 dark:hover:bg-blue-600 px-3 py-2 md:px-5 md:py-3 text-xs text-white rounded-3xl cursor-pointer"
            @click="showInputFileImage"
          >
            Add images
            <i class="uil uil-plus text-white"></i>
          </div>
          <input ref="inputFileForImage" type="file" class="hidden" />
        </div> -->

        <button
          type="submit"
          class="px-3 py-1 bg-primary text-white hover:bg-primarylight w-full rounded-md"
        >
          submit
        </button>
      </form>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style>
</style>