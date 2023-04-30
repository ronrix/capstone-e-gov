<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
</script>


<template>
    <HeaderSection />
        <div class="w-full mt-5 md:mt-10 flex flex-col md:flex-row justify-between items-center mb-20 lg:mb-32 px-5 p pt-5 relative">
            <h1 class="flex-1 text-gray-800 dark:text-gray-400 font-bold text-3xl sm:text-4xl lg:text-5xl ml-0 md:ml-10 lg:ml-32 mb-10 md:mb-0">Our <span class="text-dark dark:text-white"> Mission </span><span class="block ml-0 md:ml-3 mt-1"><span class="text-dark dark:text-white">&</span> Vision</span></h1>
          <div class="flex flex-col mr-10 w-[50%] gap-5 lg:gap-10">
            <div class="flex flex-col">
                <h2 class="text-primary dark:text-primarylight text-xl md:text-2xl xl:text-3xl font-bold mb-2 lg:mb-3 font-display">Mission</h2>
                <p class="text-base lg:text-lg text-dark dark:text-white text-justify font-light">“To improve the economic condition of the people of Pililla through the introduction of better economic opportunities, enhancement of revenue generation and better accessibility of basic services and needs.”</p>
            </div>
            <div class="flex flex-col">
                <h2 class="text-primary dark:text-primarylight text-xl md:text-2xl xl:text-3xl font-bold mb-2 lg:mb-3 font-display">Vision</h2>
                <p class="text-base lg:text-lg text-dark dark:text-white text-justify font-light">“We envision Pililla as the alternative energy capital of the Philippines, with a God-fearing, peaceful, disaster resilient community, conducive to sustainable development and efficient management of natural and land resources through active, participative, responsive and committed leadership.”</p>
            </div>
          </div>
          <div class="absolute bg-primary opacity-5 w-0 md:w-[310px] lg:w-[320px] md:h-[310px] lg:h-[320px] -left-24 lg:-left-2 rounded-full -z-10"></div>
        </div>
        <WrapperContainer>

        </WrapperContainer>
    <FooterSection />
</template>

<style lang="scss" scoped>

</style>