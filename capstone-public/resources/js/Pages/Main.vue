<template>
      <div>
        <!-- this will render other pages (news, job postings, etc) -->
        <RouterView />
      </div>
</template>

<script setup>
import { RouterView } from "vue-router";
</script>