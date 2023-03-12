<template>
  <div class="mt-5 p-3 flex flex-col gap-5">
    <CardNews :showNewsModal="showNewsModal" title="news first" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?" />
    <CardNews :showNewsModal="showNewsModal" title="news first" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?" />
    <CardNews :showNewsModal="showNewsModal" title="news first" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?" />

    <NewsModal :showNewsModal="showNewsModal" v-show="isNewModal" />
  </div>
</template>

<script setup>
import CardNews from './CardNews.vue';
import NewsModal from './NewsModal.vue';

import { ref } from 'vue';
const isNewModal = ref(false);

function showNewsModal() {
  console.log("you clicked me");
  isNewModal.value = !isNewModal.value;
}

</script>

<style lang="scss" scoped>

</style>