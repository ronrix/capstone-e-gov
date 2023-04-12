<template>
  <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-10">
    <div>
      <h4 class="font-bold text-2xl text-darkgray">
        Programs & Services
      </h4>
      <p class="text-sm">
        Municipality of Pililla RIzal offering services and providing programs that helps citizens across the town.
      </p>
    </div>

    <!-- programs cards -->
    <div class="grid grid-cols-2 gap-2">
      <Card
        to="/scholarship"
        title="Scholarship Program"
        desc="Cash assistance to help students on their school financial problems."
        icon="uil uil-graduation-cap"
        additional-class="bg-bgLightyBlue"
      />
      <Card
        to="/programs"
        title="Municipal Updates"
        desc="Cash assistance to help students on their school financial problems."
        icon="uil uil-arrow-circle-up"
        additional-class="bg-bgReddy"
      />
      <Card
        to="/senior-assistance"
        title="Senior & PWD Assistance"
        desc="Assistance for our seniors and PWD."
        icon="uil uil-assistive-listening-systems"
        additional-class="bg-bgGreeny"
      />
    </div>
  </div>
</template>
<script setup>
import Card from './Card.vue';

</script>