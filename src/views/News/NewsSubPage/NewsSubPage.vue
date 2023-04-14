<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import SuggestionCard from './Suggestions/SuggestionCard.vue'
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>News | Pililla Rizal</title>
  </head>
  <HeaderSection />

  <WrapperContainer>
    <div class="mt-10 flex gap-5">
      <div class="flex flex-col gap-3 items-start flex-[1.5]">
        <p class="flex items-center text-xs text-secondary">
          <i class="uil uil-clock-five"></i>
          <span>3 days ago</span>
        </p>
        <h3 class="font-bold text-2xl text-dark dark:text-bggray w-1/2">
          Ukraine war: Five ways Russia's Invasion may play out
        </h3>

        <img
          class="w-full"
          src="https://media.cnn.com/api/v1/images/stellar/prod/230406060125-02-macron-xi-meeting-040623.jpg?c=16x9&q=h_540,w_960,c_fill/f_webp"
          alt=""
        />

        <p class=":text-dark dark:text-secondary text-justify leading-loose">
          Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nostrum debitis officiis neque
          nemo, aspernatur adipisci itaque recusandae totam culpa dolorem laudantium est hic quae
          soluta excepturi. Maxime reprehenderit possimus nam repellat aliquam molestias officiis
          deserunt dicta repellendus accusamus animi atque, ut magnam consectetur? Corrupti, velit
          omnis illo pariatur debitis delectus! Lorem ipsum dolor, sit amet consectetur adipisicing
          elit. Nemo ducimus deleniti autem, odio fugiat doloribus repudiandae quo aut qui, dolores
          totam aliquam ad, ipsa laborum mollitia illo id nisi error ullam dolorum cumque. Itaque
          nobis quas incidunt aliquam, autem cum soluta voluptatibus facere nisi sit veniam maiores
          amet cumque voluptas in quis magnam quia culpa ducimus ullam quam, possimus nemo eligendi
          qui. Animi exercitationem laudantium blanditiis tempore delectus asperiores praesentium.
          Ad maxime, eum vel magni hic ducimus excepturi amet corrupti eaque accusantium quam
          deserunt voluptatum quo consequatur quidem suscipit maiores a nesciunt! Nihil quos culpa
          at? Ipsa vero commodi officiis.
        </p>
      </div>

      <!-- suggestions -->
      <div class="flex-1">
        <SuggestionCard v-for="i in Array.from([0, 0, 0, 0])" :key="i" />
      </div>
    </div>
  </WrapperContainer>
  <FooterSection />
</template>