<template>
  <RouterLink @click.passive="handleClick" ref="link" activeClass="bg-blue-600 text-white" :to="to"
    class="hover:bg-blue-600 hover:text-white cursor-pointer w-full p-2 capitalize whitespace-pre-wrap">
    {{ name }}
  </RouterLink>
</template>

<script setup>
import { ref } from 'vue';

const link = ref(null);

function handleClick(e) {
  // first: remove any active class style to "chil-sub-navs"
  const childSubNavs = document.querySelectorAll(".child-sub-navs");
  Array.from(childSubNavs).forEach(el => {
    if (el.previousElementSibling.classList.contains("bg-blue-600") && el.previousElementSibling.classList.contains("text-white")) {
      el.previousElementSibling.classList.remove('bg-blue-600');
      el.previousElementSibling.classList.remove('text-white');
    }
  });

  // check the parent element of the navLink has "child-sub-navs" class
  // hen add the blue active style if it has
  if (Array.from(link.value.$el.parentElement.parentElement.classList).includes("child-sub-navs")) {
    link.value.$el.parentElement.parentElement.previousElementSibling.classList.add('bg-blue-600');
    link.value.$el.parentElement.parentElement.previousElementSibling.classList.add('text-white');
  }

  // if has no child sub navs then removed any active classes to it.
  Array.from(link.value.$el.parentElement.children).forEach(el => {
    if (Array.from(el.classList).includes("bg-blue-600") && el !== e.target) {
      el.classList.remove("bg-blue-600");
      el.classList.remove("text-white");
    }
  });
}

defineProps({
  to: String,
  name: String
})
</script>