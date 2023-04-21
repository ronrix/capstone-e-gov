<template>
  <div>
    <CarouselCard :interval="7000" height="300px" type="card" arrow="always">
      <CarouselCardItem v-for="i in 7" :key="i">
        <h1 v-text="i"></h1>
      </CarouselCardItem>
    </CarouselCard>
  </div>
</template>

<script>
import { CarouselCard, CarouselCardItem } from 'vue-carousel-card'
import 'vue-carousel-card/styles/index.css'

export default {
  name: "Festival",
  components: {
    CarouselCard,
    CarouselCardItem
  }
};
</script>

<style>

h1 {
  height: 100%;
  padding: 0;
  margin: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  color: #FFF;
  background: linear-gradient(90deg, rgba(156,247,121,1), rgba(59,183,12,1))
}
</style>
  