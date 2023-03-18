<template>
    <nav class="mt-10 flex flex-col items-start justify-start">
  
      <!-- dashboard -->
      <div class="w-full">
        <RouterLink activeClass="bg-blue-600 text-white" to="/dashboard"
          class="flex items-center px-6 py-2 hover:bg-blue-600 hover:text-white">
          <i class="uil uil-apps mr-3 text-2xl"></i>
          <SideNavName name="Dashboard" :isWholeSidebar="isWholeSidebar" />
        </RouterLink>
      </div>
  
      <!-- government -->
      <SideNav @click="showSubNavs" class="flex" :class="{ 'bg-blue-600 text-white': page === 'government' }">
        <i class="uil uil-university mr-3 text-2xl pointer-events-none"></i>
        <div class="flex items-center justify-between w-full pointer-events-none">
          <SideNavName name="Government" :isWholeSidebar="isWholeSidebar" />
          <i class="uil uil-angle-down"></i>
        </div>
      </SideNav>
      <SubNavs v-show="isWholeSidebar">
        <NavLink name="news" to="/government/news" />
        <NavLink name="programs and events" to="/government/programs-and-events" />
        <div @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2 justify-between">
          <span>Executives</span>
          <i class="uil uil-angle-down"></i>
        </div>
        <div class="hidden child-sub-navs">
          <div
            class="flex mt-2 pl-4 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <NavLink name="Current Officials of Pililla Rizal" to="/government/executives/current-officials" />
            <NavLink name="former officials" to="/government/executives/former-officials" />
            <NavLink name="sanggunian barangay officials" to="/government/executives/barangay-officials" />
            <NavLink name="municipal department heads" to="/government/executives/department-heads" />
          </div>
        </div>
        <NavLink to="/government/job-postings" name="job postings" />
        <NavLink to="/government/full-disclosure-reports" name="full disclosure reports" />
        <NavLink to="/government/hotlines" name="hotlines" />
        <NavLink to="/government/demographic-profile" name="demographic profile" />
      </SubNavs>
  
  
      <!-- tourism -->
      <SideNav @click="showSubNavs" class="flex" :class="{ 'bg-blue-600 text-white': page === 'tourism' }">
        <i class="uil uil-map-pin-alt mr-3 text-2xl pointer-events-none"></i>
        <div class="flex items-center justify-between w-full pointer-events-none">
          <SideNavName name="Tourism" :isWholeSidebar="isWholeSidebar" />
          <i class="uil uil-angle-down"></i>
        </div>
      </SideNav>
      <SubNavs v-show="isWholeSidebar">
        <NavLink to="/tourism/tourism" name="tourism" />
        <NavLink to="/tourism/tourist-spots" name="tourists spots" />
        <NavLink to="/tourism/festivals" name="festivals" />
      </SubNavs>
  
      <!-- businesses -->
      <SideNav @click="showSubNavs" class="flex" :class="{ 'bg-blue-600 text-white': page === 'businesses' }">
        <i class="uil uil-tag-alt mr-3 text-2xl pointer-events-none"></i>
        <div class="flex items-center justify-between w-full pointer-events-none">
          <SideNavName name="Businesses" :isWholeSidebar="isWholeSidebar" />
          <i class="uil uil-angle-down"></i>
        </div>
      </SideNav>
      <SubNavs v-show="isWholeSidebar">
        <NavLink to="/businesses/apartments" name="apartments" />
        <NavLink to="/businesses/permit-form" name="permit form" />
        <NavLink to="/businesses/ease-of-doing-business" name="ease of doing business" />
      </SubNavs>
  
      <!-- services -->
      <SideNav @click="showSubNavs" class="flex" :class="{ 'bg-blue-600 text-white': page === 'services' }">
        <i class="uil uil-heartbeat mr-3 text-2xl pointer-events-none"></i>
        <div class="flex items-center justify-between w-full pointer-events-none">
          <SideNavName name="Services" :isWholeSidebar="isWholeSidebar" />
          <i class="uil uil-angle-down"></i>
        </div>
      </SideNav>
      <SubNavs v-show="isWholeSidebar">
        <div @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2">
          Office of the Mayor
        </div>
        <div class="hidden child-sub-navs">
          <div
            class="flex mt-2 pl-4 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0 w-full">
            <NavLink name="scholarship program" to="/services/office-of-the-mayor/scholarship-program" />
            <NavLink name="Civil Wedding Schedule" to="/services/office-of-the-mayor/civil-wedding-schedule" />
            <NavLink name="Mayor's Clearance" to="/services/office-of-the-mayor/mayors-clearance" />
          </div>
        </div>
        <div @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2">
          MSDWD Department
        </div>
        <div class="hidden child-sub-navs">
          <div
            class="flex mt-2 pl-4 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <NavLink name="Government ID" to="/services/mswd-department/government-id" />
            <NavLink name="Replacement of Senior Citizen" to="/services/mswd-department/replacement-of-senior-citizen" />
          </div>
        </div>
        <div @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2">
         Agriculture Department
        </div>
        <div class="hidden child-sub-navs">
          <div
            class="flex mt-2 pl-4 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <NavLink name="Example" to="/Services/agriculture-department/example" />
          </div>
        </div>
        <div @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2">
          HR Department
        </div>
        <div class="hidden child-sub-navs">
          <div
            class="flex mt-2 pl-4 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
            <NavLink name="Example" to="/Services/hr-department/example" />
          </div>
        </div>
      </SubNavs>
  
      <!-- about -->
      <SideNav @click="showSubNavs" class="flex" :class="{ 'bg-blue-600 text-white': page === 'about' }">
        <i class="uil uil-exclamation-circle mr-3 text-2xl pointer-events-none"></i>
        <div class="flex items-center justify-between w-full pointer-events-none">
          <SideNavName name="About" :isWholeSidebar="isWholeSidebar" />
          <i class="uil uil-angle-down"></i>
        </div>
      </SideNav>
      <SubNavs v-show="isWholeSidebar">
        <NavLink to="/about/official-seal" name="official seal" />
        <NavLink to="/about/contacts" name="contacts" />
      </SubNavs>
  
    </nav>
  </template>
  
  <script setup>
  import NavLink from './NavLink.vue';
  import SideNav from './SideNav.vue';
  import SideNavName from './SideNavName.vue';
  import SubNavs from './SubNavs.vue';
  
  
  defineProps({
    showSubNavs: Function,
    isWholeSidebar: Boolean,
    page: String,
    showChildSubNavs: Function,
  })
  </script>