<script setup>
import { onMounted } from "vue";
import { RouterView } from 'vue-router';
import axios from "axios";

onMounted(() => {
  // if not token stored in the LS it will request for one
  if (!localStorage.getItem("token")) {
    axios.get('http://localhost:8000/csrf-token', { withCredentials: true })
      .then(response => {
        // Store the token in localStorage or Vuex state
        localStorage.setItem('token', response.data.token);
      })
      .catch(error => {
        console.error(error);
      });
  }
});

</script>
<template>
  <RouterView />
</template>
