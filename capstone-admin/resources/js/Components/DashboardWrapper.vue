<template>
  <div class="flex items-center h-screen">
    <!-- menu bar -->
    <div class="block sm:hidden">
      menu
    </div>
    <!-- sidebar -->
    <div class="h-screen hidden sm:block">
      <img src="/images/logo/black/better-pililla.png" alt="this is the logo of piililla rizal" class="mx-auto">

      <nav class="mt-5 flex flex-col items-start justify-start gap-5">
        <!-- government -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Government
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <a href="" class="hover:text-blue-400">News</a>
            <a href="">Programs & Events</a>
            <a @click="showSubNavs" class="cursor-pointer flex items-center">
              <!-- <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3"> -->
              Executives
           </a>
           <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <a href="">Current Officials of Pililla Rizal</a>
              <a href="">Former Officials of Pililla Rizal</a>
              <a href=""> Sanggunian Barangay Officials</a>
              <a href="">Municipal Department Heads</a>
           </div>
            <!-- <a href="">Executives</a> -->
            <a href="">Job Opportunities</a>
            <a href="">Office of the Mayor</a>
            <a href="">Office of the Vice-Mayor</a>
            <a href="">Barangays</a>
            <a href="">Full Disclosure Reports</a>
            <a href="">Map Location</a>
            <a href="">Emergency Hotlines</a>
            <a href="">Ordinances</a>
            <a href="">Officials</a>
            <a href="">Population of Pilillav</a>
          </div>
        </section>


        <!-- tourism -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/tourism.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Tourism
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <a href="">Map Location</a>
            <a href="">Tourism</a>
            <a href="">Tourists Spot</a>
            <a href="">Festival</a>
            <a href="">Guidelines</a>
          </div>
        </section>

        <!-- businesses -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/business.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Businesses
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <a href="">Apartment</a>
            <a href="">Business Permit Form</a>
            <a href="">Ease of Doing business</a>
          </div>
        </section>

        <!-- services -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Services
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <a @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Office of the Mayor
          </a>
            <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <a href="">Example services</a>
            </div>
            <a @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            MSWD Department
          </a>
            <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <a href="">Example services</a>
            </div>
            <a @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Agriculture Department
          </a>
            <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <a href="">Example services</a>
            </div>
            <a @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            HR Department
          </a>
            <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <a href="">Example services</a>
            </div>
          </div>
        </section>

        <!-- about -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/about.png" alt="this is an icon of government" class="w-[18px] mr-3">
            About
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <a href="">Mission & Vission</a>
            <a href="">History</a>
            <a href="">Location</a>
            <a href="">Official Seal</a>
            <a href="">Website Developers</a>
            <a href="">Conatacts</a>
          </div>
        </section>

      </nav>
    </div>
    <div class="flex-1 h-full relative">
      <!-- header -->
      <div class="h-[30px] flex justify-between items-center">
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