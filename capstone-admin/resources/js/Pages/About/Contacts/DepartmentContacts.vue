<template>        
        <!-- list -->
        <div class="flex items-center gap-2 mt-2">
          <p class="w-[150px] text-xs md:text-sm text-gray-700 font-medium capitalize">
            {{ keyName }}
          </p>
          <div class="flex flex-wrap items-center gap-2">
            <input v-for="(num, arrId) in nums" :value="num" type="text" @change.capture="(e) => handleUpdateContactNumber(e, id, keyName, arrId)" class="focus:outline-blue-500 border p-2 overflow-scroll no-scrollbar m-0 text-xs h-[40px] max-h-[40ppx]">
          </div>
        </div>
</template>

<script setup>
defineProps({
    keyName: String,
    nums: Array,
    handleUpdateContactNumber: Function,
    id: Number
})
</script>

<style lang="scss" scoped>

</style>