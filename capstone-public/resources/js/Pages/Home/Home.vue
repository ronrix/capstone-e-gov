<template>
  <Head title="Home"></Head>
  <Wrapper>
    <Header />
  </Wrapper>
  <Hero />
  <Wrapper>
    <!-- assistance section -->
    <section class="bg-bggray p-5">
      <Assistance />
    </section>

    <!-- programs and events -->
    <Programs />

    <!-- top places -->
    <section class="mt-10 flex flex-col gap-5">
      <h4 class="font-['display'] text-5xl w-3/4 text-center mx-auto">Top 3 places you want to come and visit in Pililla
      </h4>

      <div class="relative mt-5 bg-gray-900 rounded-md text-white py-5">
        <!-- map icon -->
        <div
          class="absolute -top-8 left-1/2 -translate-x-1/2 rounded-full w-10 h-10 flex items-center justify-center bg-white">
          <i class="uil uil-map-pin text-3xl text-black"></i>
        </div>

        <!-- places -->
        <Place v-for="place, idx in places" :place="place" :idx="idx" />

        <div class="flex items-center justify-center flex-col mt-10 gap-2">
          <h5 class="capitalize font-['display'] text-5xl">Find out more</h5>
          <p>Find more interesting places and destination to go to in Pililla. </p>
          <RouterLink to="/tourist-spots" class="px-3 py-1 text-white bg-primary rounded-md capitalize">
            Go places
            <i class="uil uil-angle-right"></i>
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- map location -->
    <section>
      <h4 class="font-['display'] text-5xl mt-10 font-bold">Here's the map of Pililla</h4>
      <p >Welcome to pililla!</p>
      <p>You can navigate the whole pililla using
        <a href="/google-map" class="text-primarylight">
          <i class="uil uil-link"></i>
          google map
        </a>
      </p>

      <div class="mt-5">
        <iframe width="800" height="500" frameborder="0"
          src="https://www.bing.com/maps/embed?h=500&w=800&cp=14.5990572649647~121.08147888433678&lvl=11&typ=d&sty=h&src=SHELL&FORM=MBEDV8"
          scrolling="no">
        </iframe>
        <div style="white-space: nowrap; text-align: center; width: 800px; padding: 6px 0;">
          <a id="largeMapLink" target="_blank"
            href="https://www.bing.com/maps?cp=14.5990572649647~121.08147888433678&amp;sty=h&amp;lvl=11&amp;FORM=MBEDLD">View
            Larger Map</a> &nbsp; | &nbsp;
          <a id="dirMapLink" target="_blank"
            href="https://www.bing.com/maps/directions?cp=14.5990572649647~121.08147888433678&amp;sty=h&amp;lvl=11&amp;rtp=~pos.14.5990572649647_121.08147888433678____&amp;FORM=MBEDLD">Get
            Directions</a>
        </div>
      </div>
    </section>

    <!-- hotlines -->
    <section class="mt-10">
      <Hotlines />
    </section>

    <Footer />
  </Wrapper>
</template>

<script setup>
import Header from '../../Components/Header/Header.vue';
import Hero from './Hero.vue';
import Assistance from "./Assistance.vue";
import Programs from './Programs/Programs.vue';
import Place from './Place/Place.vue';
import Hotlines from "../../Components/Hotlines.vue";
import Footer from "../../Components/Footer/Footer.vue";
import { RouterLink } from 'vue-router';

const places = [
  {
    title: "Pililla Wind Farm",
    imgSrc: "/images/top-3-places/place-1.png",
    location: "bugarin",
    qoute: `
        “Relaxation.
        Take in the breathtaking views
        from our wind farms. ”
    `,
  },
  {
    title: "Malaking Bato",
    imgSrc: "/images/top-3-places/place-2.png",
    location: "living water",
    qoute: `
      "Escape the hustle and bustle of
      city life and immerse yourself 
      in the natural beauty 
      of Pililla”
    `,
  },
  {
    title: "Bulawan Floating Restaurant",
    imgSrc: "/images/top-3-places/place-3.png",
    location: "halayhayin",
    qoute: `
        “Experience the best of both 
        worlds in Pililla”
    `,
  },
]
</script>
