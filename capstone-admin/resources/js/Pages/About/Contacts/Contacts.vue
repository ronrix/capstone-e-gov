<template>
  <HeadTitle title="Contacts"></HeadTitle>
  <WrapperContent>
    <!-- contacts -->
    <div class="flex justify-between mb-3">
      <h1 class="text-sm md:text-lg font-bold text-gray-700">Contacts</h1>
      <button @click="showContactsModal"
        class="border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end rounded-lg px-2 uppercase text-sm font-bold">
        new
        <i class="uil uil-plus-circle m-0 ml-1"></i>
      </button>
    </div>
    <div class="w-full flex flex-col mb-10">
      <div class="relative bg-white p-6">
        <div class="flex items-center">
          <h3 class="text-xs md:text-lg font-bold text-gray-700 mr-5 uppercase">HR Department</h3>
          <div class="flex-1 border-2"></div>
        </div>

        <DepartmentContacts v-for="contacts in contact" :title="contacts.title" :number="contacts.number" />
      </div>
      <ContacsModal v-if="isContactsModal" :showContactsModal="showContactsModal"/>
    </div>
    <!-- contacts ends-->

    <!-- social media links -->
    <div class="flex justify-between mb-3">
      <h1 class="text-sm md:text-lg font-bold text-gray-700">Social Media Links</h1>
      <button @click="showSocialMediaModal"
        class="border border-blue-600 text-blue-600 hover:bg-blue-500 hover:text-white self-end rounded-lg px-2 uppercase text-sm font-bold">
       new
        <i class="uil uil-plus-circle m-0 ml-1"></i>
      </button>
    </div>

    <div class="w-full flex flex-col mb-5">
      <div class="relative bg-white p-6">
        <div class="flex items-center mb-5">
          <h3 class="text-xs md:text-lg font-bold text-gray-700 mr-5 uppercase">Social Media</h3>
          <div class="flex-1 border-2"></div>
        </div>

        <SocialMediaLinks v-for="data in social" :links="data.link" :data="data" />
      </div>
      <SocialMediaModal v-if="isSocialMediaModal" :showSocialMediaModal="showSocialMediaModal"/>
    </div>
    <!-- social media links ends-->
  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import DepartmentContacts from './DepartmentContacts.vue';
import SocialMediaLinks from './SocialMediaLinks.vue';
import ContacsModal from './ContacsModal.vue';
import SocialMediaModal from './SocialMediaModal.vue';
import { ref } from 'vue';

const isContactsModal = ref(false);
function showContactsModal() {
  isContactsModal.value = ! isContactsModal.value;
}

const isSocialMediaModal = ref(false);
function showSocialMediaModal() {
  isSocialMediaModal.value = ! isSocialMediaModal.value;
}

const contact = [{
  title: "Mobile Number",
  number: "+639-234-554-678"
},
{
  title: "Telephone Number",
  number: "(555) 555-1234"
}
]

const social = [{
  img_link: "https://cdn-icons-png.flaticon.com/512/124/124010.png",
  link: "https://www.facebook.com/BetterPililla"
},
{
  img_link: "https://cdn-icons-png.flaticon.com/512/281/281769.png",
  link: "@yahoo.com"
},
{
  img_link: "https://www.clipartmax.com/png/full/35-351265_twitter-png-png-images-twitter-round-logo-png-transparent-background.png",
  link: "https://"
}
]
</script>

<style scoped>
th,
td {
  border: 1px solid rgb(170, 166, 166);
  padding: 1em;
}
</style>