<script setup>
defineProps({
  data: { type: Object, required: true },
  idx: { type: Number, required: true }
})
</script>

<template>
  <tr :class="{ 'bg-blue-50 text-blue-500': idx % 2 === 0, 'bg-gray-200 text-gray-600': idx % 2 !== 0 }">
    <td class="font-bold">{{ data?.year }}</td>
    <td>{{ data?.desc }}</td>
  </tr>
</template>

<style scoped>
td {
  padding: 1em 2em;
  text-align: left;
}
</style>