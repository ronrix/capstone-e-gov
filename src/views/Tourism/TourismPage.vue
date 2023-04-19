<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'

const sample_data = [
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc:
      'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1'
  },
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc:
      'https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=-BS42dF_KM8AX-pnn5m&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfADlapiutu3bBB5gJvkeC6s2ZiZuVJ6Rf_l2O8AxoadSA&oe=643B06E0'
  },
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc: 'https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg'
  },
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc: 'https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg'
  },
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc:
      'http://www.wewander.ph/wp-content/uploads/2019/06/Screen-Shot-2019-06-30-at-9.24.59-AM-17-1024x573.jpg'
  },
  {
    placeName: 'Pililla Wind Farm',
    address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
    imgSrc:
      'https://scontent.fmnl25-3.fna.fbcdn.net/v/t1.18169-9/21463264_723063031236582_3787492010373736874_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeGIY4L9pBdoV6owxxaM3qz6AUhNlLooBokBSE2UuigGieTTzmdJs4wfiRbjiH7XiZmN7auhOamha3T1YTU0_xEu&_nc_ohc=u57Q0U-NgL0AX8nCIig&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfDP9Ut1WmQ8Vh-6CpAy-3Ve-YGIjxJd1Aiqs31yKaQWng&oe=645DB68E'
  }
]
</script>
<template>
  <head>
    <title>Tourism | Pililla Rizal</title>
  </head>

  <HeaderSection></HeaderSection>

  <div class="grid place-items-center mt-10 justify-center">
    <div class="text-center w-1/2">
      <p class="text-5xl font-semibold font-['display'] text-dark dark:text-bggray">
        <span class="text-primary">Travel</span> Around the beautiful places in Pililla
      </p>
    </div>
    <div class="flex relative">
      <div class="mt-6">
        <div
          class="w-96 h-96 rounded-full opacity-[12%]"
          style="background-color: rgb(185, 43, 39)"
        />
        <div
          class="w-72 h-72 absolute left-12 top-16 rounded-full opacity-[34%]"
          style="background-color: rgb(185, 43, 39)"
        />
      </div>
      <img
        class="w-[210px] absolute right-44 top-3"
        src="https://www.pngaaa.com/api-download/1853846"
        alt=""
      />
      <img
        class="w-[200px] absolute left-32"
        src="https://i.postimg.cc/63XWfN0Z/kisspng-travel-package-tour-woman-japan-vacation-rameshwaram-devbhoomi-5b3ab8e2ee6588-22845129153057.png"
        alt=""
      />
    </div>
    <div
      class="flex justify-between h-auto w-full absolute top-[480px] sm:top-[380px] text-white bg-primary items-center p-5"
    >
      <div class="text-center flex-1 px-3">
        <p class="pt-2 text-xs lg:text-sm">
          Travel around Pililla to the beauty of nature easily and safely.
        </p>
      </div>
      <div class="lg:text-2xl font-['display'] text-center border-2 border-y-0 flex-1">
        <p>Better Pililla</p>
        <p>A better community</p>
        <p>A better Home</p>
      </div>
      <div class="flex-1 text-center px-3">
        <p class="pt-2 text-xs lg:text-sm">“ Pamunuang mapagmahal at mapagkalinga ”</p>
      </div>
    </div>
  </div>

  <!-- banner -->
  <div class="relative bottom-20 md:bottom-10 w-full">
    <img
      class="w-full object-cover"
      src="https://pilillarizal.gov.ph/wp-content/uploads/2022/10/pililla_painting-1024x326.png"
      alt=""
    />
  </div>

  <WrapperContainer>
    <div class="flex justify-between">
      <p
        class="font-['display'] text-sm lg:text-4xl font-semibold w-1/4 text-dark dark:text-bggray"
      >
        Find your best destination.
      </p>
      <div>
        <p class="text-xs pb-1 text-secondary">We have more destination you can</p>
        <div class="relative">
          <input
            class="h-10 w-80 pl-10 drop-shadow-lg rounded-3xl outline-cyan-300 text-[12px] bg-gray-100"
            type="text"
            placeholder="Search destinations"
          />
          <i class="uil uil-search absolute right-[20px] top-[8px] z-50 text-white" />
          <div
            class="rounded-full h-[30px] w-[30px] absolute right-[12px] top-[6px] flex items-center justify-center"
            style="background-color: rgb(185, 43, 39)"
          />
          <i class="uil uil-map-marker text-gray-400 absolute left-[12px] top-[10px]" />
        </div>
      </div>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 mt-5 gap-5">
      <div
        v-for="(data, idx) in sample_data"
        :key="idx"
        class="flex flex-col drop-shadow-lg bg-white"
      >
        <img class="object-cover h-[150px] w-full" :src="data.imgSrc" alt="" />
        <div class="py-5 px-3">
          <p class="font-semibold">
            {{ data.placeName }}
          </p>
          <div class="flex">
            <i class="uil uil-map-marker text-cyan-300 relative bottom-[2px]" />
            <p class="text-[12px] ml-1">
              {{ data.address }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </WrapperContainer>
  <FooterSection></FooterSection>
</template>
