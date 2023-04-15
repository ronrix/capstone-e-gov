<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
</script>
<template>
  <head>
    <title>Festival | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  <div class="grid">
    <div
      class="flex justify-evenly items-center bg-auto bg-no-repeat bg-center contrast-150 ..."
      style="background-image: url()"
    >
      <p class="pl-20 text-8xl pt-10 font-bold text-dark dark:text-bggray">
        Pililla Rizal<span class="block font-['display'] italic text-red-600">Festival</span>
      </p>
      <div class="flex-1">
        <img
          class="w-full rounded-bl-full"
          src="https://scontent.fmnl25-2.fna.fbcdn.net/v/t1.6435-9/37954445_915526281972378_1758665335344463872_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeHl_E-2KxR9Mc_qGpN0dQBFRxc4mjhGlv1HFziaOEaW_R8W0gha9nabo7Lg3AEZPItH337iJ1c6eUyB593SfraQ&_nc_ohc=MGLmCzITthUAX-VwSNm&_nc_ht=scontent.fmnl25-2.fna&oh=00_AfD677bq_XdM4LiyaM3q8P8yHllkRfy4p9CxmK8eAlqfBg&oe=6460DABB"
          alt=""
        />
      </div>
    </div>
    <div class="h-[500px] flex flex-col md:flex-row pb-10 my-10">
      <div class="flex gap-5">
        <div
          class="drop-shadow-lg h-[400px] w-[250px] bg-dark dark:bg-bggray text-bggray dark:text-dark self-end bg-auto bg-no-repeat bg-left text-8xl text-center duration-200"
        >
          Fes
        </div>
        <div
          class="drop-shadow-lg h-[400px] w-[250px] bg-dark dark:bg-bggray text-bggray dark:text-dark bg-auto bg-no-repeat bg-center text-8xl duration-200"
        >
          ti
        </div>
        <div
          class="drop-shadow-lg h-[400px] w-[250px] bg-dark dark:bg-bggray text-bggray dark:text-dark self-end bg-auto bg-no-repeat bg-right text-8xl duration-200"
        >
          val
        </div>
      </div>
      <p class="pl-10 self-center text-dark dark:text-bggray">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
        cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
      </p>
    </div>
    <WrapperContainer>
      <div class="h-[600px] w-full pt-2">
        <div class="flex justify-evenly drop-shadow-md gap-5">
          <img
            class="w-[50%] contrast-125"
            src="https://www.localguidesconnect.com/t5/image/serverpage/image-id/901602i9309756AF08A07CA/image-size/large?v=v2&px=999"
            alt=""
          />
          <div>
            <h2 class="text-5xl font-semibold text-dark dark:text-bggray">Magsolangtan Festival</h2>
            <p class="blockfont-normal text-sm mt-3 text-dark dark:text-bggray">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
              incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
              exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure
              dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
              Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt
              mollit anim id est laborum.
            </p>
          </div>
        </div>
      </div>
    </WrapperContainer>
  </div>
  <FooterSection></FooterSection>
</template>
<style >
</style>