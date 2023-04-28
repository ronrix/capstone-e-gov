<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import Carousel from '../../components/Carousel/CarouselImgCard.vue'
import {ref} from 'vue'
const texthover = ref(false)
function hoverover(){
  texthover.value = true


}
function hoverout(){
  texthover.value = false
  

}



</script>
<template>
  <head>
    <title>Festival | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  
    <div>
      <div class="sm:flex justify-end">
    <div 
      class="group items-center text-bggray text-7xl hover:rounded-none hover:w-full duration-500 bg-no-repeat bg-center contrast-150 h-[600px] rounded-none sm:rounded-bl-full sm:w-3/5"
      style="background-image: url(https://scontent.fmnl25-5.fna.fbcdn.net/v/t39.30808-6/294631385_168890845630966_4287727958245532156_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=0debeb&_nc_eui2=AeG69spQ2qYT5NS83eS9rxGhXaCR1tnWinddoJHW2daKd19K-Ogt0U_AHA_KODqkdmkPbclnSJX-H9SxP1XceQ7U&_nc_ohc=ZfpKpkn2qlYAX-i20sa&_nc_ht=scontent.fmnl25-5.fna&oh=00_AfAZ8-IU2unkhRHguG4HtA75nCd0fVBJPauxJemJdKdI-w&oe=644961DF)"
      @mouseover="hoverover" @mouseout="hoverout"
      >
    <!-- <h1 class="invisible group-hover:visible sm:invisible">Magsalongtan Festival</h1> -->
    </div>
  </div>
    <p :class="{'!text-white' :texthover, 'text-white  sm:!text-dark dark:!text-bggray' :!texthover}" class=" drop-shadow-md sm:pl-10 text-7xl md:text-7xl lg:text-8xl font-bold  absolute sm:top-60 -bottom-48 ">
        Pililla Rizal<span :class="{'!text-white' :texthover, 'text-white  sm:text-red-600 dark:!text-bggray' :!texthover}" class="block font-['display'] italic text-bggray sm:text-red-600">Festival</span>
      </p>
    </div>
    <WrapperContainer>
    <div class="sm:flex drop-shadow-md h-auto pb-5 pt-20">
        <div class="sm:w-1/2 drop-shadow-lg">
          <carousel></carousel>
        </div>
      <p class="sm:pl-10 self-center text-dark dark:text-bggray text-sm md:text-sm ">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
  </WrapperContainer>
  <div style="background-color: #f5f5f5;">
    <WrapperContainer>
      <div class="h-[600px] w-full sm:pt-28">
        <div class="flex flex-col md:flex-row justify-evenly drop-shadow-md gap-5">
          <div>
            <h2 class="text-3xl sm:text-5xl font-semibold text-dark dark:text-dark">Magsolangtan Festival</h2>
            <p class="blockfont-normal text-sm  mt-3 text-dark dark:text-dark">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
              exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
              dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
          <img
            class="sm:w-[50%] order-first sm:order-last"
            src="https://scontent.fmnl25-5.fna.fbcdn.net/v/t39.30808-6/294828742_168890512297666_6697916517948535727_n.jpg?_nc_cat=104&ccb=1-7&_nc_sid=0debeb&_nc_eui2=AeFoC5JY1hBsjZRujCcVlI2pTeiYwEcQAQ9N6JjARxABD5qrfjHGyCzYZgNgaWmUfuiiIK-aArSqAWR-RRLO7sYo&_nc_ohc=5OOT-XjVIx0AX_UObQT&_nc_ht=scontent.fmnl25-5.fna&oh=00_AfB_J6wgBfqG-6qrIZfBR4fU3WGB7YGxejcicBajXprp_g&oe=6449767C"
            alt=""
          />
        </div>
      </div>
  
    </WrapperContainer>
  </div>
  <FooterSection></FooterSection>
</template>
<style >
</style>