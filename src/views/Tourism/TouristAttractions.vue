<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
</script>
<template >
  <HeaderSection></HeaderSection>
  <div class="">
    <div class="flex justify-between p-20 pb-0">
      <div>
        <h1 class="text-7xl font-semibold">Tourist <span class="block ml-20">Attraction</span></h1>
        <p class="pt-12 w-[700px] italic">
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.
        </p>
      </div>
      <div>
        <div class="flex h-[600px] relative pr-20">
          <div
            class="drop-shadow-lg h-[400px] w-[300px] bg-slate-300 bg-auto bg-no-repeat bg-center -skew-x-12 self-end absolute right-[350px] z-10"
            style="background-image: url()"
          >
            <img
              class="h-full contrast-"
              src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
              alt=""
            />
          </div>
          <div
            class="drop-shadow-lg h-[400px] w-[310px] bg-slate-300 bg-auto bg-no-repeat bg-center -skew-x-12 z-10"
            style="background-image: url()"
          >
            <img
              class="h-full"
              src="https://villagepipol.com/wp-content/uploads/2022/07/Pililla-Wind-Farm-Tanay-Rizal-FI-800x752.jpg"
              alt=""
            />
          </div>
        </div>
      </div>
    </div>
    <div
      class="h-[400px] bg-black w-full -translate-y-52 bg-auto bg-no-repeat bg-center"
      style="background-image: url()"
    >
      <div class="flex justify-between">
        <div class="pt-6">
          <img
            class="w-[800px]"
            src="https://i.postimg.cc/nrGCXPV1/windmillnobg-VECTOR.png"
            alt=""
          />
        </div>
        <div class="text-white">
          <p class="font-semibold pt-5 text-4xl">Lorem ipsum</p>
          <p class="w-[400px] text-sm pr-20 pt-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="pr-20 pl-20">
    <div class="flex justify-between bg-white drop-shadow-md">
      <h2 class="text-5xl font-semibold pl-10 pt-5">
        Wind farm<span class="block w-[600px] font-normal text-sm mt-3"
          >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.</span
        >
      </h2>
      <div></div>
      <img
        class="w-[50%] rounded-bl-full"
        src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        alt=""
      />
    </div>
    <div class="flex justify-between bg-white drop-shadow-md">
      <img
        class="w-[50%] rounded-tr-full"
        src="http://www.wewander.ph/wp-content/uploads/2019/06/Screen-Shot-2019-06-30-at-9.24.59-AM-17-1024x573.jpg"
        alt=""
      />
      <h2 class="text-5xl font-semibold pl-10 pt-5">
        Mt. Sembrano<span class="block w-[600px] font-normal text-sm mt-3"
          >Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
          ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
          ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur
          sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
          est laborum.</span
        >
      </h2>
      <div></div>
    </div>
  </div>

  <FooterSection></FooterSection>
</template>

<style>
</style>