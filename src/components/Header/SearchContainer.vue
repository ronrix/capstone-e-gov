<script setup>
defineProps({
  isShowSearchInput: { type: Boolean, required: true },
  closeSearchInput: { type: Function, required: true },
  searchInput: { type: Object, required: true }
})
</script>

<template>
  <div
    class="absolute z-20 top-20 bottom-0 right-0 left-0 flex flex-col overflow-hidden duration-500"
    :class="{ 'h-screen': isShowSearchInput, 'h-0': !isShowSearchInput }"
  >
    <div class="bg-white p-5" @mouseleave="closeSearchInput">
      <WrapperContainer>
        <div class="flex items-center gap-2 mb-5">
          <i class="uil uil-search text-2xl" />
          <input
            ref="searchInput"
            type="search"
            placeholder="Search pililla"
            class="rounded-md md:text-base p-3 w-full outline-none placeholder-darkgray font-bold placeholder:text-xl"
          />
        </div>
        <!-- quick links -->
        <div class="flex flex-col items-start gap-3">
          <h5 class="capitalize text-xs">quick links</h5>
          <a
            v-for="(i, idx) in Array.from([0, 0, 0])"
            :key="idx"
            href=""
            class="text-xs hover:bg-bggray w-full font-semibold flex items-center gap-2 duration-300 rounded-md"
          >
            <i class="uil uil-arrow-right text-lg text-gray-400"></i>
            <span>sample link</span>
          </a>
        </div>
      </WrapperContainer>
    </div>
    <!-- bottom backdrop blur  -->
    <div class="backdrop-blur-3xl bg-white/50 flex-1"></div>
  </div>
</template>