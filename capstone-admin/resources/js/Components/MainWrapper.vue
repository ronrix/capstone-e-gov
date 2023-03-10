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
        <section>
          <RouterLink to="/dashboard" class="pl-4">
            <i class="fa-solid fa-house mr-3"></i>
            Dashboard
          </RouterLink>
        </section>
        <!-- government -->
        <section>
          <a @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Government
          </a>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/government/news" class="hover:text-blue-400">News</RouterLink>
            <RouterLink to="/government/programs-&-events">Programs & Events</RouterLink>
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
            <RouterLink to="government/job-postings">Job Postings</RouterLink>
            <RouterLink to="">Office of the Mayor</RouterLink>
            <RouterLink to="">Office of the Vice-Mayor</RouterLink>
            <RouterLink to="">Full Disclosure Reports</RouterLink>
            <RouterLink to="/government/hotlines">Emergency Hotlines</RouterLink>
            <a href="/government/population">Population of Pililla</a>
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
    <div class="flex-1 h-full relative p-2">
      <!-- header -->
      <div class="h-[30px] flex justify-between items-center">
        <h3>{{ $page.url }}</h3>
        <button @click="showAddModal" class="px-5 font-bold text-sm">Add new</button>
      </div>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router';

// handle show sub navs
function showSubNavs(e) {
  console.log(e);
  e.target.nextSibling.classList.toggle("hidden");
}

defineProps({
  showAddModal: Function
})
</script>

<style lang="scss" scoped></style>