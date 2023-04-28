<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
</script>

<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="w-full flex flex-col mt-10">
      <h1 class="self-center text-4xl md:text-5xl text-gray-700 dark:text-gray-100 font-bold mb-1">
        Contact us!
      </h1>
      <p class="self-center text-lg text-secondary dark:text-gray-400">
        let us help to assist you wiht your concerns.
      </p>

      <div class="grid grid-cols-1 md:grid-cols-3 mt-5 p-5 px-2">
        <div class="flex flex-col">
            <!-- contacts -->
          <div class="flex items-center gap-1 mb-2">
            <i class="uil uil-phone text-2xl text-gray-800 dark:text-white"></i>
            <h2 class="text-lg md:text-xl font-bold text-dark dark:text-white capitalize">
              Contact numbers
            </h2>
          </div>
          <div class="flex flex-col mb-3">
            <p class="text-lg md:text-sm text-dark dark:text-white">+63-944-765-3637</p>
            <p class="text-lg md:text-sm text-dark">+63-296-321-456</p>
          </div>
          <div class="flex flex-col">
            <p class="text-lg md:text-sm text-dark">8123-4567</p>
            <p class="text-lg md:text-sm text-dark">02-8123-4567</p>
          </div>
        </div>
             <!-- social media -->
          <div class="flex flex-col ">
            <h2 class="text-lg md:text-xl font-bold text-dark dark:text-white capitalize mb-2">
              Social Media
            </h2>
            <div class="flex items-center gap-2 mb-3 cursor-pointer">
                <i class="uil uil-facebook-f text-xl text-blue-500"></i>
                <p class="text-lg md:text-sm text-dark dark:text-white">facebook.com/BetterPililla</p>
            </div>
            <div class="flex items-center gap-2 mb-3 cursor-pointer">
                <i class="uil uil-envelope text-xl text-primary"></i>
                <p class="text-lg md:text-sm text-dark dark:text-white">better_pililla@gmail.com</p>
            </div>
          </div>
            <!-- business hours -->
            <div class="flex flex-col mb-2">
                <h2 class="text-lg md:text-xl font-bold text-dark dark:text-white capitalize mb-2">
              Business hours
            </h2>
            <p class="text-lg md:text-sm text-dark dark:text-white">Monday - Friday <span class="block"> 8 am to 5 pm</span></p>
            </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style lang="scss" scoped>
</style>