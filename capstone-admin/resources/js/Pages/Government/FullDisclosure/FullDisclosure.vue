<template>
  <WrapperContent>
    <h3 class="font-bold text-xl mb-5">Full Disclosure Reports</h3>
    
    <!-- report files -->
    <div v-for="data in sample_data" class="mb-5 bg-white rounded-lg">
      <h4 class="font-bold capitalize mb-3 p-3">
        <i class="uil uil-usd-circle text-md"></i>
        {{ data.reportName }}
      </h4>
      <div v-for="file in data.files" class="border border-x-0 border-b-0 border-t-2 border-t-slate-100 py-2 px-3 text-sm text-gray-800 my-2 flex items-center justify-between">
        <span>{{ file }}</span>
        <a href="#" class="text-blue-600">download</a>
      </div>
    </div>

  </WrapperContent>
</template>

<script setup>
import SearchInput from '../../../Components/SearchInput.vue';

const sample_data = [
  {
    reportName: "Annual Report",
    files: [
      "2019 Annual Reports",
      "2020 Annual Reports",
      "2021 Annual Reports",
      "2022 Annual Reports",
      "2023 Annual Reports",
    ]
  },
  {
    reportName: "Statement of Debt Service",
    files: [
      "2019 Debt Service ",
      "2020 Debt Service ",
      "2021 Debt Service ",
      "2023 Debt Service ",
      "2024 Debt Service ",
    ]
  },
]
</script>