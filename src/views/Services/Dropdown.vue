<script setup>
import DepartmentName from './DepartmentName.vue';
import DropdownServices from './DropdownServices.vue';
import ServicesName from './ServicesName.vue';

defineProps({
department : {type: Object, required: true }
})

function showServices(e) {
 document.querySelectorAll('.dropdown').forEach(el => {
    el.classList.add('hidden')
 })  
 e.target.nextElementSibling.classList.toggle('hidden')
}

</script>
<template>
  <div class="flex flex-col mx-32"  @click="showServices">
    <DepartmentName :name="department.name" />
  </div>

  <DropdownServices>
    <ServicesName v-for="service, id in department.services" :key="id" :service="service" />
  </DropdownServices>
</template>

<style lang="scss" scoped>
</style>