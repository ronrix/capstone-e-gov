<script setup>
defineProps({
    data: {type: Object, required: true},
    idx: {type: Number, required: true}
})
</script>

<template>
  <!-- table body 1 -->
  <tbody class="text-sm md:text-normal">
    <tr :class="{'bg-gray-200 text-gray-700': idx % 2 === 0, 'bg-gray-50 text-blue-400': idx % 2 !== 0}">
      <td>{{ data?.name }}</td>
      <td class="font-light">{{ data?.desc }}</td>
    </tr>
  </tbody>
</template>


<style  scoped>
td {
  padding: 1em 2em;
}
</style>