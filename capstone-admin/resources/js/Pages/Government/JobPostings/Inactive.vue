<template>
<div class="mt-5">

    <!-- search filter -->
    <SearchInput class="mb-5" @searchFn="searchFn" />

    <!-- top section -->
    <section class="flex items-center">
      <h4 class="text-2xl font-bold">{{ sample_data.length }} Inactive Jobs</h4>

      <!-- sort by -->
      <label class="text-sm ml-5">
        <span class="text-gray-500 font-bold">
          Sort by:
        </span>
        <select class="bg-transparent font-bold">
          <option value="">Creation Date</option>
          <option value=""> Job Title</option>
          <option value="">Full-time</option>
          <option value="">Part-time</option>
        </select>
      </label>

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

const sample_data = [
  {
    category: "Design",
    titlePosition: "Senior Product Designer",
    totalCandidates: 100,
    location: "BGC Taguig City",
    description: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis rem tempora velit beatae aperiam eum exercitationem id eaque voluptates a! Voluptatum quam in eos minima ducimus et veniam nemo maxime!",
    workType: ["Full time"],
  },
  {
    category: "Developer",
    titlePosition: "Jr Software Developer",
    totalCandidates: 200,
    location: "BGC Taguig City",
    description: "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nobis rem tempora velit beatae aperiam eum exercitationem id eaque voluptates a! Voluptatum quam in eos minima ducimus et veniam nemo maxime!",
    workType: ["Full time", "Hybrid", ],
  }
]

const filteredData = ref(searchFilter(""));
function searchFilter(value) {
  const first_option = sample_data.filter(data => {
    return data.titlePosition.toLowerCase().includes(value.toLowerCase());
  });

  const second_option = sample_data.filter(data => {
    return data.description.toLowerCase().includes(value.toLowerCase());
  });

  if(first_option.length) {
    return first_option;
  }
  return second_option;
}

function searchFn(value) {
  filteredData.value = searchFilter(value);
}

</script>