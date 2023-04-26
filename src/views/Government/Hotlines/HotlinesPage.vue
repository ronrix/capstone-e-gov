<script setup>
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import { useHotlineStore } from '../../../stores/hotlines-store'
import { onMounted, ref } from 'vue'

const store = useHotlineStore()
const hotlines = ref()

onMounted(() => {
  if (store.getHotlines()) {
    hotlines.value = store.getHotlines()
  } else {
    hotlines.value = JSON.parse(localStorage.getItem('hotlines'))
  }
})
</script>

<template>
  <!-- add tab title -->
  <head>
    <title>Emergency Hotlines | Pililla Rizal</title>
  </head>

  <HeaderSection />
  <!-- content -->
  <WrapperContainer class="mt-10">
    <h3 class="font-bold text-2xl mb-2 text-dark dark:text-bggray">Emergency Hotlines</h3>
    <p class="mb-5 text-secondary dark:text-bggray">
      To use the emergency hotlines, simply dial the appropriate number and provide the necessary
      information to the operator. Make sure to stay calm and provide as much information as
      possible to help emergency responders quickly assess the situation and provide the necessary
      assistance.
    </p>
    <ul class="w-full border text-dark dark:text-bggray">
      <li class="flex font-bold">
        <p class="border border-y-0 flex-1 p-2">Department</p>
        <p class="border border-y-0 flex-1 p-2">Smart</p>
        <p class="border border-y-0 flex-1 p-2">Globe</p>
        <p class="border border-y-0 flex-1 p-2">Landline</p>
      </li>
      <li v-for="n in hotlines" :key="n.id" class="flex">
        <p class="border flex-1 p-2 capitalize">{{ n.department }}</p>
        <p class="border flex-1 p-2">{{ n.smart }}</p>
        <p class="border flex-1 p-2">{{ n.globe }}</p>
        <p class="border flex-1 p-2">{{ n.landline }}</p>
      </li>
    </ul>
  </WrapperContainer>

  <FooterSection />
</template>