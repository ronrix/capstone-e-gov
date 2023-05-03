<script setup>
defineProps({
    data: {type: Object, required: true},
    showAnswer: {type: Function, required:true}
})

function showAnswer(e) {
  document.querySelectorAll('.answers').forEach((el) => {
    if (e.target.nextElementSibling === el) {
      return
    }
    el.classList.add('hidden')
  })
  e.target.nextElementSibling.classList.toggle('hidden')
}
</script>

<template>
    <div class=" flex flex-col mt-5 cursor-pointer" @click="showAnswer">
        <div class="flex items-center justify-between pointer-events-none">
            <h2 class="text-normal text-dark font-medium dark:text-white">
            {{ data?.question }}
        </h2>
        <i class="uil uil-angle-down text-2xl"></i>
        </div>
      </div>
      <div class="hidden answers">
        <p class="w-[85%] text-secondary dark:text-gray-300 font-normal text-sm mt-2">
         {{ data?.ans }}
        </p>
      </div>
      <hr class="bg-gray-200 mt-6" />
  
    
     
     
</template>

<style lang="scss" scoped>

</style>