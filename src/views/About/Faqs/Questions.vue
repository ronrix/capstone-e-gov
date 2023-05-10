<script setup>
import DOMPurify from 'dompurify'
import { marked } from 'marked'

defineProps({
  data: { type: Object, required: true },
  showAnswer: { type: Function, required: true }
})

function showAnswer(e) {
  console.log('you clicked me')
  const lastElement = e.target.nextElementSibling
  document.querySelectorAll('.answer').forEach((el) => {
    if (lastElement === el) {
      return
    }
    el.classList.remove('h-auto')
    el.previousElementSibling.lastElementChild.classList.remove('uil-angle-up')
    el.previousElementSibling.lastElementChild.classList.add('uil-angle-down')
  })
  lastElement.classList.toggle('h-auto')

  // change icon
  e.target.lastElementChild.classList.toggle('uil-angle-up')
}
</script>

<template>
  <div
    class="flex flex-col mt-5 cursor-pointer border border-x-0 border-t-0 border-b-gray-500 pb-5"
  >
    <div class="flex items-center justify-between" @click="showAnswer">
      <h2 class="text-normal text-dark dark:text-white font-[600]">
        {{ data?.question }}
      </h2>
      <i ref="icon" class="uil text-2xl uil-angle-down"></i>
    </div>
    <div class="answer h-0 overflow-hidden duration-500">
      <div
        :innerHTML="DOMPurify.sanitize(marked.parse(data?.answer))"
        class="w-[85%] text-dark dark:text-bggray font-normal text-sm mt-2 markdown"
      ></div>
    </div>
  </div>
</template>

<style>
.markdown a {
  color: #cd4945;
}
</style>