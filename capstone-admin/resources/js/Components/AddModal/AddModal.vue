<template>
  <div class="absolute top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20">
    <div class="w-[500px] bg-white mx-auto p-10 flex flex-col relative overflow-hidden">
      <!-- close btn -->
      <div @click="showAddModal" class="flex items-end justify-start absolute right-0 top-0 bg-red-500 text-white px-5">
        <i class="fa-solid fa-xmark mb-1 group-hover:hidden"></i>
      </div>

      <h2 class="font-bold text-2xl uppercase mb-0">Add modal</h2>
      <p class="mb-5">The order of this form will be the order when it gets displayed to the website</p>

      <form method="POST" action="/create-news" @submit.capture="submitForm">
        <input name="title" type="text" placeholder="Add title here" class="border mb-5 p-2" value="title">
        <input name="subtitle" type="text" plapceholder="Add subtitle here" class="border p-2" value="subtitle">

        <!-- imput options -->
        <!-- when this clicked it will show choices of elements, when one is clicked it will add new element to the form -->
        <div class="flex items-center mt-5">
          <div id="textarea" @click="addNewElement" class="hover:bg-gray-300 text-center border p-2 cursor-pointer">
            <i class="fa-solid fa-font text-2xl pointer-events-none"></i>
            <p class="pointer-events-none">paragraph</p>
          </div>
          <div id="img" @click="addNewElement" class="hover:bg-gray-300 text-center ml-5 border p-2 cursor-pointer">
            <i class="fa-solid fa-image text-2xl pointer-events-none"></i>
            <p class="pointer-events-none">image</p>
          </div>
        </div>

        <button type="submit" class="mt-5 bg-blue-400 px-5 py-2 text-white">save</button>
      </form>
    </div>
  </div>
</template>

<script setup>
import TurndownService from "turndown";

// adding new element to the form
function addNewElement(e) {
  let whatElement = e.target;
  let el = document.createElement(whatElement.id);

  // if img elmeent
  if(whatElement.id === "img") {
    el = document.createElement("input");
    el.type = "file";
    el.name = "img";
    // el.src = "https://images.unsplash.com/photo-1677484227914-e06f939da0a2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=687&q=80";
  } 
  else { // if textarea
    el.name = "content";
    el.placeholder = "Add new content";
    el.className = "my-2";
  }

  // append new element
  whatElement.parentNode.parentNode.insertBefore(el, whatElement.parentNode);
}

// convert input, textarea, img to supported elements of turndown
function convertHtmlToSupportedFormats(el) {
  const nodeName = el.nodeName.toLowerCase();
  if(nodeName === "input" && el.name === "title") {
    return "<h1>" +  el.value + "</h1>";
  }
  if(nodeName === "input" && el.name === "subtitle") {
    return "<h2>" +  el.value + "</h2>";
  }
  if(nodeName === "input" && el.type === "file") {
    return `<img src="${el.value}" alt="this is the image something" />`; 
  }
  if(nodeName === "textarea") {
    return "<p>" + el.value + "</p>";
  }
}

// submit form
function submitForm(e) {
  const el = e.target;
  let htmlString = "";

  // loop through the elements and convert them one by one
  for(let i=0; i<el.length - 1; i++) {
    htmlString += convertHtmlToSupportedFormats(el[i]);
  }

  // const clean = DOMPurify.sanitize(el.innerHTML);
  const turnDownService = new TurndownService();
  const markedDownString = turnDownService.turndown(htmlString);
  console.log(markedDownString);

  e.preventDefault();
}

defineProps({
  showAddModal: Function
})
</script>
