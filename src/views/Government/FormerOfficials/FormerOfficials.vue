<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import OfficialsCard from '../../../components/Officials/OfficialsCard.vue'
</script>
<template>
  <!-- add tab title -->
  <head>
    <title>Former Officials | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <h3 class="font-bold text-5xl text-dark dark:text-bggray text-center mb-16">
      Former Municipal Elected Officials
    </h3>

    <section class="flex flex-col justify-center items-center w-full gap-y-16">
      <!-- mayor -->
      <OfficialsCard />

      <!-- vice mayor -->
      <OfficialsCard />

      <!-- subodinates -->
      <div class="flex flex-wrap gap-y-16">
        <OfficialsCard />
        <OfficialsCard />
        <OfficialsCard />
        <OfficialsCard />
      </div>
    </section>
  </WrapperContainer>

  <FooterSection />
</template>