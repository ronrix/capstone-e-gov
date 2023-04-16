<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
</script>
<template >
  <head>
    <title>Tourist Attractions | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  <WrapperContainer class="mt-20">
    <div class="flex flex-col lg:flex-row items-end justify-evenly pb-0 gap-2">
      <div class="self-start ">
        <h1 class="text-5xl md:text-7xl font-semibold text-dark dark:text-bggray">
          Tourist <span class="block ml-20">Attraction</span>
        </h1>
        <p class="pt-12 w-full lg:w-1/2 italic text-dark dark:text-bggray ">
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua"
        </p>
      </div>
      <div class="flex  ">
        <div
          class="drop-shadow-lg h-[300px] sm:h-[400px] w-[200px] sm:w-[300px] bg-slate-300 bg-auto bg-no-repeat bg-center z-10 translate-y-36 sm:translate-y-32 "
          style="background-image: url()"
        >
          <img
            class="h-full object-cover"
            src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
            alt=""
          />
        </div>
        <div
          class="drop-shadow-lg h-[300px] sm:h-[400px] w-[210px] sm:w-[310px] bg-slate-300 bg-auto bg-no-repeat bg-center   translate-y-5 sm:translate-y-0 "
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
    class="h-[400px] bg-dark w-full  bg-auto bg-no-repeat bg-center flex flex-1 items-center mb-20 "
  >
    <img class="w-1/2 translate-y-44 sm:translate-y-28 translate-x-24 sm:translate-x-0 " src="https://i.postimg.cc/nrGCXPV1/windmillnobg-VECTOR.png" alt="" />
    <div class="text-white absolute right-2  z-20 ">
      <p class="font-semibold pt-5 text-4xl ">Lorem ipsum
      <span class="w-[400px] text-sm  pt-4 block font-normal">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.
      </span></p>
    </div>
  </div>
  <WrapperContainer>
    <div class="sm:flex justify-between drop-shadow-md gap-5">
      <div class="-order-first sm:-order-last">
        <h2 class="text-5xl 5xl:text-5xl font-semibold pt-5 text-dark dark:text-bggray">Wind farm</h2>
        <p class="font-normal text-sm mt-3 w-3/4 text-dark dark:text-bggray">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.
        </p>
      </div>
      <img
        class="w-full sm:w-1/2 sm:rounded-bl-full "
        src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        alt=""
      />
    </div>
    <div class="sm:flex justify-between drop-shadow-md mt-20 gap-5">
      
      <img
        class="w-full sm:w-1/2 sm:rounded-tr-full"
        src="http://www.wewander.ph/wp-content/uploads/2019/06/Screen-Shot-2019-06-30-at-9.24.59-AM-17-1024x573.jpg"
        alt=""
      />
      <div>
        <h2 class="text-5xl font-semibold pt-5 text-dark dark:text-bggray">Mt. Sembrano</h2>
        <p class="block w-3/4 font-normal text-sm mt-3 text-dark dark:text-bggray">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.
        </p>
      </div>
    </div>
  </WrapperContainer>

  <FooterSection></FooterSection>
</template>

<style>
</style>