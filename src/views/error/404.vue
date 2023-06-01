<script setup></script>
<template>
  <div class="relative">
    <object
      type="image/svg+xml"
      data="https://cdn.svgator.com/images/2022/01/404-svg-animation.svg"
      alt="Kitty Yarn Play 404 SVG animation example"
      class="h-screen w-screen"
    ></object>

    <h1
      class="absolute text-2xl text-bggray top-2/3 left-1/2 -translate-x-1/2 w-full text-center font-bold"
    >
      <span class="block text-5xl">Sorry!</span>
      We can't find the page you're looking for!

      <a
        class="block text-xl text-[#3cbfc5] hover:underline uppercase mt-2 w-fit mx-auto"
        @click="$router.back()"
      >
        go back
      </a>
    </h1>
  </div>
</template>