<template>

  <!-- 
    html belongs here 
    lahat ng tags like h1, h2, p, div, table, ul, li, a, and etc sa loob ng <template> ilalagay 

    common used tags
      "div" is a wrapper or taga combine ng lahat ng related elements. para madali matarget for styling.
      "p" for paragraph, used for long texts
      "h1" for biggest text, use this only once. dapat sa isang html file isang h1 lang.
      "h2" same as h1 pero smaller ito at one time lang din siya pede gamitin. Treat it like a subtitle. Kung may title may subtitle
      "h3" - "h6" can be used multiple times and smaller than h1 and h2. (di masyadong gamit)
      "ul" and "ol" for listing.

    see below
  -->

  <!-- first div -->
  <div>
    <!-- 
      To access the variable inside the <script> tag use this {{ variableName }}
    -->
    <h1 class="">{{ title }}</h1>
    <h2>{{ subtitle }}</h2>

    <!-- 
      this is an example of using an event handler

      and binding class variable
      use ":class" instead of "class"
      ":class" para mailagay natin yung variable sa class
    -->
    <button :class="classVariable" @click="clickMe">click me</button>
  </div>

  <!-- another div na may related elements -->
  <div>
    <!-- h3 with class is an example of using tailwind css -->
    <h3 class="font-bold mb-2 uppercase">{{ propTitle }}</h3>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Voluptatum officia expedita possimus. Architecto vero modi consequatur molestias porro, magni, quasi dolorum mollitia cumque, nostrum similique labore impedit. Consequuntur, nisi neque.</p>
  </div>

</template>

<!-- javascript scripts -->
<script setup>

/*
  VARIABLES

  const  - constant. meaning hindi siya ma iinitialize ulit or di mababago yung value  
  let  - changeable. meaning pede iinitialize ulit para change yung value ng variable

  see below;
 */
 const title = "This is the title";
 // title = "new title" // this will cause an error

 let subtitle = "This is the subtitle";
 subtitle = "New subtitle"; 

  // pede din ilagay sa class itong variable
  const classVariable = "bg-blue-400 px-5 py-2 mt-5";

/*
  FUNCTION

  itong function maraming uses. for dynamic programming ito para ma-prevent yung code duplication.
  One use is for events.
  reference: https://www.w3schools.com/js/js_events.asp

  see below;
*/  
function clickMe() {
  alert("Hello, world");
}

/*
  PROPS

  ito yung variable na pinapass sa isang component.
  examle: <Component title="This is a prop variable" />

  ginagamit ito pag merong variable sa parent component na dapat irerender sa child compmonent ito ang ginagmit.
  since yung value ng prop variable ay pede mabago sa iba't ibang page.

  ex. yung component pede ilagay sa dashboard, tourism, businesess, etc. kada initialize mo dun pede mo ibahin yung value ng prop
  
  dashboard: <Component title="this is dashboard"
  tourism: <Component title="this is tourism"
  services: <Component title="this is services"

  para ma-access yung prop variable, gagamit tayo ng "defineProps()" syntax
  see below;
*/ 
defineProps({
  propTitle: String
});

</script>

<!-- pure css styles and tailwind equivalence -->
<style scoped>

div {
/* 
  "mt" means margin top
  "mb" means margin bottom
  "ml" means margin left
  "mr" means margin right
  "m" means targetting all sides
  "mx" means left and right
  "my" means top and bottom

  mt-[1em] or mt-4 

  reference: https://tailwindcss.com/docs/margin
*/
  margin-top: 1rem; 
/* 
  bg-[color]-[opacity]

  bg-brown-400 

  reference links: https://tailwindcss.com/docs/background-color
*/
  background-color: brown; 
/* 
  text-[color]-[opacity]

  for white and black there is no opacity

  text-white

  reference: https://tailwindcss.com/docs/text-color
*/
  color: white; 
/* 
  "pt" means padding top
  "pb" means padding bottom
  "pl" means padding left
  "pr" means padding right
  "p" means targetting all sides
  "px" means left and right
  "py" means top and bottom

  p-[1em] or p-4 

  reference: https://tailwindcss.com/docs/padding 
*/
  padding: 1em; 
}

h1 {
/* 
  text-xs
  text-sm
  text-base - normal
  text-md
  text-lg
  text-xl
  text-2xl - text-9xl
  text-[value in px | em | rem | etc]

  reference: https://tailwindcss.com/docs/font-size
*/
  font-size: 2rem; 
 /* 
  font-thin
  font-extralight
  font-light
  font-normal
  font-medium

  reference: https://tailwindcss.com/docs/font-weight 
 */
  font-weight: bold
}

h2 {
  font-size: 1em; 
  font-weight: bold
}

/* 
  LEARN MORE

  learn CSS: https://www.w3schools.com/css/default.asp

  flex: https://css-tricks.com/snippets/css/a-guide-to-flexbox/
  transitions: https://www.w3schools.com/css/css3_transitions.asp

  TAILWIND Responsive Design
  responsive design: https://tailwindcss.com/docs/responsive-design
*/


</style>