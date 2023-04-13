<script setup>
import FooterSection from '../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../components/Header/HeaderSection.vue'
import CurrentNews from './CurrentNews.vue'
import NewsCard from './NewsCard.vue'
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>News | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <CurrentNews />
    <!-- all news -->
    <div class="mt-10 flex flex-col gap-8">
      <div class="flex items-center gap-2">
        <h4 class="font-bold capitalize text-dark dark:text-bggray">other news</h4>
        <div class="flex-1 h-[2px] bg-secondary"></div>
      </div>

      <NewsCard v-for="i in Array.from([0, 0, 0])" :key="i" />
    </div>
  </WrapperContainer>

  <FooterSection />
</template>