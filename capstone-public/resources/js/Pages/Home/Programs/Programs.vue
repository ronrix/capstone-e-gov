<template>
    <div class="flex items-start gap-3 mt-5">
        <div>
            <h4 class="font-bold text-3xl text-darkgray">Programs & Services</h4>
            <p class="text-sm">Municipality of Pililla RIzal offering services and providing programs that helps citizens across the town.</p>
        </div>

        <!-- programs cards -->
        <div class="grid grid-cols-2 gap-2">
            <Card to="/scholarship" title="Scholarship Program" desc="Cash assistance to help students on their school financial problems." icon="uil uil-graduation-cap" additionalClass="bg-bgLightyBlue" />
            <Card to="/programs" title="Municipal Updates" desc="Cash assistance to help students on their school financial problems." icon="uil uil-arrow-circle-up" additionalClass="bg-bgReddy" />
            <Card to="/senior-assistance" title="Senior & PWD Assistance" desc="Assistance for our seniors and PWD." icon="uil uil-assistive-listening-systems" additionalClass="bg-bgGreeny" />
        </div>
    </div>
</template>
<script setup>
import Card from './Card.vue';

</script>