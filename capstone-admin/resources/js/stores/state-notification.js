import { ref } from "vue";
import { defineStore } from "pinia";

export const useNotification = defineStore('notification', () => {
  // states
  let notifications = ref([]);

  // functions
  function appendNewNotification(notif) {
    notifications.value.push(notif);
  }

  return { notifications, appendNewNotification };
});