<template>
  <div class="mt-5">

    <!-- search filter -->
    <SearchInput class="mb-5" @searchFn="searchFn" />

    <!-- top section -->
    <section class="flex items-center flex-col sm:flex-row">
      <h4 class="text-2xl font-bold">{{ sample_data.length }} Active Jobs</h4>

      <!-- sort by -->
      <SortBy :sortBy="sortBy" :sortFn="sortFn" :sortCategories="sortCategories" />
    </section>

    <!-- cards section -->
    <section class="flex items-start gap-2 flex-wrap mt-8">
      <JobPostingCard v-for="(data, idx) in filteredData" :data="data" :key="idx" />
    </section>
  </div>
</template>

<script setup>
import JobPostingCard from './JobPostingCard.vue';
import { ref } from 'vue';
import SearchInput from '../../../Components/SearchInput.vue';
import SortBy from './SortBy.vue';

const sample_data = [
  {
    category: "Design",
    titlePosition: "Senior Product Designer",
    totalCandidates: 100,
    location: "BGC Taguig City",
    description: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis rem tempora velit beatae aperiam eum exercitationem id eaque voluptates a! Voluptatum quam in eos minima ducimus et veniam nemo maxime!",
    workType: ["Part time"],
    date: "2023-01-01",
  },
  {
    category: "Developer",
    titlePosition: "Jr Software Developer",
    totalCandidates: 200,
    location: "BGC Taguig City",
    description: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis rem tempora velit beatae aperiam eum exercitationem id eaque voluptates a! Voluptatum quam in eos minima ducimus et veniam nemo maxime!",
    workType: ["Full time", "Hybrid", ],
    date: "2023-03-05",
  }
]

// sort jy filtering 
const sortBy = ref("creation date");
const sortCategories = [
  "creation date",
  "full time",
  "part time"
];

// search filtering
const filteredData = ref(searchFilter(""));
function searchFilter(value) {
  // first option: will check the titlePosition match value
  const first_option = sample_data.filter(data => {
    return data.titlePosition.toLowerCase().includes(value.toLowerCase());
  });

  // first option: will check the description match value
  const second_option = sample_data.filter(data => {
    return data.description.toLowerCase().includes(value.toLowerCase());
  });

  // returning the data sorted by date
  if(first_option.length) {
    return first_option.sort((dateA, dateB) => new Date(dateB.date) - new Date(dateA.date));
  }
  return second_option.sort((dateA, dateB) => new Date(dateB.date) - new Date(dateA.date));
}

function searchFn(value) {
  filteredData.value = searchFilter(value);
}

function sortFn(e) {
  sortBy.value = e.target.value;
  let sort = [];

  // sort by creation date from latest to oldest
  if(sortBy.value === "creation date")  {
    sort = sample_data.sort((dateA, dateB) => new Date(dateB.date) - new Date(dateA.date));
  }
  else {
    // sort by part time or full time
    sort = sample_data.filter(data => {
      const find = data.workType.some((val) => {
        return val.toLowerCase() === e.target.value.toLowerCase()
      });

      if(find) return data;
    });
  }

  filteredData.value = sort;
}


</script>