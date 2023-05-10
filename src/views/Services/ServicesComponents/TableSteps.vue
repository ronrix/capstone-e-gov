<script setup>
defineProps({
  processes: { type: String, required: true }
})
</script>
<template>
  <h4 class="text-xl md:text-2xl font-bold text-dark dark:text-bggray mt-14">
    What's the process?
  </h4>
  <table class="border table-auto mt-2 mb-10 w-full">
    <thead>
      <tr class="text-sm sm:text-base text-left text-bggray font-semibold bg-secondary">
        <th>Client Steps</th>
        <th>Agency Steps</th>
        <th>Fees to Paid</th>
        <th>Processing Time</th>
        <th>Person Responsible</th>
      </tr>
    </thead>
    <tbody v-if="processes" class="text-dark dark:text-white">
      <tr v-for="(process, idx) in JSON.parse(processes)" :key="idx" class="text-sm sm:text-base">
        <td>{{ process.client_steps }}</td>
        <td>{{ process.agency_steps }}</td>
        <td>{{ process.fees }}</td>
        <td>{{ process.process_time }}</td>
        <td>{{ process.person_responsible }}</td>
      </tr>
    </tbody>
    <!-- <div class="absolute w-[320px] h-[320px] bg-[#B92B27] -top-16 -left-32 opacity-10  rounded-full"></div> -->
  </table>
</template>
<style scoped>
td,
th {
  border: 1px solid;
}

th {
  padding: 5px;
}

td {
  padding: 10px;
  text-align: left;
}
</style>
