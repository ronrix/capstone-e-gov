<template>
  <div class="h-[30px] flex justify-between items-center relative" :class="!isBlur ? 'bg-white' : ''">
    <!-- for blurry effect on scroll down -->
    <div v-if="isBlur" class="bg-blur"></div>
    <!-- response message -->
    <Notifcation :msg="resMsg" class="z-[1000]" />

    <!-- change password modal -->
    <ChangePasswordModal v-if="isShowChangePassword" :close-modal="showChangePasswordModal"
      :handle-change-password="handleChangePassword" />

    <Navs :showChildSubNavs="showChildSubNavs" :isChildSubNavs="isChildSubNavs" :showSubNavs="showSubNavs"
      v-if="isMobileNavsVisible" :isWholeSidebar="true" :page="page" :show-create-service="showCreateService"
      :service-types="serviceTypes"
      class="w-screen fixed top-0 left-0 right-0 bottom-0 z-80 h-screen bg-white text-black overflow-y-scroll sm:hidden" />
    <div class="flex flex-col items-start sm:pt-0">
      <div class="m-0 p-0 sm:hidden">
        <i :class="{ 'block': !isMobileNavsVisible, 'hidden': isMobileNavsVisible }" @click="showMovileNavs"
          class="uil uil-list-ui-alt text-gray-800 sm:hidden hover:text-blue-800 text-4xl"></i>
        <i :class="{ '!block': isMobileNavsVisible }" @click="showMovileNavs"
          class="hidden uil uil-times text-gray-800 sm:hidden hover:text-blue-800 text-4xl"></i>
      </div>
      <h3 class="font-bold text-sm hidden sm:block"> you are in <span class="text-blue-600">{{ currentRoute }}</span></h3>
    </div>

    <div class="flex items-end md:items-center justify-center">
      <!-- avatar -->
      <div @click="showAvatarDropDown" class="relative cursor-pointer flex items-center">
        <div class="w-[30px] h-[30px] rounded-full bg-primary-dark flex items-center justify-center overflow-hidden">
          <img class="object-cover w-3/4" src="/images/admin-logo.png" alt="">
        </div>
        <i class="uil uil-angle-down text-gray-700 text-2xl"></i>
        <!-- dropdown when avatar was clicked -->
        <div v-show="isAvatarDropDown"
          class="absolute -bottom-[60px] -left-[120px] text-xs bg-white flex flex-col w-[150px] p-2 shadow-md after:absolute after:right-3 after:-top-[5px] after:w-3 after:h-3 after:rotate-45 after:border after:border-b-0 after:border-r-0 after:bg-white gap-1 z-30">
          <p @click="showChangePasswordModal" class="hover:text-blue-600">Change password</p>
          <Link href="/logout" class="hover:text-blue-600">Log out</Link>
        </div>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onUpdated, onMounted, onUnmounted } from 'vue';
import Navs from './Sidebar/Navs.vue';
import { Link } from "@inertiajs/inertia-vue3";
import ChangePasswordModal from './ChangePasswordModal.vue';
import axios from 'axios';
import { be_url } from '../config/config';
import Notifcation from './Notifcation.vue';

const isBlur = ref(false);
const isMobileNavsVisible = ref(false);
const isAvatarDropDown = ref(false);
const isShowChangePassword = ref(false);
const resMsg = ref();

function showAvatarDropDown() {
  isAvatarDropDown.value = !isAvatarDropDown.value;
}

function showChangePasswordModal() {
  isShowChangePassword.value = !isShowChangePassword.value;
}

function showMovileNavs() {
  isMobileNavsVisible.value = !isMobileNavsVisible.value;
}

// request to change the user password
async function handleChangePassword(formData) {
  return await axios.post(be_url + "/change-password", {
    old_password: formData.oldPassword,
    password: formData.newPassword,
    password_confirmation: formData.confirmPassword,
  })
    .then(({ data }) => {
      // set the response msg
      resMsg.value = data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      return data;
    })
    .catch(err => {
      // set the response msg
      resMsg.value = err.response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

// function to add the blur to the topbar on scroll
function scrollFn(e) {
  if (this.scrollY === 0) {
    isBlur.value = false;
    return;
  }
  isBlur.value = true;
}

onMounted(() => {
  window.addEventListener("scroll", scrollFn);
});

onUnmounted(() => {
  document.removeEventListener("scroll", scrollFn);
})

onUpdated(() => {
  // prevent the document from scrolling if the mobile nav is visible
  if (isMobileNavsVisible.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});

defineProps({
  currentRoute: String,
  showSubNavs: Function,
  isChildSubNavs: Boolean,
  showChildSubNavs: Function,
  showCreateService: Function,
  serviceTypes: Object,
  page: String
})
</script>