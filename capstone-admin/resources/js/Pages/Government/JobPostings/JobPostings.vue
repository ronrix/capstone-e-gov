<template>
  <HeadTitle title="Job Opportunities"></HeadTitle>
  <WrapperContent>
    <div class="mt-5">
      <!-- response message -->
      <Notifcation :msg="resMsg" :isMounted="resMsg" class="z-[1000]" />

      <!-- search filter -->
      <SearchInput class="mb-5" @searchFn="searchFn" placeholder="search active jobs" />

      <!-- add new job modal -->
      <NewJobModal v-if="isShowAddModal" :closeModal="showAddModal" :handleCreate="handleCreate" />

      <!-- top section -->
      <div class="flex items-center justify-between">
        <h4 class="text-xl font-bold mb-3">Recommended jobs <span class="text-gray-400 ml-5">{{ originalData.length
        }}</span></h4>
        <button type="button" @click="showAddModal"
          class="active:-translate-y-1 rounded-md bg-blue-600 text-white  mt-3 outline-none font-bold text-sm self-end p-3">
          Add new job
        </button>
      </div>

      <!-- filter by -->
      <p class="text-gray-600 text-sm font-[500] capitalize">schedule</p>
      <div class="flex items-center flex-wrap gap-3 mb-8 sticky top-10 py-2 z-10">
        <div class="bg-blur"></div>
        <label v-for="(item, idx) in filterItems" :key="idx"
          class="font-[500] text-sm flex items-center gap-2 capitalize">
          <input type="checkbox" :name="'filter-' + idx" :value="item.trim()" v-model="checkedItems"
            class="h-5 w-5 text-blue-600 rounded">
          {{ item }}
        </label>
      </div>

      <!-- show more details - modal -->
      <JobPostingModal v-if="isShowModal" :selectedData="selectedData" :colors="colors" :closeModal="showModal"
        :handleUpdate="handleUpdate" />

      <!-- cards section -->
      <section class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2  mt-8">
        <JobPostingCard v-for="(job, idx) in data" :data="job" :key="idx" :showModal="showModal" :colors="colors"
          :handleDelete="handleDelete" />
      </section>

    </div>
  </WrapperContent>
</template>

<script setup>
import JobPostingCard from './JobPostingCard.vue';
import { ref, onMounted, watch } from "vue";
import SearchInput from '../../../Components/SearchInput.vue';
import axios from 'axios';

import { be_url } from '../../../config/config';
import JobPostingModal from './JobPostingModal.vue';
import Notifcation from '../../../Components/Notifcation.vue';
import NewJobModal from "./NewJobModal.vue";
import { colors } from '../../../config/jobBgColors';

const data = ref([]);
const originalData = ref([]);
const isShowModal = ref(false);
const selectedData = ref();
const resMsg = ref();
const isShowAddModal = ref(false);

onMounted(() => {
  axios.get(be_url + "/job-postings")
    .then((response) => {
      data.value = response.data.jobs;
      originalData.value = response.data.jobs
    })
    .catch(err => console.log(err));
});

// function to show the job posting modal
function showModal(data) {
  isShowModal.value = !isShowModal.value;
  selectedData.value = data;
}

// function to show the add new job modal
function showAddModal() {
  isShowAddModal.value = !isShowAddModal.value;
}

// filter states 
const filterItems = ["full time", "part time", "internship", "remote", "temporary", "fixed term", "contractual"];
const checkedItems = ref([]); // will populate this when checkbox is checked

// search filtering
function searchFilter(value) {
  // first option: will check the titlePosition match value
  const first_option = originalData.value.filter(d => {
    return d.job_title.toLowerCase().includes(value.toLowerCase());
  });

  // first option: will check the description match value
  const second_option = originalData.value.filter(d => {
    return d.job_description.toLowerCase().includes(value.toLowerCase());
  });

  // returning the data sorted by date
  if (first_option.length) {
    return first_option.sort((dateA, dateB) => new Date(dateB.created_at) - new Date(dateA.created_at));
  }
  return second_option.sort((dateA, dateB) => new Date(dateB.created_at) - new Date(dateA.created_at));
}

function searchFn(value) {
  data.value = searchFilter(value);
}

// watch the checkbox to filter the data
watch(checkedItems, () => {
  // if there is no data inside checkedItems, then display the originalData
  if (!checkedItems.value.length) {
    data.value = originalData.value;
    return;
  }

  // TODO: check all the data if checkItems.value has them, then we can display it to the DOM
  data.value = originalData.value.filter(d => {
    return checkedItems.value.find(item => d.job_schedule.includes(item));
  });
});

// function to update the job posting data
async function handleUpdate(formData) {
  return await axios.post(be_url + "/job-posting/edit",
    {
      id: formData.id,
      logo: formData.logo,
      job_title: formData.title,
      company_name: formData.companyName,
      author: formData.author,
      email: formData.email,
      job_description: formData.description,
      job_salary: formData.salary,
      job_location: formData.location,
      job_schedule: formData.schedule.join(", ")
    }, { headers: { "Content-Type": "multipart/form-data" } })
    .then((response) => {
      // set the response msg
      resMsg.value = response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      data.value = response.data.jobs;
      originalData.value = response.data.jobs
      return data;
    })
    .catch(err => console.log(err));
}

// function to delete a job posting
async function handleDelete(id) {
  return await axios.post(be_url + "/delete-job-posting", { id })
    .then((response) => {
      // set the response msg
      resMsg.value = response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      data.value = response.data.jobs;
      originalData.value = response.data.jobs
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

// function to create the job posting data
async function handleCreate(formData) {
  return await axios.post(be_url + "/job-posting/add",
    {
      logo: formData.logo,
      job_title: formData.job_title,
      company_name: formData.companyName,
      author: formData.author,
      email: formData.email,
      job_description: formData.job_description,
      job_salary: formData.job_salary,
      job_location: formData.job_location,
      job_schedule: formData.job_schedule.join(", ")
    }, { headers: { "Content-Type": "multipart/form-data" } })
    .then((response) => {

      // set the response msg
      resMsg.value = response.data.res;
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);

      data.value = response.data.jobs;
      originalData.value = response.data.jobs
      return response.data;
    })
    .catch(err => {
      console.log(err)
      // set the response msg
      resMsg.value = { msg: err.response.data.message, status: 400 };
      // hide the notification message in 3s
      setTimeout(() => {
        resMsg.value = null;
      }, 3000);
    });
}

</script>