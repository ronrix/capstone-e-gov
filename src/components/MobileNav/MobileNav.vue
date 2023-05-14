<script setup>
import { ref, onUpdated } from 'vue'
import { government, services, tourism, business } from '../../assets/config/sublinks'
import { RouterLink } from 'vue-router'
import MobileSubNavs from './MobileSubNavs.vue'

const props = defineProps({
  isShowMobileNav: { type: Boolean, required: true }
})

// function to set the sublnks on click of the navlink
const selectedSubLinks = ref(null)
function setSubLinkOnClick(e) {
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

  // store null if navs are not getting hovered over
  selectedSubLinks.value = null
}

// go back to main navs
function goBackToMainNavs() {
  selectedSubLinks.value = null
}

// set the selected sublnks to null if isShowMobileNav is false
onUpdated(() => {
  if (!props.isShowMobileNav) {
    selectedSubLinks.value = null
  }
})
</script>

<template>
  <div
    class="fixed z-20 top-0 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-700 bg-white dark:bg-dark"
    :class="{ 'h-screen': isShowMobileNav, 'h-0': !isShowMobileNav }"
  >
    <!-- sub links  -->
    <MobileSubNavs
      :selected-sub-links="selectedSubLinks"
      :go-back-to-main-navs="goBackToMainNavs"
      :is-show-mobile-nav="isShowMobileNav"
      :class="{ '!translate-x-full !opacity-0': !isShowMobileNav }"
    />

    <div class="pt-8 px-5 flex flex-col gap-3">
      <RouterLink
        to="/"
        class="text-3xl text-dark dark:text-bggray dark:hover:text-white hover:text-black"
        >Home</RouterLink
      >
      <div
        id="government"
        class="text-3xl flex justify-between items-center group cursor-pointer text-dark dark:text-bggray dark:hover:text-white hover:text-black"
        @click="setSubLinkOnClick"
      >
        Government
        <i
          class="uil uil-angle-right opacity-0 group-hover:opacity-100 duration-300 pointer-events-none"
        />
      </div>
      <div
        class="text-3xl flex justify-between items-center group cursor-pointer text-dark dark:text-bggray dark:hover:text-white hover:text-black"
      >
        <RouterLink to="/business">Business</RouterLink>
        <i
          id="business"
          class="uil uil-angle-right opacity-0 group-hover:opacity-100 duration-300"
          @click="setSubLinkOnClick"
        />
      </div>
      <div
        class="text-3xl flex justify-between items-center group cursor-pointer text-dark dark:text-bggray dark:hover:text-white hover:text-black"
      >
        <RouterLink to="/tourism"> Tourism </RouterLink>
        <i
          id="tourism"
          class="uil uil-angle-right opacity-0 group-hover:opacity-100 duration-300"
          @click="setSubLinkOnClick"
        />
      </div>
      <div
        class="text-3xl flex justify-between items-center group cursor-pointer text-dark dark:text-bggray dark:hover:text-white hover:text-black"
      >
        <RouterLink to="/services"> Services </RouterLink>
        <i
          id="services"
          class="uil uil-angle-right opacity-0 group-hover:opacity-100 duration-300"
          @click="setSubLinkOnClick"
        />
      </div>
      <RouterLink
        to="/about"
        class="text-3xl text-dark dark:text-bggray dark:hover:text-white hover:text-black"
        >About</RouterLink
      >
    </div>
  </div>
</template>