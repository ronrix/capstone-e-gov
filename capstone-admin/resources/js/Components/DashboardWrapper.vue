<template>
  <div class="flex items-center h-screen w-screen">
    <!-- sidebar -->
    <div class="w-[300px] h-screen">
      <img src="/images/logo/black/better-pililla.png" alt="this is the logo of piililla rizal" class="mx-auto">

      <nav class="mt-5 flex flex-col items-start justify-start gap-5">
        <!-- government -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Government
          </a>
          <div class="hidden pl-4">
            <a href="">Program & Events</a>
            <a href="">News</a>
            <a href="">Executives</a>
            <a href="">Job opportunities</a>
          </div>
        </section>


        <!-- tourism -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/tourism.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Tourism
          </a>
          <div class="hidden pl-4">
            <a href="">this is tourism</a>
          </div>
        </section>

        <!-- businesses -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/business.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Businesses
          </a>
          <div class="hidden pl-4">
            <a href="">this is businesses</a>
          </div>
        </section>

        <!-- services -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Services
          </a>
          <div class="hidden pl-4">
            <a href="">this is services</a>
          </div>
        </section>

        <!-- about -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/about.png" alt="this is an icon of government" class="w-[18px] mr-3">
            About
          </a>
          <div class="hidden pl-4">
            <a href="">this is about</a>
          </div>
        </section>

      </nav>
    </div>
    <div class="w-full h-full">
      <!-- header -->
      <div class="h-[30px] w-full flex justify-between items-center">
        <h3>government &hookrightarrow; news</h3>
        <button @click="alertMe" class="px-5 font-bold text-sm">Add new</button>
      </div>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
function alertMe() {
  alert("Hello, world!");
}

// handle show sub navs
function showSubNavs(e) {
  console.log(e);
  e.target.nextSibling.classList.toggle("hidden");
}
</script>

<style lang="scss" scoped></style>