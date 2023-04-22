<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import Carousel from '../../components/Carousel/Carousel.vue'

const sample_card = [
  {
    title: 'Lorem Ipsum',
    imgSrc:
      'https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur ut labore et dolore magna aliqua'
  },
  {
    title: 'Lorem Ipsum',
    imgSrc:
      'https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur ut labore et dolore magna aliqua'
  },
  {
    title: 'Lorem Ipsum',
    imgSrc:
      'https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg',
    description: 'Lorem ipsum dolor sit amet, consectetur ut labore et dolore magna aliqua'
  }
]
</script>
<template >
  <head>
    <title>Tourist Attractions | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  <WrapperContainer class="mt-20">
    <div class="flex flex-col lg:flex-row items-end justify-evenly pb-0 gap-2">
      <div class="self-start">
        <h1 class="text-5xl md:text-7xl font-semibold text-dark dark:text-bggray">
          Tourist <span class="block ml-20 text-primary">Attraction</span>
        </h1>
        <p class="pt-12 w-full lg:w-1/2 italic text-dark dark:text-bggray">
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua"
        </p>
      </div>
      <div class="flex">
        <div
          class="topimage drop-shadow-lg h-[300px] sm:h-[400px] w-[200px] sm:w-[300px] bg-slate-300 bg-auto bg-no-repeat bg-center z-10 translate-y-36 sm:translate-y-32"
          style="background-image: url()"
        >
          <img
            class="h-full object-cover"
            src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
            alt=""
          />
        </div>
        <div
          class="topimage drop-shadow-lg h-[300px] sm:h-[400px] w-[210px] sm:w-[310px] bg-slate-300 bg-auto bg-no-repeat bg-center translate-y-5 sm:translate-y-0"
        >
          <img
            class="h-full object-cover"
            src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
            alt=""
          />
        </div>
      </div>
    </div>
  </WrapperContainer>
  <div
    class="h-[400px] bg-dark w-full bg-auto bg-no-repeat bg-center flex flex-1 items-center mb-5 sm:mb-20"
  >
    <img
      class="w-1/2 translate-y-44 sm:translate-y-28 translate-x-24 sm:translate-x-0"
      src="https://i.postimg.cc/nrGCXPV1/windmillnobg-VECTOR.png"
      alt=""
    />
    <div class="bg-text text-white absolute right-2 z-20">
      <p class="font-semibold pt-5 text-4xl">
        Lorem ipsum
        <span class="bg-description w-[400px] text-sm pt-4 block font-normal">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </span>
      </p>
    </div>
  </div>
  <carousel></carousel>
  <WrapperContainer>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mt-5 gap-5 rounded-lg">
      <div
        v-for="(data, idx) in sample_card"
        :key="idx"
        class="cards flex flex-col dark:bg-dark rounded-lg"
        style="border: 1px solid #d8d8d8"
      >
        <img class="object-cover h-[250px] w-full" :src="data.imgSrc" alt="" />
        <div class="py-5 px-3">
          <p class="font-bold text-3xl pb-4">
            {{ data.title }}
          </p>
          <p class="text-md">{{ data.description }}</p>
        </div>
      </div>
    </div>
  </WrapperContainer>

  <FooterSection></FooterSection>
</template>

<style scoped>
.cards:hover {
  transform: translateY(-6px);
  border: none;
  z-index: 2;
  -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
@media (max-width: 375px) {
  .topimage {
    transform: translateX(40px);
    transform: translateY(144px);
    z-index: 10;
    display: none;
  }
  .bg-text {
    position: absolute;
    left: 5px;
  }
  .bg-description {
    width: 350px;
    margin-right: 0px;
  }
}
</style>