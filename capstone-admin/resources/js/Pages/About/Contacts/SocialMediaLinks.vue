<template>        
    <!-- list -->
    <div class="flex items-center gap-2 mt-2">
     <img class="w-10 mr-5" :src="data?.img_link"  alt="this is facebook logo">
      <input v-model="links" type="text" class="flex-1 focus:outline-blue-500 border p-2 w-full overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx]">
      <button type="button"
          class="bg-red-300 text-red-500 absolute  text-xs rounded-lg right-2 top-2 px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer">
          delete</button>
    </div>
</template>

<script setup>
defineProps({
data: Object,
links: String
})
</script>

<style lang="scss" scoped>

</style>