<script setup>
import { ref, onMounted } from 'vue'
import Dropdown from './Dropdown.vue'

const departments = ref(null)
onMounted(() => {
  departments.value = JSON.parse(localStorage.getItem('services'))
})
</script>

<template>
  <div class="flex items-center justify-center sm:mb-5 mt-44 md:mt-52 p-2 h-[100px]">
    <h1 class="text-center text-2xl lg:text-4xl mb-0 font-bold text-dark dark:text-white">
      What we can offer in <span class="block">every department.</span>
    </h1>
  </div>
  <!-- departments with services -->
  <WrapperContainer>
    <h3 v-if="!departments" class="text-2xl text-dark dark:text-bggray text-center">
      No services yet!
    </h3>
    <div v-else>
      <h2 class="text-xl md:text-2xl font-semibold text-dark dark:text-white mb-2">Departments</h2>
      <!-- <div v-for="(dep, key) in departments" :key="key">
        <span>{{ key }}</span>
        <div v-for="d in dep" :key="d">{{ d }}</div>
      </div> -->
      <Dropdown
        v-for="(department, key) in departments"
        :key="key"
        :key-name="key"
        :department="department"
      />
    </div>
  </WrapperContainer>
</template>



<style lang="scss" scoped>
</style>