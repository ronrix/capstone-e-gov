<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import { onMounted, ref } from 'vue'
import { formatImgs } from '../../utils/imgFormat'

const tourism = ref()
onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  tourism.value = JSON.parse(localStorage.getItem('tourisms'))
})
</script>
<template>
  <head>
    <title>Tourism | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>
  <WrapperContainer>
    <div class="grid place-items-center mt-10 justify-center">
      <div class="text-center max-w-2xl">
        <p class="text-4xl md:text-7xl font-semibold font-['display'] text-dark dark:text-bggray">
          <span class="text-primary">Travel</span> Around the beautiful places in Pililla
        </p>
      </div>
    </div>
    <div class="flex justify-center relative">
      <img
        class="w-[600px] absolute bg-center object-cover"
        src="../../../public/images/Tourismbg-Circle.png"
      />
      <div class="flex pt-5">
        <img
          class="sm:w-[210px] w-[160px] z-10 object-cover"
          src="https://www.pngaaa.com/api-download/1853846"
          alt=""
        />
        <img
          class="sm:w-[200px] w-[100px] -translate-x-14 object-cover"
          src="https://i.postimg.cc/63XWfN0Z/kisspng-travel-package-tour-woman-japan-vacation-rameshwaram-devbhoomi-5b3ab8e2ee6588-22845129153057.png"
          alt=""
        />
      </div>
    </div>
  </WrapperContainer>
  <div
    class="flex justify-between h-auto w-full text-white bg-primary items-center p-5 -translate-y-5 sm:-translate-y-0"
  >
    <div class="text-center flex-1 px-3">
      <p class="pt-2 text-xs lg:text-sm">
        Travel around Pililla to the beauty of nature easily and safely.
      </p>
    </div>
    <div class="lg:text-2xl font-['display'] text-center border-2 border-y-0 flex-1 z-10">
      <p>Better Pililla</p>
      <p>A better community</p>
      <p>A better Home</p>
    </div>
    <div class="flex-1 text-center px-3">
      <p class="pt-2 text-xs lg:text-sm">“ Pamunuang mapagmahal at mapagkalinga ”</p>
    </div>
  </div>

  <!-- banner -->
  <div class="w-full sm:pt-10 pb-10">
    <img
      class="w-full object-cover z-10"
      src="https://pilillarizal.gov.ph/wp-content/uploads/2022/10/pililla_painting-1024x326.png"
      alt=""
    />
  </div>

  <WrapperContainer>
    <div class="flex justify-between items-center">
      <p class="font-['display'] text-3xl font-semibold w-1/2 text-dark dark:text-bggray">
        Find your best destination.
      </p>
      <div>
        <p class="text-xs pb-1 text-secondary">We have more destination you can</p>
        <div
          class="relative flex items-center justify-center drop-shadow-lg rounded-3xl text-sm bg-gray-100 text-dark px-3 py-2"
        >
          <i class="uil uil-map-marker text-base text-dark mr-2" />
          <input
            class="bg-transparent w-full outline-none"
            type="text"
            placeholder="Search destinations"
          />
          <div class="w-12 h-10 rounded-full bg-primarylight flex items-center justify-center">
            <i class="uil uil-search text-white text-base" />
          </div>
        </div>
      </div>
    </div>
  </WrapperContainer>
  <WrapperContainer>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 mt-10 gap-5">
      <RouterLink
        v-for="data in tourism"
        :key="data.id"
        :to="
          '/tourist-attractions/' +
          data.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
        "
        class="flex flex-col border hover:drop-shadow-lg bg-white dark:bg-dark"
      >
        <img
          class="object-cover h-[250px] w-full"
          :src="formatImgs(data.img_link.split(','))"
          alt=""
        />
        <div class="py-5 px-3">
          <p class="font-semibold text-dark dark:text-bggray capitalize">
            {{ data.title }}
          </p>
          <div class="flex text-dark dark:text-bggray">
            <i class="uil uil-map-marker text-cyan-300 relative bottom-[2px]" />
            <p class="text-[12px] ml-1">
              {{ data.location }}
            </p>
          </div>
        </div>
      </RouterLink>
    </div>
  </WrapperContainer>
  <FooterSection></FooterSection>
</template>
