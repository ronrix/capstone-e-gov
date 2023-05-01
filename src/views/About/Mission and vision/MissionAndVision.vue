<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
</script>


<template>
    <HeaderSection />
        <div class="w-full mt-10 flex flex-col  items-center mb-20 ">
            <h1 class="text-center text-gray-800 dark:text-gray-400 font-bold text-4xl md:text-5xl mb-5 md:mb-10">Our <span class="text-dark dark:text-white"> Mission </span><span class="block"><span class="text-dark dark:text-white">&</span> Vision</span></h1>
          <div class="flex flex-col mx-16 md:mx-32 lg:mx-44 gap-5">
            <div class="flex flex-col">
                <h2 class="text-primary dark:text-primarylight text-xl sm:text-2xl md:text-3xl font-bold mb-2 md:mb-3 font-display">Mission</h2>
                <p class="text-base lg:text-lg text-gray-700 dark:text-white text-justify font-normal">“To improve the economic condition of the people of Pililla through the introduction of better economic opportunities, enhancement of revenue generation and better accessibility of basic services and needs.”</p>
            </div>
            <div class="flex flex-col">
                <h2 class="text-primary dark:text-primarylight text-xl sm:text-2xl md:text-3xl font-bold mb-3 md:mb-5 font-display">Vision</h2>
                <p class="text-base lg:text-lg text-gray-700 dark:text-white text-justify font-normal">“We envision Pililla as the alternative energy capital of the Philippines, with a God-fearing, peaceful, disaster resilient community, conducive to sustainable development and efficient management of natural and land resources through active, participative, responsive and committed leadership.”</p>
            </div>
        </div>
        </div>
        <WrapperContainer>

        </WrapperContainer>
    <FooterSection />
</template>

<style lang="scss" scoped>

</style>