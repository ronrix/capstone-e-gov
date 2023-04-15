<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
</script>
<template >
  <head>
    <title>Tourism Attractions | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  <WrapperContainer class="mt-20">
    <div class="flex flex-col lg:flex-row items-end justify-evenly pb-0 gap-5">
      <div class="self-start">
        <h1 class="text-3xl md:text-7xl font-semibold text-dark dark:text-bggray">
          Tourist <span class="block ml-20">Attraction</span>
        </h1>
        <p class="pt-12 w-full lg:w-1/2 italic text-dark dark:text-bggray">
          "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum."
        </p>
      </div>
      <div class="flex h-[600px] relative">
        <div
          class="drop-shadow-lg h-[400px] w-[300px] bg-slate-300 bg-auto bg-no-repeat bg-center -skew-x-12 self-end absolute right-[350px] z-10"
          style="background-image: url()"
        >
          <img
            class="h-full object-cover"
            src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
            alt=""
          />
        </div>
        <div
          class="drop-shadow-lg h-[400px] w-[310px] bg-slate-300 bg-auto bg-no-repeat bg-center -skew-x-12"
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
    class="h-[400px] bg-dark w-full -translate-y-52 bg-auto bg-no-repeat bg-center flex items-center"
  >
    <img class="w-1/2" src="https://i.postimg.cc/nrGCXPV1/windmillnobg-VECTOR.png" alt="" />
    <div class="text-white absolute right-10 z-20">
      <p class="font-semibold pt-5 text-4xl">Lorem ipsum</p>
      <p class="w-[400px] text-sm pr-20 pt-4">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat.
      </p>
    </div>
  </div>
  <WrapperContainer>
    <div class="flex justify-between drop-shadow-md gap-5">
      <div>
        <h2 class="text-5xl font-semibold pt-5 text-dark dark:text-bggray">Wind farm</h2>
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
        class="w-1/2 rounded-bl-full"
        src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        alt=""
      />
    </div>
    <div class="flex justify-between drop-shadow-md mt-20 gap-5">
      <img
        class="w-1/2 rounded-tr-full"
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