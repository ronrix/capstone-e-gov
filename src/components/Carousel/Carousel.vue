<script>
import { defineComponent } from 'vue'
import { Carousel, Navigation, Pagination, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'
import { formatImgs } from '../../utils/imgFormat'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

export default defineComponent({
  components: {
    Carousel,
    Slide,
    Pagination,
    Navigation
  },
  props: {
    tourism: {
      type: Object,
      required: true
    }
  },
  setup() {
    return {
      formatImgs,
      marked,
      DOMPurify
    }
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
    <Carousel :breakpoints="breakpoints" :transition="900">
      <Slide v-for="(card, index) in tourism" :key="index">
        <div
          class="sm:flex sm:justify-evenly md:flex drop-shadow-md rounded-md bg-white h-auto cursor-grab"
        >
          <img
            :src="formatImgs(card.img_link.split(','))[0]"
            alt=""
            class="w-full sm:w-1/2 h-[400px] object-cover rounded-l-lg"
          />
          <div class="flex flex-col gap-4 text-left self-start pt-10 pl-6 pr-6 text-dark">
            <h1 class="!text-4xl !font-semibold">{{ card.title }}</h1>
            <div
              class=":text-dark dark:text-bgLightyBlue leading-loose markdown line-clamp-5"
              :innerHTML="DOMPurify.sanitize(marked(card.description))"
            ></div>
            <div class="group flex w-fit">
              <RouterLink
                :to="
                  '/tourist-attractions/' +
                  card.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
                "
                class="cursor-pointer group-hover:underline mb-8 sm:mb-0 text-primary pr-2"
                >Read more</RouterLink
              >
              <i
                class="group-hover:-translate-x-1 duration-75 uil uil-arrow-right text-primary"
              ></i>
            </div>
          </div>
        </div>
      </Slide>

      <template #addons>
        <Navigation class=""></Navigation>
        <Pagination class="-translate-y-2 visible sm:invisible" />
      </template>
    </Carousel>
  </b-carousel>
</template>


<style>
* {
  text-shadow: none;
  /* transition-timing-function: ease-in-out !important;
  transition-duration: 0.5s !important; */
}
.carousel__track {
  display: flex;
  padding: 0 !important;
  position: relative;
}
.carousel__next--disabled,
.carousel__prev--disabled {
  cursor: grab;
  opacity: 0;
}

.carousel__pagination-button::after {
  display: block;
  content: '';
  width: 10px;
  height: 10px;
  border-radius: 50%;
  /* background-color: var(--vc-pgn-background-color); */
}
.carousel__icon {
  background: #b92b27 !important;
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
  transform: translateY(-30px);
}
@media (max-width: 467px), (max-width: 620px), (max-width: 637px) {
  .carousel__prev,
  .carousel__next {
    display: none;
  }
}
</style>