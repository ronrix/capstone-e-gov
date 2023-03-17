<template>
  <WrapperContent>
    <h1 class="text-3xl text-center font-bold text-gray-700">Contact Us</h1>
    <p class="text-sm text-gray-500 text-center mb-2">here's our contact info</p>
    
    <div class="w-full flex flex-col lg:flex-row justify-center lg:justify-between  rounded-lg bg-white p-10">
     
      <!-- first col -->
      <div class="first-col mb-3">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Phone Number</h3>
        <FirstCol v-for="(first, index) in number" :first="first" />
      </div>

      <!-- second col -->
      <div class="second-col mb-3">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Social Media Account</h3>
        <SecondCol v-for="(second, index) in social" :second="second" />
      </div>
      <!-- third col -->
      <div class="third-col mb-3">
        <h3 class="text-lg font-semibold text-gray-800 mb-1">Business Hours</h3>
        <ThirdCol v-for="(third, index) in business" :third="third" />
      </div>

    </div>
  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import FirstCol from './FirstCol.vue'
import SecondCol from './SecondCol.vue'
import ThirdCol from './ThirdCol.vue'

  // object array
const number = [
  {
    mobilePh: "+63-(046)-xxx-xxx",
    mobileInt: "+63-(0926)-xxx-xxx",
    telephoneNum:"+1-(750)-xxx-xxx",
  }
]

const social = [
  {
    fb: "Facebook",
    gmail: "Gmail",
    twitter:"Twitter",
  }
]

const business = [
  {
    week: "Monday - Friday",
    time: "8am - 6pm",
  }
]
</script>

<style scoped></style>