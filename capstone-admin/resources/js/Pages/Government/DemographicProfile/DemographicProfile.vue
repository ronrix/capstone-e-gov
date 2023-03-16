<template>
  <WrapperContent>
    <h4 class="font-bold text-xl">Demographic Profile</h4>

    <!-- hotlines table -->
    <div class="w-full flex flex-col">
      <!-- filter -->
      <SearchInput placeholder="search" class="my-5" />
      <div class="mb-5 flex items-center justify-between">
        <div>
          <span class="text-sm text-gray-700 font-bold mr-3">
            <i class="uil uil-filter"></i>
            Filter by
          </span>
          <select class="bg-white px-3 font-bold rounded-md w-auto">
            <option value="">current</option>
            <option value="">2017</option>
            <option value="">2012</option>
            <option value="">2009</option>
            <option value="">2004</option>
          </select>
        </div>

        <!-- add new btn -->
        <button class="bg-blue-600 py-2 px-3 rounded-lg text-white font-bold capitalize">add census</button>
      </div>

      <table class="text-left w-full">
        <thead>
          <tr class="bg-neutral-200 text-xs md:text-sm">
            <th class="px-2 text-center"><i class="uil uil-list-ui-alt"></i></th>
            <th class="pl-2 py-2 text-neutral-600">
              Barangay
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Total Population
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
            <th class="pl-2 py-2 text-neutral-600">
              Number of Household
              <i @click="sortFn" class="uil uil-sorting cursor-pointer hover:text-blue-600 text-lg"></i>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(a, id) in filteredData" class="text-xs md:text-sm font-medium border">
            <td class="bg-white text-center">{{ id + 1 }}</td>
            <td class="bg-white border pl-2 border-l-0">
              <textarea v-model="a.barangay"
                class="focus:outline-blue-500 py-3 w-full overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx]">{{ a.barangay }}</textarea>
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <textarea v-model="a.totalPoulation"
                class="focus:outline-blue-500 py-3 w-full overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx]">{{ a.totalPopulation }}</textarea>
            </td>
            <td class="bg-white border pl-2 border-l-0">
              <textarea v-model="a.household"
                class="focus:outline-blue-500 py-3 w-full overflow-scroll no-scrollbar m-0 text-sm h-[40px] max-h-[40ppx]">{{ a.household }}</textarea>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </WrapperContent>
</template>

<script setup>
import SearchInput from '../../../Components/SearchInput.vue';

const filteredData = [
  {
    barangay: "Bagumbayan",
    totalPoulation: "9,406",
    household: "1,678"
  },
  {
    barangay: "Halayhayin",
    totalPoulation: "7,759",
    household: "1,389"
  },
  {
    barangay: "Hulo",
    totalPoulation: "9,740",
    household: "1,733"
  },
  {
    barangay: "Imatong",
    totalPoulation: "962",
    household: "154"
  },
  {
    barangay: "Malaya",
    totalPoulation: "7,721",
    household: "1,486"
  },
  {
    barangay: "Niogan",
    totalPoulation: "4,627",
    household: "882"
  },
  {
    barangay: "Quisao",
    totalPoulation: "13,284",
    household: "2,387"
  },
  {
    barangay: "Takungan",
    totalPoulation: "1,643",
    household: "252"
  },
  {
    barangay: "Wawa",
    totalPoulation: "4,385",
    household: "860"
  },
]
</script>