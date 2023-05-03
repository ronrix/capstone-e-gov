<script setup>
import { ref } from 'vue'

defineProps({
  data: { type: Object, required: true },
  showAnswer: { type: Function, required: true }
})

const iconDown = ref(false)
function showAnswer(e) {
  console.log(e.target.nextElementSibling)
  const lastElement = e.target.lastElementChild
  document.querySelectorAll('.answer').forEach((el) => {
    if (lastElement === el) {
      return
    }
    el.classList.remove('h-auto')
  })
  lastElement.classList.toggle('h-auto')

  // change icon
  iconDown.value = !iconDown.value
}
</script>

<template>
  <div
    class="flex flex-col mt-5 cursor-pointer border border-x-0 border-t-0 border-b-gray-500 pb-5"
    @click="showAnswer"
  >
    <div class="flex items-center justify-between pointer-events-none">
      <h2 class="text-normal text-dark font-medium dark:text-white">
        {{ data?.question }}
      </h2>
      <i
        ref="icon"
        class="uil text-2xl"
        :class="{ 'uil-angle-down': !iconDown, 'uil-angle-up': iconDown }"
      ></i>
    </div>
    <div class="answer h-0 overflow-hidden duration-500">
      <p class="w-[85%] text-secondary dark:text-gray-300 font-normal text-sm mt-2">
        {{ data?.ans }}
      </p>
    </div>
  </div>
</template>

<style lang="scss" scoped></style>