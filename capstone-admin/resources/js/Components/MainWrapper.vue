<template>
  <div class="flex items-start h-screen">
    <!-- sidebar -->
    <div class="sticky top-0 pt-5 rounded-xl h-screen hidden sm:block duration-100 bg-white whitespace-nowrap z-10"
      :class="isWholeSidebar ? 'w-[350px]' : 'w-[70px]'">
      <div class="overflow-y-scroll no-scrollbar h-full">
        <div class="flex px-6 items-start">
          <img :src="$page.props.img_path" alt="this is the pililla government logo" class="w-[50px]">
          <h4 class="font-bold text-2xl ml-2 whitespace-pre-wrap text-gray-800"
            :class="!isWholeSidebar ? 'opacity-0' : 'opacity-100'">Better Pililla</h4>
        </div>

        <!-- arrow to show the whole navs -->
        <div @click="showWholeSidebar"
          class="z-10 cursor-pointer bg-blue-600 absolute -right-5 top-14 shadow-lg w-[40px] h-[40px] rounded-full border flex items-center justify-center">
          <i class="uil uil-angle-right text-white font-bold text-4xl pointer-events-none"></i>
        </div>

        <!-- navigations -->
        <Navs :showChildSubNavs="showChildSubNavs" :showSubNavs="showSubNavs" :isWholeSidebar="isWholeSidebar" :page="page"  />
      </div>
    </div>
    <div class="flex-1 h-full relative">
      <!-- header -->
      <Topbar :showChildSubNavs="showChildSubNavs" :currentRoute="currentRoute" :showSubNavs="showSubNavs" :page="page" class="sticky top-0 bg-white p-5 shadow-sm z-10" />
      <div class="md:px-8 -z-10">
        <slot></slot>
      </div>
    </div>
  </div>
</template>

<script setup>
import { watch, ref } from 'vue';
import { useRoute } from 'vue-router';
import Navs from './Sidebar/Navs.vue';
import Topbar from './Topbar.vue';

const route = useRoute();
const currentRoute = ref(route.fullPath);

let page = ref(currentRoute.value.split('/')[1]);

// adding watcher to update the currentRoute state when the route change
watch(route, (to, from) => {
  // Update necessary data based on the new route
  currentRoute.value = to.path;
  page.value = currentRoute.value.split("/")[1];
})

// handle show sub navs
function showSubNavs(e) {
  isWholeSidebar.value = true;

   // close all the subnavs before opening one
  const subNavs = document.querySelectorAll(".subnavs");
  const activeNavText = e.target.lastElementChild;

  for (let i = 0; i < subNavs.length; i++) {
    const subNav = subNavs[i];

    if (subNav.previousElementSibling.lastElementChild === activeNavText) {
      continue;
    }

    subNav.classList.add('hidden');
  }
  setTimeout(() => e.target.nextSibling.classList.toggle("hidden"), 100);
}

// toggle whole sidebar
// this is invoked when the arrow is clicked 
// then this will toggle show the whole sidebar with text and icon
const isWholeSidebar = ref(false);
function showWholeSidebar() {
  isWholeSidebar.value = !isWholeSidebar.value;
}

function showChildSubNavs(e) {
  // hide all the child subnavs before showing the clicked one
  // to prevent all of the child subnavs from showing
  // looping through all of the elements of childSubNavs to target each of them, then add the hidden class
  document.querySelectorAll(".child-sub-navs").forEach(el => el.classList.add("hidden"));

  // display the child navs of the nav that was clicked
  e.target.nextElementSibling.classList.toggle("hidden");
}

</script>

<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>