<template>
  <HeadTitle title="Contacts"></HeadTitle>
  <WrapperContent>
    <!-- response message -->
    <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

    <!-- delete verfication modal -->
    <DeleteVerificationModal v-if="isVerificationModal" :closeModal="showDeleteVerificiationModal" :id="contactId" :handleDelete="handleDeleteContact" />

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
        <div v-for="con in contacts" class="mt-5">
          <div class="flex items-center">
            <h3 class="text-xs md:text-lg font-bold text-gray-700 mr-5 uppercase">{{ con.contact_type }}</h3>
            <div class="flex-1 border-2"></div>

            <!-- delete btn -->
            <button @click="showDeleteVerificiationModal(con.id)" type="button"
              class="bg-red-300 text-red-500 text-xs rounded-lg px-3 hover:bg-red-400 hover:text-red-200 cursor-pointer ml-2">
              delete</button>
          </div>

          <DepartmentContacts v-for="(numbers, keyName) in JSON.parse(con?.contact_details)" :keyName="keyName" :id="con.id"
            :nums="numbers" :handleUpdateContactNumber="handleUpdateContactAndSocMed" />
        </div>
      </div>
      <ContacsModal v-if="isContactsModal" :showContactsModal="showContactsModal" :handleCreateNewContact="handleCreateNewContact" />
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

        <div v-for="soc in socMedias">
          <SocialMediaLinks v-for="(links, keyName) in JSON.parse(soc?.contact_details)" :links="links" :keyName="keyName" :id="soc.id" :handleUpdateSocMed="handleUpdateContactAndSocMed" />
        </div>
      </div>
      <SocialMediaModal v-if="isSocialMediaModal" :showSocialMediaModal="showSocialMediaModal" :handleCreateNewSocialLinks="handleCreateNewSocialLinks" />
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
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { be_url } from '../../../config/config';
import Notifcation from '../../../Components/Notifcation.vue';
import DeleteVerificationModal from '../../../Components/DeleteVerificationModal.vue';

const isContactsModal = ref(false);
function showContactsModal() {
  isContactsModal.value = !isContactsModal.value;
}

const isVerificationModal = ref(false);
const contactId = ref();
// function to show the delete verfication modal
function showDeleteVerificiationModal(id) {
  isVerificationModal.value = !isVerificationModal.value; 
  contactId.value = id;
}

const isSocialMediaModal = ref(false);
function showSocialMediaModal() {
  isSocialMediaModal.value = !isSocialMediaModal.value;
}

const contacts = ref([]);
const socMedias = ref([]);
const resMsg = ref();

// function to update the contact number
function handleUpdateContactAndSocMed(e, id, keyName, arrId) {
  axios.post(be_url + "/contacts/edit", {
    id, 
    keyName,
    arrId,
    newValue: e.target.value 
  })
  .then(({data}) => {
    // get the contacts
    contacts.value = data.contacts.filter(el => el.contact_type !== "social media links");
    // get the soc media
    socMedias.value = JSON.parse(data.contacts.filter(el => el.contact_type === "social media links")[0].contact_details);
  })
  .catch(err => console.log(err));
}

// function to create new contact info
async function handleCreateNewContact(formData) {
  return await axios.post(be_url + "/contacts/add", {
    department: formData.department,
    mobile_nums: formData.mobile_nums,
    telephone_nums: formData.telephone_nums,
  })
  .then(({data}) => {

     // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    contacts.value = data.contacts.filter(el => el.contact_type !== "social media links");
    return data;
  })
  .catch(err => console.log(err));
}

// function to create new contact info
async function handleCreateNewSocialLinks(formData) {
  return await axios.post(be_url + "/socmed/add", {
    id: socMedias.value[0].id,
    platform: formData.platform,
    links: formData.links,
  })
  .then(({data}) => {

     // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    socMedias.value = data.contacts.filter(el => el.contact_type === "social media links");
    return data;
  })
  .catch(err => console.log(err));
}

// function to delete department contact
async function handleDeleteContact(id, deleteRef) {
  return await axios.post(be_url + "/contact/delete", { id })
  .then(({data}) => {
     // set the response msg
    resMsg.value = data.res;
    // hide the notification message in 3s
    setTimeout(() => {
      resMsg.value = null;
    }, 3000);

    contacts.value = data.contacts.filter(el => el.contact_type !== "social media links");
    isVerificationModal.value = false;
    return data;
  })
  .catch(err => console.log(err));
}

// get all the data from the server
onMounted(() => {
  axios.get(be_url + "/contacts")
    .then(({ data }) => {
      // get the contacts
      contacts.value = data.contacts.filter(el => el.contact_type !== "social media links");
      // get the soc media
      socMedias.value = data.contacts.filter(el => el.contact_type === "social media links");
    })
    .catch(err => console.log(err));
});

</script>