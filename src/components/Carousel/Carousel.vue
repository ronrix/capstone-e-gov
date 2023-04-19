<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import {contentCard} from '../../assets/config/touristAttraction'
export default defineComponent({
  name: 'Autoplay',
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation,
  },
  // data: function(){
  //   return {
  //       imgslide: [ 
  //   "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1",
  //   "http://www.wewander.ph/wp-content/uploads/2019/06/Screen-Shot-2019-06-30-at-9.24.59-AM-17-1024x573.jpg",
  //   "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1",
  //   ]}
  // }
  
  setup() {
    return {contentCard}
  }
   
})

</script>
<template>
  <b-carousel
    id="carousel-fade"
    style="text-shadow: 0px 0px 2px #000"
    fade
    indicators
    img-width="1024"
    img-height="480"
  >
   <Carousel  v-bind="settings"  :breakpoints="breakpoints" >
    <Slide v-for="(card, index) in contentCard" :key="index " >
      <div class=" sm:flex sm:justify-evenly md:flex drop-shadow-md rounded-md bg-white h-auto cursor-grab">
        <img :src="card.imgSrc" alt="" class="w-full sm:w-1/2 h-[400px] object-cover">
        <div class="flex flex-col gap-4 text-left self-start pt-10 pl-6 pr-6  text-dark">
            <h1 class="!text-4xl !font-semibold">{{ card.title }}</h1>
            <p class="! !font-thin">{{ card.content }}</p>
            <div class="group flex">
              <a class="cursor-pointer group-hover:underline mb-8 text-primary pr-2">Read more</a>
             <div class="group-hover:-translate-x-1 transition duration-200 bg-primary h-[20px] w-[20px] rounded-full ">
              <i class="fa-solid fa-arrow-right text-white pl-[2px]"></i>
             </div>
            </div>
         
        </div>
      
      </div>
    </Slide>

    <template #addons>
      <Navigation class=""></Navigation>
      <Pagination class="-translate-y-2"/>
    </template>
  </Carousel>
  </b-carousel>
</template>


<style>
.carousel__pagination-button::after {
    display: block;
    content: '';
    width: 10px;
    height: 10px;
    border-radius: 50%;
    /* background-color: var(--vc-pgn-background-color); */
}
.carousel__icon {
  background: #B92B27;
  border-radius: 50%;
  width: 150px;
  height: 30px;
}

.carousel__pagination-button {
  border-radius: 100%;
  
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  color: white;
}
@media (max-width: 467px),
       (max-width: 620px) {
        .carousel__prev,
        .carousel__next {
          display: none;
        }
      }

</style>