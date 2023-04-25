<script>
import { defineComponent } from 'vue'
import { Carousel, Pagination, Navigation, Slide } from 'vue3-carousel'

import 'vue3-carousel/dist/carousel.css'

export default defineComponent({

  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
    
  },
  data() {
    return {
        imgslide: [
    "https://scontent.fmnl25-5.fna.fbcdn.net/v/t1.6435-9/67488361_1155244154667255_1219821139275022336_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=cdbe9c&_nc_eui2=AeFVJCWBgnHcQ0v7lS1szjZ1tPFGaajEJJ608UZpqMQkngr4IwsWa_4YEFEFnnSbmncHNnD2Lq5F4M7f9JIEriJD&_nc_ohc=ISZ3-xKVMTgAX9LNk_L&_nc_ht=scontent.fmnl25-5.fna&oh=00_AfDpOVDxoHDk1M7bihFmjWcO-4MaX1EKOCa0au0jXJX3ag&oe=646B523F",
    "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/294533831_168890652297652_8595344769449246495_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=0debeb&_nc_eui2=AeEqMUs2mL-U_cGG2VWFc7xCqmB_4F9odpGqYH_gX2h2kYi-kTcKVNcl4zw9TiXk2gmUuvcjAyNqzBzDZZHwcgjw&_nc_ohc=KYA0JrORe64AX_d0Iu5&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfAne_dA3gSeTAou7mHFTE4rtbXuu3mDQkAo_NPuSVQ8Ag&oe=64493E7F",
    "https://scontent.fmnl25-2.fna.fbcdn.net/v/t39.30808-6/294819283_168890715630979_602818961622681167_n.jpg?_nc_cat=102&ccb=1-7&_nc_sid=0debeb&_nc_eui2=AeHuEcqHpHUoG46duQPTG9TBA94I9rv7l8UD3gj2u_uXxXVUZ6rTZP7yCJztgntHvNEkiX7YRsxwkeoWj5wGGNq5&_nc_ohc=wmw8x7D0HIoAX-qaRyo&_nc_ht=scontent.fmnl25-2.fna&oh=00_AfDpvlWGrd7-mtDOe_NYfHbl09Vrr8EGXzlfoIIK4Bgg7Q&oe=64487D2D",
  "https://scontent.fmnl25-1.fna.fbcdn.net/v/t39.30808-6/325787986_1116708108976648_78048288716207078_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=730e14&_nc_eui2=AeGTur68CBmjriq1deUyqmH2zUWUBj5w1erNRZQGPnDV6nWK9vRNypONo8k6aku9xMRFmZs87QdBzRjeywwkbi1h&_nc_ohc=4VZGtFEK61sAX8OWT4Y&_nc_ht=scontent.fmnl25-1.fna&oh=00_AfDNR5NiPx99oaqucGOAEsts1njsna2ZPsheTxBwWLdjbA&oe=6448EFF4"
  ]}
  }
})
</script>
<template>
  <Carousel :items-to-show="1.98" :wrap-around="true" :transition="500">
    <Slide v-for="slide in imgslide" :key="slide" >
      <div class="carousel__item h-[300px] w-[300px] ml-8"><img :src="slide" alt="" class="object-cover h-[300px] w-full"> </div>
    </Slide>

    <template #addons>
        <Navigation />
        <Pagination class="" />
      </template>
  </Carousel>
</template>

<style>


</style>
