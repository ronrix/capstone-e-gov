<script setup>
defineProps({
  official: { type: Object, required: false }
})
</script>
<template>
  <div
    class="border border-dark dark:border-bggray p-5 w-full sm:w-[400px] flex flex-col items-center mx-auto dark:bg-dark duration-200 rounded-lg shadow-lg shadow-primarylight/20 relative"
  >
    <div
      class="w-[100px] h-[100px] rounded-full overflow-hidden absolute -top-1/2 left-1/2 -translate-x-1/2 bg-white dark:bg-dark p-2"
    >
      <img
        :src="official?.img_link"
        alt="this is an image of the mayor of pililla rizal"
        class="rounded-full object-cover"
      />
    </div>
    <h3 class="font-bold text-xl text-dark dark:text-bggray mt-5">
      {{ official?.executive_name }}
    </h3>
    <h5 class="text-primary dark:text-primarylight">{{ official?.position }}</h5>
  </div>
</template>