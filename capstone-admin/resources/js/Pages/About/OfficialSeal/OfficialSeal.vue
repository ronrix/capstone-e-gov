<template>
  <HeadTitle title="Official Seals"></HeadTitle>
  <WrapperContent>

    <h1 class="font-bold text-xl text-center mb-5 lg:mb-3 text-gray-800 uppercase">PHOTOGRAPHS AND SYMBOLISMS OF<span
        class="block">COMPONENT OF PILILLA LOGO</span></h1>

    <div class="flex flex-col">
      <div class="w-[460px] md:w-[480px] lg:w-[500px] flex flex-col bg-white rounded-lg pt-0 self-center">
        <img class="w-[460px] md:w-[480px] lg:w-[500px]"
          src="https://pilillarizal.gov.ph/wp-content/uploads/2022/12/logo-symbolism-0_1_orig.jpg" alt="">

          <button @click="showInputFileSelection"
            class="px-3 py-2 mt-10 mb-0 md:mb-2 md:mr-2 font-bold text-xs border border-blue-500  text-white bg-blue-600 w-full md:w-[118px] rounded-lg  hover:bg-blue-500 self-end items-center">Change
            Image</button>
          <input ref="inputFile" @change="handleSelectFile" type="file" class="hidden" />
      </div>
    </div>



    <!-- color representation table  -->

    <div class="w-full flex flex-col md:flex-col lg:flex-row gap-5 justify-center mt-20">

      <div class="mb-10">
        <h2 class="text-sm md:text-md lg:text-xl text-center font-bold p-2 text-white bg-red-600 col-span-2">Color
          Representation</h2>
        <table class="w-full">
          <thead>
            <tr class="text-sm md:text-md lg:text-xl text-gray-700">
              <th>Color</th>
              <th>Description</th>
            </tr>
          </thead>

          <tbody>
            <Row v-for="color in color_representation" :data="color" />
          </tbody>
        </table>
      </div>

      <!-- symbol presentation table -->

      <div class="mb-10">
        <h2 class="text-sm lg:text-xl text-center font-bold p-2 text-white bg-red-600 col-span-2">Symbol Presentation</h2>
        <table class="table-auto w-full">
          <thead>
            <tr class="text-sm md:text-md lg:text-xl text-gray-700">
              <th>Symbol</th>
              <th>Description</th>
            </tr>
          </thead>

          <tbody>
            <Row v-for="symbol in symbol_representation" :data="symbol" />
          </tbody>
        </table>
      </div>

    </div>

    <!-- logo contennt -->
    <CardSeal v-for="(seal, index) in seals" :seal="seal" :index="index" />
  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import Row from './Row.vue'
import CardSeal from './CardSeal.vue';
import { ref } from 'vue'

const inputFile = ref(null);

function showInputFileSelection() {
  // will click the hidden input file to show the file selection
  inputFile.value.click();
}

const color_representation = [
  {
    title: "BLUE",
    description: "It represents the abundance of water resources and the Productivity of Pililla as a town. It is dependent upon livelihood and natural resources.",
  },
  {
    title: "RED",
    description: "Entails active involvement in community transformation and Development towards global competitiveness.",
  },
  {
    title: "GREEN",
    description: "Implies the protection and preservation of environment as a  key factor for achieving quality life of the residents through sustainable, massive campaign in crops and animal production.",
  },
  {
    title: "YELLOW",
    description: "Indicates zealousness.",
  },
  {
    title: "SKY BLUE",
    description: "Symbolizes peace and unity.",
  }
]

const symbol_representation = [
  {
    title: "Holy sacrament",
    description: "represents that he residents of Pililla are pro-God and pro-people as the first core value.",
  },
  {
    title: "Gable and balance scale",
    description: "symbolizes dynamic leadership in Governance and fiscal reforms by being just.",
  },
  {
    title: "Sun and three stars",
    description: "indicate zealousness, integrity and Ingenuity towards quality of life.",
  },
  {
    title: "Palay, Carabao, Fish and Chicken",
    description: "symbolize agriculture and industries.",
  },
  {
    title: "Torch, Book and Caduceus",
    description: "represents education and health",
  },
  {
    title: "Hands",
    description: "entails peace and prosperity can attained Through collaborative efforts.",
  },
  {
    title: "Shield",
    description: "derived from provincial seal of Rizal where the municipality belongs.",
  },
  {
    title: "1583",
    description: "the year that Pililla was founded as an independent Municipality",
  },
]

const seals = [
  {
    title: "BETTER PILILLA",
    subText: "“BETTER PILILLA” the home of 54 MW Windfarm – our tagline which anchors our governance that leads to the fulfillment of all its Strategic Goals – massive tax campaign, health, special and educational services, human development through skills and development training, increased economic opportunities through business-friendly policies, and infrastructure development which result in attaining the DILG-Seal of Good Local Governance (SGLG) in one year of its first term of public service. (source: LGPMS Profile",
    imgSrc: "https://pilillarizal.gov.ph/wp-content/uploads/2022/09/BetterPilillaLogo-1016x400-1-768x302.png"
  },
  {
    title: "ARAW NG PILILLA",
    subText: "Ang hugis ng logo na animo araw ay sumisimbulo sa panahon ng tag-init o panahon ng pag-aani kung kailan din ipinagdiriwang ang Araw ng Pililla. Ito ay ginawang makulay na sumasagisag sa ating pagiging likas na masayahin. Ito ay napapalibutan ng siyam na hugis ng tao na nag mistulang sinag na kumakatawan sa siyam na nagkakaisang Barangay at mga mamamayan nito. Ang logo ay makikitaan din ng mga simbulong sumasagisag sa mga lugar at produktong tanyag sa Bayan ng Pililla.",
    imgSrc: "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/araw-ng-pililla-logo-png.png"
  }
]
</script>

<style scoped>
table,
th,
td {
  border: 1px solid gray;
}

table {
  background-color: white;
}

td {
  padding: 0.7em
}

th {
  padding: 0.2em;
}
</style>