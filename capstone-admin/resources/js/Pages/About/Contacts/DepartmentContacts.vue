<template>        
        <!-- list -->
        <div class="flex items-center gap-2 mt-2">
          <p class="border w-[150px] text-xs md:text-sm text-gray-700 font-medium">
            {{ title }}
          </p>
          <input v-model="number" type="text" class="focus:outline-blue-500 border p-2 w-full overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx]">
          <button type="button"
          class="bg-red-300 text-red-500 absolute text-xs rounded-lg right-2 top-2 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
          delete</button>
        </div>
</template>

<script setup>
defineProps({
    title: String,
   number: String
})
</script>

<style lang="scss" scoped>

</style>