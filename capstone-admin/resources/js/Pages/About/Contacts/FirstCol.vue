<template> 
        <div class="flex items-center">
        <i class="text-2xl text-gray-700 mr-2 uil uil-mobile-android"></i>
        <p class="text-sm font-medium text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ first?.mobilePh }}</textarea></p>
        </div>
        <div class="flex items-center">
          <i class="text-2xl text-gray-700 mr-2 uil uil-mobile-android"></i>
          <p class="text-sm font-medium text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ first?.mobileInt }}</textarea></p>
        </div>
        <div class="flex items-center">
          <i class="text-2xl text-gray-700 mr-2 uil uil-phone"></i>
          <p class="text-sm font-medium text-gray-800"><textarea class="h-[20px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ first?.telephoneNum }}</textarea></p>
        </div>    
</template>

<script setup>
defineProps({ first: Object });
</script>

<style lang="scss" scoped>

</style>