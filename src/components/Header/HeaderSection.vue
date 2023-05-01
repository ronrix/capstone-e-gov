<script setup>
import { ref, onMounted } from 'vue'
import { RouterLink } from 'vue-router'
import SubNavs from './SubNavs.vue'
import SearchContainer from './SearchContainer.vue'
import { government, business, services, tourism, about } from '../../assets/config/sublinks'
import MobileNav from '../MobileNav/MobileNav.vue'

// show the search input
const isShowSearchInput = ref(false)
function showSearchInput() {
  isShowSearchInput.value = !isShowSearchInput.value
}

// setting the isShowSearchInput on mouse over of the blurred element
// so the search input won't be stucked showing when use scrolls
function closeSearchInput() {
  isShowSearchInput.value = false
}

// function to set the sublnks on hover of the navlink
const selectedSubLinks = ref()
function setSubLinkOnHover(e) {
  // first: hide the search container
  // so the subnavs can display without search container overlapping it
  isShowSearchInput.value = false

  if (e.target.id === 'government') {
    selectedSubLinks.value = government
    return
  }
  if (e.target.id === 'services') {
    selectedSubLinks.value = services
    return
  }
  if (e.target.id === 'business') {
    selectedSubLinks.value = business
    return
  }
  if (e.target.id === 'tourism') {
    selectedSubLinks.value = tourism
    return
  }
  if (e.target.id === 'about') {
    selectedSubLinks.value = about
    return
  }

  // store null if navs are not getting hovered over
  selectedSubLinks.value = null
}

// hide the sublinks if hovered out
function closeSubLink() {
  // store null if navs are not getting hovered over
  selectedSubLinks.value = null
}

// function to show the moblie navs
const isShowMobileNav = ref(false)
function showMobileNav(e) {
  isShowMobileNav.value = !isShowMobileNav.value
  e.target.firstElementChild.classList.toggle('rotate-45')
  e.target.firstElementChild.classList.toggle('translate-y-[8px]')

  e.target.lastElementChild.classList.toggle('-rotate-45')
  e.target.lastElementChild.classList.toggle('-translate-y-full')

  // add fixed to the menu bar button
  // so when user scrolls the button still on top
  e.target.classList.toggle('fixed')
  e.target.classList.toggle('top-0')
  e.target.classList.toggle('right-0')
}

// function to change the theme
const isDark = ref(localStorage.getItem('theme'))
function changeTheme() {
  if (isDark.value === 'white') {
    logoByTheme.value = '/images/better-pililla-white.png'
    localStorage.setItem('theme', 'dark')
    document.querySelector('html').classList.add('dark')
    isDark.value = 'dark'
    return
  }

  logoByTheme.value = '/images/better-pililla-black.png'
  document.querySelector('html').classList.remove('dark')
  localStorage.setItem('theme', 'white')
  isDark.value = 'white'
}

const logoByTheme = ref('/images/better-pililla-white.png')
onMounted(() => {
  if (localStorage.getItem('theme') !== 'dark') {
    logoByTheme.value = '/images/better-pililla-black.png'
    localStorage.setItem('theme', 'white')
    document.querySelector('html').classList.remove('dark')
    return
  }

  isDark.value = localStorage.getItem('theme')
  // set the theme to html tag
  document.querySelector('html').classList.add('dark')
})
</script>

<template>
  <nav class="sticky top-0 z-[500] bg-white dark:bg-dark duration-200">
    <!-- mobile nav view -->
    <div class="flex sm:hidden items-center justify-end gap-3">
      <!-- theme emode  -->
      <abbr title="theme">
        <i
          class="uil text-2xl text-dark hover:text-primary dark:text-bggray dark:hover:text-white cursor-pointer"
          :class="{
            'uil-moonset': isDark === 'white',
            'uil-brightness': isDark === 'dark'
          }"
          @click="changeTheme"
        ></i>
      </abbr>

      <!-- search button -->
      <i
        class="uil uil-search hover:text-primary cursor-pointer text-lg text-dark dark:text-bggray"
        @click="showSearchInput"
      ></i>

      <!-- hidden menu bar -->
      <div
        class="h-8 opacity-0 w-0 flex-col gap-2 justify-center cursor-pointer duration-1000 z-30"
        @click="showMobileNav"
      >
        <div class="w-full h-[2px] bg-gray-900 duration-300 pointer-events-none"></div>
        <div class="w-full h-[2px] bg-gray-900 duration-300 pointer-events-none"></div>
      </div>

      <!-- menu bar -->
      <div
        class="w-9 h-8 p-2 flex flex-col gap-2 justify-center cursor-pointer duration-1000 z-30"
        @click="showMobileNav"
      >
        <div
          class="w-full h-[2px] bg-gray-900 dark:bg-bggray duration-300 pointer-events-none"
        ></div>
        <div
          class="w-full h-[2px] bg-gray-900 dark:bg-bggray duration-300 pointer-events-none"
        ></div>
      </div>

      <!-- mobile navigations -->
      <MobileNav :is-show-mobile-nav="isShowMobileNav" />
    </div>

    <!-- tablet - up view -->
    <WrapperContainer
      class="hidden sm:flex items-center justify-between gap-3 border border-bggray dark:border-darkgray border-t-0 border-x-0 relative bg-white dark:bg-dark duration-200"
    >
      <!-- logo -->
      <img :src="logoByTheme" alt="this is a logo" class="w-32" />

      <RouterLink
        to="/"
        active-class="!text-primarylight"
        class="uppercase font-['display'] font-bold text-dark hover:text-primary dark:text-bggray dark:hover:text-white py-5 text-xs md:text-sm"
      >
        home
      </RouterLink>

      <div
        id="government"
        active-class="!text-primarylight"
        class="capitalize text-dark dark:text-bggray dark:hover:text-white hover:text-primary text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        government
        <i class="uil uil-angle-down" />
      </div>
      <RouterLink
        id="tourism"
        active-class="!text-primarylight"
        to="/tourism"
        class="capitalize hover:text-primary text-dark dark:text-bggray dark:hover:text-white text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        tourism
        <i class="uil uil-angle-down" />
      </RouterLink>

      <RouterLink
        id="business"
        active-class="!text-primarylight"
        to="/business"
        class="capitalize hover:text-primary dark:text-bggray dark:hover:text-white text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        business
        <i class="uil uil-angle-down" />
      </RouterLink>
      <RouterLink
        id="services"
        active-class="!text-primarylight"
        to="/services"
        class="capitalize hover:text-primary dark:text-bggray dark:hover:text-white text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        services
        <i class="uil uil-angle-down" />
      </RouterLink>

      <div
        id="about"
        active-class="!text-primarylight"
        class="capitalize hover:text-primary dark:text-bggray dark:hover:text-white text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        about
        <i class="uil uil-angle-down" />
      </div>

      <!-- theme emode  -->
      <abbr title="theme">
        <i
          class="uil text-2xl text-dark hover:text-primary dark:text-bggray dark:hover:text-white cursor-pointer"
          :class="{
            'uil-moonset': isDark === 'white',
            'uil-brightness': isDark === 'dark'
          }"
          @click="changeTheme"
        ></i>
      </abbr>

      <!-- search btn -->
      <i
        class="uil uil-search hover:text-primary text-dark dark:text-bggray dark:hover:text-white cursor-pointer text-sm md:text-lg"
        @click="showSearchInput"
      />
    </WrapperContainer>

    <!-- sub navs container -->
    <SubNavs :sub-links="selectedSubLinks" :close-sub-link="closeSubLink" />

    <!-- search input container -->
    <SearchContainer
      :is-show-search-input="isShowSearchInput"
      :close-search-input="closeSearchInput"
    />
  </nav>
</template>
