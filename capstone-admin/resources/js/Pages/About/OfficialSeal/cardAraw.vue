<template>
    <div class="right-side flex flex-col items-center justify-center">
          <img class="w-[400px]" src=""
            alt="">
        </div>
     <div class="left-side flex flex-col">
        
        <h4 class="text-2xl text-blue-500 font-semibold"><textarea cols="4" rows="1"
                class="h-[30px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ second?.blue }}
                        </textarea></h4>
        <h1 class="text-4xl font-extrabold text-red-800 mb-4"><textarea cols="15" rows="1"
                class="h-[40px] focus:outline-blue-500 overflow-scroll no-scrollbar bg-white">{{ second?.araw }}</textarea></h1>

        <div>
            <p class="text-sm font-medium text-gray-800"><textarea rows="10"
                class="w-full focus:outline-blue-500 overflow-scroll no-scrollbar bg-white p-2 text-left">{{ second?.text }}</textarea></p>
        </div>         
    </div>        
</template>

<script setup>
defineProps({second: Object});
</script>

<style lang="scss" scoped>

</style>