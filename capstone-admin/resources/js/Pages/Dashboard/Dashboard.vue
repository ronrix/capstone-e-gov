<template>
  <HeadTitle title="Dashboard"></HeadTitle>
  <!-- response message -->
  <Notifcation :msg="resMsg" class="z-[1000]" />

  <!-- this is the display requests modal where the form requests is going to display -->
  <DisplayRequestModal
    v-if="isDisplayRequestModal"
    :close-modal="closeDisplayRequestModal"
    :selected-data="selectedData"
    :decline-request="declineRequest"
    :accept-request="acceptRequest"
  />

  <div class="container mx-auto flex mt-2 flex-col md:flex-row">
    <!-- left -->
    <section class="bg-white flex-1 p-3 flex flex-col gap-10">
      <div>
        <h2 class="text-xl font-[500]">Welcome back, Admin!</h2>
        <h5 class="text-sm text-gray-600">
          Today is <span class="font-bold">{{ dateFormat(new Date()) }}</span>
        </h5>
      </div>

      <div
        class="flex-1 flex flex-col justify-evenly bg-gradient-to-r from-sky-500 to-indigo-500 text-white px-3"
      >
        <p class="text-slate-100 tracking-wide text-xs uppercase">
          qoute of the day
        </p>
        <h4 class="text-2xl font-[500]">"{{ qoute.text }}"</h4>
        <h5 class="text-sm text-slate-100">
          <i class="uil uil-angle-right"></i> {{ qoute.author }}
        </h5>
      </div>

      <!-- navigations -->
      <div class="p-3 bg-gray-900 text-white">
        <h5 class="text-sm font-[500] mb-3">Shortcut navigations</h5>
        <div class="flex flex-wrap">
          <RouterLink
            to="/government/news"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >News</RouterLink
          >
          <RouterLink
            to="/government/programs-anad-events"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Programs & Events</RouterLink
          >
          <RouterLink
            to="/government/job-opportunities"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Job Opportunities
          </RouterLink>
          <RouterLink
            to="/government/full-disclosure-reports"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Full disclosure reports</RouterLink
          >
          <RouterLink
            to="/government/hotlines"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Hotlines
          </RouterLink>
          <RouterLink
            to="/government/demographic-profile"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Demographic profile
          </RouterLink>
          <RouterLink
            to="/tourism/tourist-spots"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Tourist Attractions</RouterLink
          >
          <RouterLink
            to="/tourism/festivals"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Festivals
          </RouterLink>
          <RouterLink
            to="/government/business-establishment"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Business establishments</RouterLink
          >
          <RouterLink
            to="/businesses/apartments"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Apartments
          </RouterLink>
          <RouterLink
            to="/businesses/bplo"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >BPLO
          </RouterLink>
          <RouterLink
            to="/about/official-seal"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Official seal
          </RouterLink>
          <RouterLink
            to="/about/contacts"
            class="border border-slate-100 px-3 py-1 hover:bg-slate-100 hover:text-gray-800"
            >Contacts
          </RouterLink>
        </div>
      </div>
    </section>

    <!-- right -->
    <section class="flex-1 p-3">
      <div class="flex items-center justify-between mb-3">
        <h4 class="text-sm font-[500]">All Requests</h4>
      </div>
      <h5 v-if="!notifications.length" class="flex items-center gap-2">
        <i class="uil uil-folder-times"></i>
        No requests
      </h5>
      <div
        v-else
        class="overflow-y-auto max-h-[500px] h-[500px] flex flex-col gap-3 scrollbar"
      >
        <NotificationCard
          :show-display-request-modal="showDisplayRequestModal"
          v-for="notif in notifications"
          :key="notif.id"
          :notif="notif"
        />
      </div>
    </section>
  </div>
</template>

<script setup>
import { dateFormat } from "../../utils/dateFormat";
import { ref, onMounted } from "vue";
import NotificationCard from "./NotificationCard.vue";
import DisplayRequestModal from "../../Components/DisplayRequestModal.vue";
import { useNotification } from "../../stores/state-notification";
import axios from "axios";
import { be_url } from "../../config/config";
import Echo from "laravel-echo";
import Notifcation from "../../Components/Notifcation.vue";

const store = useNotification();
const selectedData = ref(null);
const qoute = ref({ text: "Time is gold", author: "Cecilia Ahern" });
const resMsg = ref();

// declining the post request of the public
// will delete the notification from the table
async function declineRequest(id) {
  await axios
    .get(be_url + "/post-request/decline/" + id)
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      notifications.value = data.notifications.sort(
        (a, b) => a.created_at < b.created_at
      );
      store.removeOne(id);
      return;
    })
    .catch((err) => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
      return;
    });
}

// accepting the request will add all the form data to the specific request
// if job posting, the form data that client sent will be stored in the db
async function acceptRequest(id) {
  return await axios
    .get("/post-request/accept/" + id)
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      notifications.value = data.notifications.sort(
        (a, b) => a.created_at < b.created_at
      );
      store.removeOne(id);
      return;
    })
    .catch((err) => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
      return;
    });
}

const isDisplayRequestModal = ref(false);
// fetch a request to update the status of the notification from false to true
// we'll be using that status column to put a style on the notification card
function showDisplayRequestModal(data) {
  isDisplayRequestModal.value = !isDisplayRequestModal.value;
  selectedData.value = data;

  // only send a request if status is true, otherwise we just skip the axios request
  if (selectedData.value.status) {
    axios
      .get(be_url + "/notify-status/" + data.id)
      .then(({ data }) => {
        notifications.value = data.notifications.sort(
          (a, b) => a.created_at < b.created_at
        );
      })
      .catch((err) => console.log(err));
  }
}

function closeDisplayRequestModal() {
  isDisplayRequestModal.value = false;
  selectedData.value = null;
}

// Use a computed property that depends on the store notifications value
const notifications = ref([]);

onMounted(() => {
  // listen for broadcasting event
  window.Echo.channel("notification").listen("PostRequestNotification", (e) => {
    store.appendNewNotification(e.notification);
    notifications.value.unshift(e.notification);
  });

  // initial request for all the notifications
  axios
    .get(be_url + "/notifications")
    .then(({ data }) => {
      notifications.value = data.notifications.sort(
        (a, b) => a.created_at < b.created_at
      );
    })
    .catch((err) => console.log(err));

  // .sort((a, b) => a.created_at < b.created_at);
  // fetch request to get a qoutes and display it to dashboard
  // only show one qoute per day
  // check if time is 12:00 am
  axios
    .get("https://type.fit/api/quotes")
    .then(({ data }) => {
      const randIdx = Math.floor(Math.random() * data.length);
      qoute.value = data[randIdx];
    })
    .catch((err) => console.log(err));
});
</script>