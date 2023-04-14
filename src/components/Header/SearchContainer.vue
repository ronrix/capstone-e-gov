<script setup>
import { ref, onUpdated } from 'vue'

defineProps({
  isShowSearchInput: { type: Boolean, required: true },
  closeSearchInput: { type: Function, required: true }
})

const searchInput = ref(null)
onUpdated(() => {
  searchInput.value.focus()
})
</script>

<template>
  <div
    class="absolute z-20 top-8 sm:top-14 md:top-20 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-700"
    :class="{ 'h-screen': isShowSearchInput, 'h-0': !isShowSearchInput }"
  >
    <div class="bg-white dark:bg-dark p-5 duration-200" @mouseleave="closeSearchInput">
      <WrapperContainer class="h-[300px] overflow-y-auto">
        <div class="flex items-center gap-2 mb-5">
          <i class="uil uil-search text-2xl text-dark dark:text-bggray" />
          <input
            ref="searchInput"
            type="search"
            placeholder="Search pililla"
            class="rounded-md md:text-base p-3 w-full outline-none placeholder-darkgray dark:placeholder-bggray font-bold placeholder:text-xl bg-transparent dark:text-bggray"
          />
        </div>
        <!-- quick links -->
        <div class="flex flex-col items-start gap-3">
          <h5 class="capitalize text-xs text-bggray">quick links</h5>
          <a
            v-for="(i, idx) in Array.from([0, 0, 0])"
            :key="idx"
            href=""
            class="text-xs dark:text-bggray dark:hover:bg-secondary hover:bg-bggray w-full font-semibold flex items-center gap-2 duration-300 rounded-md"
          >
            <i class="uil uil-arrow-right text-lg text-gray-400"></i>
            <span>sample link</span>
          </a>
        </div>
      </WrapperContainer>
    </div>
    <!-- bottom backdrop blur  -->
    <div class="backdrop-filter bg-white/50 dark:bg-dark/50 h-full"></div>
  </div>
</template>