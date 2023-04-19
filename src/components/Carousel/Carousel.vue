<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import { ref } from 'vue'
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
        const contentCard = ref([{
            title: "Wind Farm",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        },
        {
            title: "Mt. Sembrano",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        },
        {
            title: "Lyger Zoo",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=bXd6tVXYhgUAX-b_2AF&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfCcZIdJQMdcpLA2Ab07D3E5RKbvx1XzkXnwAEKaHIFoIQ&oe=6444EA20"
        },
        {
            title: "Mt. Sembrano",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        },
        {
            title: "Mt. Sembrano",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        },
        {
            title: "Mt. Sembrano",
            content: "  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididuntut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitatio ullamco laboris nisi ut aliquip ex ea commodo consequat.",
            imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1200&h=1200&s=1"
        },
    ]);
    return {contentCard}

    },
    data: () => ({
    // carousel settings
    settings: {
      itemsToShow: 1,
      snapAlign: 'center',
    breakpoints: {
      // 700px and up

      700: {
        itemsToShow: 2,
        snapAlign: 'center',
      },
      1024: {
        itemsToShow: 3,
        snapAlign: 'start',
      },
    }
  }
  }),
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
   <Carousel  v-bind="settings" :wrap-around="true" :breakpoints="breakpoints" >
    <Slide v-for="(card, index) in contentCard" :key="index " >
      <div class=" sm:flex sm:justify-evenly md:flex drop-shadow-md rounded-md bg-white h-auto cursor-grab">
        <img :src="card.imgSrc" alt="" class="w-full sm:w-1/2">
        <div class="text-left self-start pt-10 pl-6 pr-6  text-dark">
            <h1 class="font-bold text-3xl mb-8">{{ card.title }}</h1>
            <p class="font-thin m-2 mr-10 mb-10">{{ card.content }}</p>
          
        </div>
      
      </div>
    </Slide>

    <template #addons>
      <Navigation class="hidden"></Navigation>
      <Pagination class="-translate-y-2"/>
    </template>
  </Carousel>
  </b-carousel>
</template>


<style>
.carousel__pagination-button {
 
  border-radius: 100%;
  
}

.carousel__slide {
  padding: 10px;
}

.carousel__prev,
.carousel__next {
  color: #B92B27;
}
@media (max-width: 467px),
       (max-width: 620px) {
        .carousel__prev,
        .carousel__next {
          display: none;
        }
      }

</style>