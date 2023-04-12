<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import SubNavs from './SubNavs.vue'
import SearchContainer from './SearchContainer.vue'
import { government, business, services, tourism } from '../../assets/config/sublinks'

// show the search input
const searchInput = ref(null)
const isShowSearchInput = ref(false)
function showSearchInput() {
  isShowSearchInput.value = !isShowSearchInput.value
  // focus the input search element
  searchInput.value.focus()
}

// setting the isShowSearchInput on mouse over of the blurred element
// so the search input won't be stucked showing when use scrolls
function closeSearchInput() {
  isShowSearchInput.value = false
}

// function to set the sublnks on hover of the navlink
const selectedSubLinks = ref()
function setSubLinkOnHover(e) {
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

// hide the sublinks if hovered out
function closeSubLink() {
  // store null if navs are not getting hovered over
  selectedSubLinks.value = null
}
</script>

<template>
  <nav>
    <WrapperContainer
      class="hidden sm:flex items-center justify-between gap-3 border border-t-0 border-x-0 relative"
    >
      <RouterLink
        to="/"
        class="uppercase font-['display'] font-bold hover:text-primary py-5 text-xs md:text-sm"
      >
        home
      </RouterLink>

      <RouterLink
        id="government"
        to="/government"
        class="capitalize hover:text-primary text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        government
        <i class="uil uil-angle-down" />
      </RouterLink>
      <RouterLink
        id="tourism"
        to="/tourism"
        class="capitalize hover:text-primary text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        tourism
        <i class="uil uil-angle-down" />
      </RouterLink>

      <!-- logo -->
      <img src="/images/BetterPilillaLogo-black.png" alt="this is a logo" class="w-32" />

      <RouterLink
        id="business"
        to="/business"
        class="capitalize hover:text-primary text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        business
        <i class="uil uil-angle-down" />
      </RouterLink>
      <RouterLink
        id="services"
        to="/services"
        class="capitalize hover:text-primary text-xs md:text-sm"
        @mouseover="setSubLinkOnHover"
      >
        services
        <i class="uil uil-angle-down" />
      </RouterLink>

      <RouterLink to="/about" class="capitalize hover:text-primary text-xs md:text-sm">
        about
      </RouterLink>

      <!-- search btn -->
      <i
        class="uil uil-search hover:text-primary cursor-pointer text-sm md:text-lg"
        @click="showSearchInput"
      />
    </WrapperContainer>

    <!-- sub navs container -->
    <SubNavs :sub-links="selectedSubLinks" :close-sub-link="closeSubLink" />

    <!-- search input container -->
    <SearchContainer
      :is-show-search-input="isShowSearchInput"
      :close-search-input="closeSearchInput"
      :search-input="searchInput"
    />
  </nav>
</template>