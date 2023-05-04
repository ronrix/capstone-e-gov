<template>
  <nav class="mt-10 flex flex-col items-start justify-start">
    <!-- dashboard -->
    <div class="w-full">
      <RouterLink
        activeClass="bg-blue-600 text-white"
        to="/dashboard"
        class="flex items-center px-6 py-2 hover:bg-blue-600 hover:text-white"
      >
        <i class="uil uil-apps mr-3 text-2xl"></i>
        <SideNavName name="Dashboard" :isWholeSidebar="isWholeSidebar" />
      </RouterLink>
    </div>

    <!-- government -->
    <SideNav
      @click="showSubNavs"
      class="flex"
      :class="{ 'bg-blue-600 text-white': page === 'government' }"
    >
      <i class="uil uil-university mr-3 text-2xl pointer-events-none"></i>
      <div class="flex items-center justify-between w-full pointer-events-none">
        <SideNavName name="Government" :isWholeSidebar="isWholeSidebar" />
        <i class="uil uil-angle-down pointer-events-none"></i>
      </div>
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink name="news" to="/government/news" />
      <NavLink
        name="programs and events"
        to="/government/programs-and-events"
      />
      <div
        @click="showChildSubNavs"
        class="cursor-pointer relative flex items-center hover:bg-blue-600 hover:text-white w-full p-2 justify-between"
      >
        <span class="pointer-events-none">Executives</span>
        <i class="uil uil-angle-down pointer-events-none"></i>
      </div>
      <div class="hidden child-sub-navs w-full">
        <div
          class="flex mt-2 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0 gap-1"
        >
          <NavLink
            name="Current Officials of Pililla Rizal"
            to="/government/executives/current-officials"
          />
          <NavLink
            name="former officials"
            to="/government/executives/former-officials"
          />
          <NavLink
            name="sanggunian barangay officials"
            to="/government/executives/barangay-officials"
          />
          <NavLink
            name="municipal department heads"
            to="/government/executives/department-heads"
          />
        </div>
      </div>
      <NavLink to="/government/job-postings" name="job postings" />
      <NavLink to="/government/ordinances" name="ordinances" />
      <NavLink
        to="/government/full-disclosure-reports"
        name="full disclosure reports"
      />
      <NavLink to="/government/hotlines" name="hotlines" />
      <NavLink
        to="/government/demographic-profile"
        name="demographic profile"
      />
      <NavLink to="/government/official-seal" name="official seal" />
    </SubNavs>

    <!-- tourism -->
    <SideNav
      @click="showSubNavs"
      class="flex"
      :class="{ 'bg-blue-600 text-white': page === 'tourism' }"
    >
      <i class="uil uil-map-pin-alt mr-3 text-2xl pointer-events-none"></i>
      <div class="flex items-center justify-between w-full pointer-events-none">
        <SideNavName name="Tourism" :isWholeSidebar="isWholeSidebar" />
        <i class="uil uil-angle-down pointer-events-none"></i>
      </div>
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink to="/tourism/tourist-spots" name="tourist attractions" />
      <NavLink to="/tourism/festivals" name="festivals" />
    </SubNavs>

    <!-- businesses -->
    <SideNav
      @click="showSubNavs"
      class="flex"
      :class="{ 'bg-blue-600 text-white': page === 'businesses' }"
    >
      <i class="uil uil-tag-alt mr-3 text-2xl pointer-events-none"></i>
      <div class="flex items-center justify-between w-full pointer-events-none">
        <SideNavName name="Businesses" :isWholeSidebar="isWholeSidebar" />
        <i class="uil uil-angle-down pointer-events-noner"></i>
      </div>
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink
        to="/businesses/business-establishments"
        name="business establishments"
      />
      <NavLink to="/businesses/apartments" name="apartments" />
      <NavLink to="/businesses/BPLO" name="BPLO" />
    </SubNavs>

    <!-- services -->
    <SideNav
      @click="showSubNavs"
      class="flex relative"
      :class="{ 'bg-blue-600 text-white': page === 'services' }"
    >
      <i class="uil uil-heartbeat mr-3 text-2xl pointer-events-none"></i>
      <div class="flex items-center justify-between w-full pointer-events-none">
        <SideNavName name="Services" :isWholeSidebar="isWholeSidebar" />
        <i class="uil uil-angle-down pointer-events-none"></i>
      </div>

      <!-- button to show a modal to create new service -->
      <button
        type="button"
        @click="showCreateService"
        :class="{ hidden: !isWholeSidebar }"
        class="absolute top-1/2 -translate-y-1/2 right-10 border hover:bg-white hover:!text-black border-green-300 text-green-300 rounded-md px-2 mr-2 text-xs create-service-btn"
      >
        create
      </button>
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <div
        v-for="(services, key, idx) in serviceTypes"
        :key="idx"
        class="w-full"
      >
        <div
          @click="showChildSubNavs"
          class="cursor-pointer relative flex items-center justify-between hover:bg-blue-600 hover:text-white w-full p-2"
        >
          <span class="pointer-events-none capitalize">{{ key }}</span>
          <i class="uil uil-angle-down pointer-events-none"></i>
        </div>
        <div class="hidden child-sub-navs w-full">
          <div
            class="flex mt-2 flex-col items-start justify-start border border-l-4 ml-5 border-r-0 border-b-0 border-t-0 w-full gap-1"
          >
            <NavLink
              v-for="(service, id) in services"
              :key="id"
              :name="service"
              :to="`/services/${key.toLowerCase().replace(/ /g, '-')}/${service
                .toLowerCase()
                .replace(/ /g, '-')}`"
            />
          </div>
        </div>
      </div>
    </SubNavs>

    <!-- about -->
    <SideNav
      @click="showSubNavs"
      class="flex"
      :class="{ 'bg-blue-600 text-white': page === 'about' }"
    >
      <i
        class="uil uil-exclamation-circle mr-3 text-2xl pointer-events-none"
      ></i>
      <div class="flex items-center justify-between w-full pointer-events-none">
        <SideNavName name="About" :isWholeSidebar="isWholeSidebar" />
        <i class="uil uil-angle-down"></i>
      </div>
    </SideNav>
    <SubNavs v-show="isWholeSidebar">
      <NavLink to="/about/contacts" name="contacts" />
    </SubNavs>
  </nav>
</template>
  
<script setup>
import NavLink from "./NavLink.vue";
import SideNav from "./SideNav.vue";
import SideNavName from "./SideNavName.vue";
import SubNavs from "./SubNavs.vue";

defineProps({
  showSubNavs: Function,
  isWholeSidebar: Boolean,
  page: String,
  showChildSubNavs: Function,
  showCreateService: Function,
  serviceTypes: Object,
});
</script>
