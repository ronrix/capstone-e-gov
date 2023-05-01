<script setup>
defineProps({
  requirements: { type: Object, required: true }
})
</script>
<template>
  <table class="w-full border border-dark">
    <thead>
      <tr class="bg-secondary text-bggray text-xs sm:text-base">
        <td class="font-[600]e border border-dark dark:border-bggray p-2">Requirements</td>
        <td class="font-[600] border border-dark dark:border-bggray p-2">Where to get?</td>
      </tr>
    </thead>
    <tbody v-if="requirements">
      <tr
        v-for="(requirement, whereToGo, idx) in JSON.parse(requirements)"
        :key="idx"
        class="text-dark dark:text-bggray text-xs sm:text-base"
      >
        <td class="border border-dark dark:border-bggray p-2">{{ requirement }}</td>
        <td class="border border-dark dark:border-bggray p-2">{{ whereToGo }}</td>
      </tr>
    </tbody>
  </table>
</template>