<template>
<wrapperContent>
  <div class="flex items-start gap-5 justify-start flex-wrap">

      <div v-for="data in arr" class="flex flex-col gap-2 p-5 items-start shadow-lg bg-cyan-200 rounded-lg">
          <!-- <img class="text-center h-[150px]" :src="data.imgSrc"> -->
          <p class="text-xl">{{ data.Guides }}</p>
          <p class="text-sm">{{ data.content }}</p>
      </div>
</div>

</wrapperContent>
</template>

<script setup>
    const arr = [{
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    
    Guides: "Research your destination: ",
    content: "Before you travel, take some time to research the place you're visiting. Learn about the culture, customs, and laws of the area to avoid offending anyone or breaking any rules."
    // imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    }]

</script>

<style lang="scss" scoped>

</style>