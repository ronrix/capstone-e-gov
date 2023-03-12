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
    <SideNav @click="showSubNavs" :class="{ 'bg-blue-600 text-white': page === 'government' }">
      <i class="uil uil-university mr-3 text-2xl pointer-events-none"></i>
      <SideNavName name="Government" :isWholeSidebar="isWholeSidebar" />
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink name="news" to="/government/news" />
      <NavLink name="programs and events" to="/government/programs-and-events" />
      <div @click="showSubNavs"
        class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2">
        Executives
      </div>
      <div
        class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
        <NavLink name="Current Officials of Pililla Rizal" to="/government/current-officials" />
        <NavLink name="former officials" to="/government/former-officials" />
        <NavLink name="sanggunian barangay officials" to="/government/barangay-officials" />
        <NavLink name="municipal department heads" to="/government/department-heads" />
      </div>
      <NavLink to="/government/job-postings" name="job postings" />
      <NavLink to="/government/office-of-the-mayor" name="office of the mayor" />
      <NavLink to="/government/office-of-the-vice-mayor" name="office of the vice mayor" />
      <NavLink to="/government/full-disclosure-reports" name="full disclosure reports" />
      <NavLink to="/government/hotlines" name="hotlines" />
      <NavLink to="/government/populations" name="populations" />
    </SubNavs>


    <!-- tourism -->
    <SideNav @click="showSubNavs" :class="{ 'bg-blue-600 text-white': page === 'tourism' }">
      <i class="uil uil-map-pin-alt mr-3 text-2xl pointer-events-none"></i>
      <SideNavName name="Tourism" :isWholeSidebar="isWholeSidebar" />
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink to="/tourism/tourism" name="tourism" />
      <NavLink to="/tourism/tourist-spots" name="tourists spots" />
      <NavLink to="/tourism/festivals" name="festivals" />
      <NavLink to="/tourism/guidelines" name="guidelines" />
    </SubNavs>

    <!-- businesses -->
    <SideNav @click="showSubNavs" :class="{ 'bg-blue-600 text-white': page === 'businesses' }">
      <i class="uil uil-tag-alt mr-3 text-2xl pointer-events-none"></i>
      <SideNavName name="Businesses" :isWholeSidebar="isWholeSidebar" />
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink to="/businesses/apartments" name="apartments" />
      <NavLink to="/businesses/permit-form" name="permit form" />
      <NavLink to="/businesses/ease-of-doing-business" name="ease of doing business" />
    </SubNavs>

    <!-- services -->
    <SideNav @click="showSubNavs" :class="{ 'bg-blue-600 text-white': page === 'services' }">
      <i class="uil uil-heartbeat mr-3 text-2xl pointer-events-none"></i>
      <SideNavName name="Services" :isWholeSidebar="isWholeSidebar" />
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <div @click="showSubNavs" class="cursor-pointer flex items-center">
        <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
        Office of the Mayor
      </div>
      <div
        class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
        <RouterLink to="">Example services</RouterLink>
      </div>
      <div @click="showSubNavs" class="cursor-pointer flex items-center">
        <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
        MSWD Department
      </div>
      <div
        class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
        <RouterLink to="">Example services</RouterLink>
      </div>
      <div @click="showSubNavs" class="cursor-pointer flex items-center">
        <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
        Agriculture Department
      </div>
      <div
        class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
        <RouterLink to="/services">Example services</RouterLink>
      </div>
      <div @click="showSubNavs" class="cursor-pointer flex items-center">
        <img src="/images/icons/black/services.png" alt="this is an icon of government" class="w-[18px] mr-3">
        HR Department
      </div>
      <div
        class="hidden flex mt-2 pl-4 flex-col items-start justify-start gap-2 border border-l-4 ml-5 border-r-0 border-b-0 border-t-0">
        <RouterLink to="/services/">Example services</RouterLink>
      </div>
    </SubNavs>

    <!-- about -->
    <SideNav @click="showSubNavs" :class="{ 'bg-blue-600 text-white': page === 'about' }">
      <i class="uil uil-exclamation-circle mr-3 text-2xl pointer-events-none"></i>
      <SideNavName name="About" :isWholeSidebar="isWholeSidebar" />
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink to="/about/mission-and-vision" name="mission and vision" />
      <NavLink to="/about/history" name="history" />
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
})
</script>