<template>
  <div class="border w-full md:w-auto rounded-lg shadow-md py-2 px-5">
    <!-- top -->
    <section class="flex items-start">
      <div class="border border-dotted px-2 rounded-lg mr-3" :class="borderColor === '#000' ? 'border-blue-600' : 'border-white'">
        <i class="fa-solid fa-users"></i>
      </div>
      <div>
        <h4 class="m-0 font-bold text-sm">{{ title }}</h4>
      </div>
    </section> 
    <!-- mid -->
    <div class="flex items-start mt-5">
      <h5 class="font-bold text-2xl mr-5">{{ amount }}</h5>
      <Line :data="data" :options="options" class="w-[50px] xs:w-[100px] md:w-[200px]" />
    </div>
  </div>
</template>

<script setup>
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
} from 'chart.js'
import { Line } from 'vue-chartjs'

const props =defineProps({
  title: String,
  borderColor: String,
  amount: Number
});

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  Title,
  Tooltip,
  Legend
)

const data = {
  labels: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
  datasets: [
    {
      labelColor: "#fff",
      backgroundColor: '#fff',
      borderWidth: 1,
      borderColor: props.borderColor,
      pointRadius: 1,
      fill: false,
      data: [50, 500, 720, 3049, 929],
    }
  ],
  
}

const options = {
  responsive: false,
  maintainAspectRatio: false,
  scales: {
    x: {
      ticks: {
        display: false
      },
      grid: {
        display: false
      }
    },
    y: {
      ticks: {
        display: false
      },
      grid: {
        display: false
      }
    }
  },
  plugins: {
    legend: {
      display: false
    }
  }
}

</script>

<style lang="scss" scoped>

</style>