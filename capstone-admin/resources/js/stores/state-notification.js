import { ref } from "vue";
import { defineStore } from "pinia";

export const useNotification = defineStore('notification', () => {
  // states
  let notifications = ref([]);

  // functions
  function appendNewNotification(notif) {
    notifications.value.unshift(notif);
  }

  function removeOne(id) {
    notifications.value = notifications.value.filter(not => not.id !== id);
  }

  return { notifications, appendNewNotification, removeOne };
});