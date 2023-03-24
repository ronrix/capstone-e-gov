<template>
  <HeadTitle title="Ease of Doing Business"></HeadTitle>
  <WrapperContent>
    <h1 class=" text-xl lg:text-2xl font-bold text-gray-800 mb-5">Ease of Doing Business</h1>
    
    <!-- first card -->
    <div
      class="relative overflow-hidden flex flex-col justify-between md:flex-row bg-white border-r-0 border-y-0 border-l-[5px] border-l-blue-600 gap-1 md:gap-10">

      <!-- content -->
      <div class="flex-1 flex flex-col p-0 order-last md:order-first">
        <p class="mt-5 text-sm h-[100px] overflow-hidden font-medium text-gray-800 px-2 md:px-2">Lorem Ipsum is simply dummy
          text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
          since the 1500s when an unknown printer took a galley of type and scrambled it to make a type specimen book. It
          has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially
          unchanged.</p>
        <button
          class="w-[70px] bg-blue-600 rounded-md mb-2 ml-2 md:ml-2 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-start uppercase mt-10 md:mt-8 lg:mt-32">view
        </button>
      </div>

      <div class="order-first md:order-last">
        <!-- image -->
        <img class="h-[300px] md:h-[195px] lg:h-[300px] max-h-[350px] w-full md:w-[220px] lg:w-[300px] xl:w-[400px]"
          src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Pililla%2CRizaljf6587_04.JPG/800px-Pililla%2CRizaljf6587_04.JPG"
         alt="ease of doing business">
      </div>

    </div>

    <!--businesses -->
    <h4 class=" text-xl lg:text-2xl font-bold text-gray-800 my-5">Businesses</h4>
   
    <CardBusiness v-for="(data , index) in business" :data="data" :index="index"/>

  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import CardBusiness from './CardBusiness.vue';

const business = [
  {
  title: "Bulawan Floating Restaurant",
  description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
  imgSrc: "https://3.bp.blogspot.com/-DO8GFOij0pA/WZhuUvHzanI/AAAAAAAAAd0/ZX_zREEA0O86R3UYiZLGOHR3gawDqR8ewCPcBGAYYCw/s400/DSC_0165.jpg"
},
{
  title: "7-Eleven",
  description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
  imgSrc: "https://images.summitmedia-digital.com/esquiremagph/images/2021/04/19/shutterstock_1404051692%20(1).jpg"
},
{
  title: "Generika Pililla, Rizal",
  description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
  imgSrc: "https://fab.ph/wp-content/uploads/2019/03/8cSDwpg0d9YbVTRxUqrM1.png"
}
]
</script>

<style scoped></style>