<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import Carousel from '../../components/Carousel/Carousel.vue'
import { ref, onMounted, onUnmounted } from 'vue'
import { formatImgs } from '../../utils/imgFormat'
import { marked } from 'marked'
import DOMPurify from 'dompurify'

const tourism = ref()
onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Tourist Attractions | Pililla Rizal'

  tourism.value = JSON.parse(localStorage.getItem('tourisms'))
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})
</script>
<template >
  <HeaderSection></HeaderSection>
  <div
    class="flex bg-no-repeat h-[600px] bg-cover bg-[url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/16/14/23/b1/pililla-wind-farm.jpg?w=1200&h=-1&s=1')]"
  >
    <WrapperContainer>
      <div class="pt-36 pl-5">
        <h1 class="text-5xl md:text-8xl font-semibold text-dark">
          Tourist <span class="block sm:ml-20 text-primary">Attraction</span>
        </h1>
        <p class="pt-12 w-full sm:w-1/2 italic text-bggray text-2xl">
          "A mind that stretched by a new experience can never go back to its old dimension"
          <span class="text-base flex justify-end">-Oliver Wendell Holmes</span>
        </p>
      </div>
    </WrapperContainer>
  </div>
  <!-- <div class="flex">
        <div
          class="topimage drop-shadow-lg h-[300px] sm:h-[400px] w-[200px] sm:w-[300px] bg-slate-300 bg-auto bg-no-repeat bg-center z-10 translate-y-36 sm:translate-y-32"
          style="background-image: url()"
        >
          <img
            class="h-full object-cover"
            src="https://scontent.fmnl25-2.fna.fbcdn.net/v/t39.30808-6/201437546_985391575640120_8866290925325394471_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=zZDp4nRbV8sAX85yDg5&_nc_ht=scontent.fmnl25-2.fna&oh=00_AfBUUpKmEG5c71awn2WUofzZA78HwgkQQ8T9TGgprsyj-Q&oe=644BF928"
            alt=""
          />
        </div>
        <div
          class="topimage drop-shadow-lg h-[300px] sm:h-[400px] w-[210px] sm:w-[310px] bg-slate-300 bg-auto bg-no-repeat bg-center translate-y-5 sm:translate-y-0"
        >
          <img
            class="h-full object-cover"
            src="https://scontent.fmnl25-4.fna.fbcdn.net/v/t39.30808-6/228257555_985391735640104_8375891350015040293_n.jpg?_nc_cat=109&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=PYlTN27sWyIAX8rJIBI&_nc_ht=scontent.fmnl25-4.fna&oh=00_AfAqTy32UOLOlGMEt12G2Nsa5VM7RCrYo6hcCzKToxOT7g&oe=644D843B"
            alt=""
          />
        </div>
      </div> -->

  <div
    class="flex flex-col md:flex-row bg-dark w-full bg-center mb-5 sm:mb-20 border-t-2 border-dark dark:border-t-bggray pb-10"
  >
    <img
      class="w-full md:w-1/2"
      src="https://i.postimg.cc/nrGCXPV1/windmillnobg-VECTOR.png"
      alt=""
    />
    <div class="flex flex-col self-center text-white px-10 md:px-0 md:pr-20">
      <h4 class="font-semibold pt-5 text-4xl">"Discovering the Charm and Beauty of Pililla"</h4>
      <p class="bg-description text-sm pt-4 block font-normal">
        Nestled in the heart of Rizal province, Pililla is a charming town that offers a unique
        experience for tourists looking to escape the hustle and bustle of the city. Its picturesque
        landscapes, highlighted by the breathtaking Pililla Wind Farm and the Pililla Hanging
        Bridge, make it a paradise for nature lovers and adventure seekers alike. Meanwhile, those
        interested in history and culture can explore the town's centuries-old Pililla Church and
        its collection of historical artifacts and relics. With its warm and welcoming community,
        Pililla, Rizal promises a memorable and enriching experience for every traveler.
      </p>
    </div>
  </div>
  <carousel :tourism="tourism" class="block sm:hidden"></carousel>
  <WrapperContainer>
    <div
      v-for="(data, index) in tourism"
      :key="index"
      class="data hidden sm:flex flex-col sm:flex-row sm:pb-10 justify-between drop-shadow-md gap-5 overflow-hidden mt-32"
      :class="{ reverse: index % 2 !== 0 }"
    >
      <div class="-order-first sm:-order-last">
        <h2 class="text-5xl lg:text-6xl font-semibold pt-5 text-dark dark:text-bggray capitalize">
          {{ data.title }}
        </h2>
        <div
          class=":text-dark dark:text-bgLightyBlue leading-loose markdown line-clamp-5"
          :innerHTML="DOMPurify.sanitize(marked(data.description))"
        ></div>
        <div class="group flex w-fit">
          <RouterLink
            :to="
              '/tourist-attractions/' +
              data.title.replace(/\s+/g, '_').replace(/\n/g, ' ').toLowerCase()
            "
            class="cursor-pointer group-hover:underline mb-8 sm:mb-0 text-primary pr-2"
            >Read more</RouterLink
          >
          <i class="group-hover:-translate-x-1 duration-75 uil uil-arrow-right text-primary"></i>
        </div>
      </div>
      <img
        class="TAimg w-[300px] md:w-[500px] order-first sm:order-last object-cover"
        :src="formatImgs(data.img_link.split(','))[0]"
        alt=""
        :style="{
          'border-bottom-left-radius': index % 2 === 0 ? '9999px' : '0',
          'border-bottom-left-radius': index % 2 === 0 ? '9999px' : '0',
          'border-top-right-radius': index % 2 !== 0 ? '9999px' : '0',
          'border-top-right-radius': index % 2 !== 0 ? '9999px' : '0'
        }"
      />
    </div>
  </WrapperContainer>
  <FooterSection></FooterSection>
</template>

<style scoped>
.cards:hover {
  transform: translateY(-6px);
  border: none;
  z-index: 2;
  -webkit-box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  -webkit-transition: all 0.2s ease-in-out;
  transition: all 0.2s ease-in-out;
}
@media (max-width: 375px) {
  .topimage {
    transform: translateX(40px);
    transform: translateY(144px);
    z-index: 10;
    display: none;
  }
  .bg-text {
    position: absolute;
    left: 5px;
  }
  .bg-description {
    width: 350px;
    margin-right: 0px;
  }
}
.data.reverse {
  flex-direction: row-reverse; /* reverse the order of items */
}
.TAimg:hover {
  border-radius: none;
}
</style>

<style>
.markdown p {
  margin-top: 0.5em;
  font-size: 1em;
}
.markdown h2 {
  font-size: 1.7em;
  margin-top: 0.5em;
  font-weight: bold;
}
.markdown h3 {
  font-size: 1.5em;
  margin-top: 0.5em;
  font-weight: bold;
}
</style>