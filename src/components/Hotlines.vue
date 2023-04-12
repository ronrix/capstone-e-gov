<script setup>
</script>

<template>
  <div>
    <h5 class="uppercase font-bold text-2xl">
      pililla emergency hotlines
    </h5>
    <div class="mt-5 flex flex-col items-center w-full">
      <div
        v-for="(i, idx) in Array.from([0,0,0,0])"
        :key="idx"
        class="flex items-center w-full"
        :class="{'bg-bggray' : idx % 2}"
      >
        <p class="text-sm sm:text-base border flex-1 p-3">
          Beureau of Fire Protection
        </p>
        <p class="text-sm sm:text-base border p-3">
          0909112908312
        </p>
      </div>
    </div>
  </div>
</template>
