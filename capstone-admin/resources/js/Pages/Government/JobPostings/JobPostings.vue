<template>
  <HeadTitle title="Job Postings"></HeadTitle>
  <WrapperContent>
    <!-- nav for active and inactive jobs postings -->
    <nav class="border border-x-0 border-t-0 border-b-gray-300 font-bold text-sm py-5">
      <RouterLink active-class="text-blue-500" class="uppercase p-3" to="/government/job-postings/active">active jobs</RouterLink>
      <RouterLink active-class="text-blue-500" class="uppercase p-3" to="/government/job-postings/inactive">inactive jobs</RouterLink>
    </nav>

    <RouterView></RouterView> 
  </WrapperContent>
</template>

<script setup>
import { RouterLink, RouterView } from "vue-router"
</script>
