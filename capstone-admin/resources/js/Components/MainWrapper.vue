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
          <div @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Government
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/government/news" class="hover:text-blue-400">News</RouterLink>
            <RouterLink to="/government/programs-&-events">Programs & Events</RouterLink>
            <div @click="showSubNavs" class="cursor-pointer flex items-center">
              <!-- <img src="/images/icons/black/gov.png" alt="this is an icon of government" class="w-[18px] mr-3"> -->
              Executives
            </div>
           <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <RouterLink to="">Current Officials of Pililla Rizal</RouterLink>
              <RouterLink to="">Former Officials of Pililla Rizal</RouterLink>
              <RouterLink to=""> Sanggunian Barangay Officials</RouterLink>
              <RouterLink to="">Municipal Department Heads</RouterLink>
           </div>
            <!-- <RouterLink to="">Executives</RouterLink> -->
            <RouterLink to="/government/job-postings">Job Postings</RouterLink>
            <RouterLink to="/governmetn/office-of-the-mayor">Office of the Mayor</RouterLink>
            <RouterLink to="/governmetn/office-of-the-vice-mayor">Office of the Vice-Mayor</RouterLink>
            <RouterLink to="/government/full-disclosure-reports">Full Disclosure Reports</RouterLink>
            <RouterLink to="/government/hotlines">Emergency Hotlines</RouterLink>
            <RouterLink to="/government/population">Population of Pililla</RouterLink>
          </div>
        </section>


        <!-- tourism -->
        <section>
          <div @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/tourism.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Tourism
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/tourism/tourism">Tourism</RouterLink>
            <RouterLink to="/tourism/tourist-spots">Tourists Spot</RouterLink>
            <RouterLink to="/tourism/festivals">Festival</RouterLink>
            <RouterLink to="/tourism/guidelines">Guidelines</RouterLink>
          </div>
        </section>

        <!-- businesses -->
        <section>
          <div @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/business.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Businesses
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/businesses/apartments">Apartments</RouterLink>
            <RouterLink to="/businesses/permit-form">Business Permit Form</RouterLink>
            <RouterLink to="/businesses/ease-of-doing-business">Ease of Doing business</RouterLink>
          </div>
        </section>

        <!-- services -->
        <section>
          <div @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Services
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <div @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Office of the Mayor
            </div>
            <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
              <RouterLink to="">Example services</RouterLink>
            </div>
          <div @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            MSWD Department
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="">Example services</RouterLink>
          </div>
          <div @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            Agriculture Department
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/services">Example services</RouterLink>
          </div>
          <div @click="showSubNavs" class="cursor-pointer flex items-center">
            <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
            HR Department
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/services/">Example services</RouterLink>
          </div>
          </div>
        </section>

        <!-- about -->
        <section>
          <div @click="showSubNavs" class="cursor-pointer flex items-center pl-4">
            <img src="/images/icons/black/about.png" alt="this is an icon of government" class="w-[18px] mr-3">
            About
          </div>
          <div class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <RouterLink to="/about/mission-and-vision">Mission & Vission</RouterLink>
            <RouterLink to="/about/history">History</RouterLink>
            <RouterLink to="/about/official-seal">Official Seal</RouterLink>
            <RouterLink to="/about/contacts">Conatacts</RouterLink>
          </div>
        </section>

      </nav>
    </div>
    <div class="flex-1 h-full relative p-5">
      <!-- header -->
      <div class="h-[30px] flex justify-between items-center">
        <h3 class="font-bold text-sm"> you are in  <span class="text-blue-600">{{ currentRoute }}</span></h3>
        <div class="flex items-center justify-center">
          <div class="relative flex mr-5">
            <i class="uil uil-bell text-xl text-gray-700 hover:text-slate-500"></i>
            <div class="absolute -right-2 -top-3">
              <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
              </span>
            </div>
          </div>
          <div class="relative flex mr-5">
            <i class="uil uil-comment-alt-message text-xl text-gray-700 hover:text-slate-500"></i>
            <div class="absolute -right-2 -top-3">
              <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-sky-500"></span>
              </span>
            </div>
          </div>
          <img class="w-[30px] rounded-full" src="https://sm.ign.com/ign_ap/cover/a/avatar-gen/avatar-generations_hugw.jpg" alt="">
          <i class="uil uil-angle-down text-gray-700 text-2xl"></i>
        </div>
      </div>
      <slot></slot>
    </div>
  </div>
</template>

<script setup>
import { watch, ref } from 'vue';
import { RouterLink, useRoute } from 'vue-router';

const route = useRoute();
const currentRoute = ref(route.fullPath);

// adding watcher to update the currentRoute state when the route change
watch(route, (to, from) => {
  // Update necessary data based on the new route
  currentRoute.value = to.path;
})

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