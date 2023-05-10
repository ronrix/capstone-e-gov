<script setup>
import DepartmentName from './DepartmentName.vue'
import DropdownServices from './DropdownServices.vue'
import ServicesName from './ServicesName.vue'

defineProps({
  department: { type: Array, required: true },
  keyName: { type: String, required: true }
})

function showServices(e) {
  document.querySelectorAll('.dropdown').forEach((el) => {
    if (e.target.nextElementSibling === el) {
      return
    }
    el.classList.add('hidden')
  })
  e.target.nextElementSibling.classList.toggle('hidden')
}
</script>
<template>
  <div class="flex flex-col cursor-pointer" @click="showServices">
    <DepartmentName :name="keyName" />
  </div>

  <DropdownServices>
    <ServicesName v-for="(service, id) in department" :key="id" :service="service" />
  </DropdownServices>
</template>

<style lang="scss" scoped>
</style>