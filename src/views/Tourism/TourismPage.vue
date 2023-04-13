<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import  HeaderSection  from '../../components/Header/HeaderSection.vue'

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
  <HeaderSection></HeaderSection>

  <div class="grid place-items-center mt-10 justify-center">
    <div class="text-center w-[400px]">
      <p class="text-3xl font-semibold font-['display']">
        <span style="color: rgb(185, 43, 39)">Travel</span> Around the beautiful places in Pililla
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
        src="https://png2.cleanpng.com/dy/fe5917c0144c3493c36b68db062ae2c4/L0KzQYm3V8AzN6FvfZH0aYP2gLBuTgRzaadqhJ95YXPucbjsTgRwfaMyj9H2YX6werL3gf4ufpJoeeZyb36wgrL0hgNpf5J3ed82ZHX5crn2jB1qNWZnS9NrOHW1dba9Vcg5NmM3UKYAMUK8QYa6UMU4PWE8TKsCNkWxgLBu/kisspng-travel-package-tour-woman-japan-vacation-rameshwaram-devbhoomi-5b3ab8e2ee6588.2284512915305750749765.png"
        alt=""
      />
    </div>
    <div
      class="flex justify-evenly gap-32 h-auto w-full absolute top-[380px]  text-white"
      style="background-color: rgb(185, 43, 39)"
    >
      <div
        style="
          border-right: 2px solid white;
          right: 50%;
          height: 50px;
          padding-right: 35px;
          margin-top: 20px;
        "
      >
        <p class="pt-2 w-[250px] text-xs lg:text-sm">
          Travel around Pililla to the beauty of nature easily and safely.
        </p>
      </div>
      <div class="text-sm lg:text-2xl font-['display'] text-center">
        <p>Better Pililla</p>
        <p>A better community</p>
        <p>A better Home</p>
      </div>
      <div
        style="
          border-left: 2px solid white;
          right: 50%;
          height: 50px;
          padding-left: 35px;
          margin-top: 20px;
        "
      >
        <p class="pt-2 w-[250px] text-xs lg:text-sm">“ Pamunuang mapagmahal at mapagkalinga ”</p>
      </div>
    </div>
    <div class="relative bottom-10 w-screen">
      <img
        class=" w-full"
        src="https://pilillarizal.gov.ph/wp-content/uploads/2022/10/pililla_painting-1024x326.png"
        alt=""
      />
    </div>
  </div>
  <div class="flex justify-between items-center pr-[75px] pl-[75px]">
    <p class="font-['display'] text-sm lg:text-4xl font-semibold w-72">Find your best destination.</p>
    <div>
      <p class="text-[12px] pb-[2px]">We have more destination you can</p>
      <div class="relative">
        <input
          class="h-10 w-80 pl-10 drop-shadow-lg rounded-3xl outline-cyan-300 text-[12px] bg-gray-100"
          type="text"
          placeholder="Search destinations"
        />
        <i class="uil uil-search absolute right-[20px] top-[8px] z-50 text-white" />
        <div
          class="rounded-full h-[30px] w-[30px] absolute right-[12px] top-[6px]"
          style="background-color: rgb(185, 43, 39)"
        />
        <i class="uil uil-map-marker text-gray-400 absolute left-[12px] top-[10px]" />
      </div>
    </div>
  </div>
  <div class="flex flex-row flex-wrap mt-4 p-20 pt-0 justify-between gap-y-8">
    <div v-for="(data, idx) in sample_data" :key="idx">
      <div class="grid w-[400px] h-[400px] drop-shadow-lg bg-white">
        <div class="h-[200px]">
          <img class="object-cover h-[200px] w-[400px]" :src="data.imgSrc" alt="" />
        </div>
        <div class="p-2">
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
  </div>
  <FooterSection></FooterSection>
</template>
