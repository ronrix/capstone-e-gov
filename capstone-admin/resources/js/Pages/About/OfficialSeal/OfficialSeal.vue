<template>
  <WrapperContent>

    <h1 class="font-bold text-xl text-center mb-3 text-gray-800 uppercase">PHOTOGRAPHS AND SYMBOLISMS OF<span
        class="block">COMPONENT OF PILILLA LOGO</span></h1>

    <div class="w-full flex flex-col">
      <div class="w-[500px] h-[420px] bg-white rounded-lg pt-0 pb-10 self-center relative">
        <img class="w-[500px]" src="https://pilillarizal.gov.ph/wp-content/uploads/2022/12/logo-symbolism-0_1_orig.jpg"
          alt="">
        <button
          class="w-full md:w-[100px] lg:w-[55px] absolute bottom-0 right-0 justify-center mb-2 mt-20 bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs uppercase">Edit</button>
      </div>
    </div>


    <!-- color representation table  -->

    <div class="w-full flex flex-row  gap-5  justify-center mt-20">

      <div class="table-1 mb-10">
        <h2 class="text-xl text-center font-bold p-2 text-white bg-red-600 col-span-2">Color Representation</h2>
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th>Color</th>
              <th>Description</th>
            </tr>
          </thead>

          <RowSeal v-for="(seal, index) in rowseal" :seal="seal" />
        </table>
      </div>

      <!-- symbol presentation table -->

      <div class="table-2 mb-10">
        <h2 class="text-xl text-center font-bold p-2 text-white bg-red-600 col-span-2">Symbol Presentation</h2>
        <table class="table-auto w-full">
          <thead>
            <tr>
              <th>Symbol</th>
              <th>Description</th>
            </tr>
          </thead>

          <RowSymbol v-for="(seal1, index) in rowseal1" :seal1="seal1" />
        </table>
      </div>
    </div>

    <!-- logo contennt -->
    <div class="grid grid-cols-2 gap-5 mt-10 bg-white rounded-lg p-10">
     <cardSeal v-for="(first, index) in card" :first="first" />

      <!-- araw content -->

    </div>

    <div class="grid grid-cols-2 gap-5 mt-3 bg-white rounded-lg p-10">
      <!-- araw content -->
      <cardAraw v-for="(second, index) in two" :second="second" />
    </div>
  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import RowSeal from './RowSeal.vue'
import RowSymbol from './RowSymbol.vue';
import cardSeal from './cardSeal.vue';
import cardAraw from './cardAraw.vue';

const rowseal = [
  {
    color: "BLUE",
    description: "It represents the abundance of water resources and the Productivity of Pililla as a town. It is dependent upon livelihood and natural resources.",
  },
  {
    color: "RED",
    description: "Entails active involvement in community transformation and Development towards global competitiveness.",
  },
  {
    color: "GREEN",
    description: "Implies the protection and preservation of environment as a  key factor for achieving quality life of the residents through sustainable, massive campaign in crops and animal production.",
  },
  {
    color: "YELLOW",
    description: "Indicates zealousness.",
  },
  {
    color: "SKY BLUE",
    description: "Symbolizes peace and unity.",
  }
]

const rowseal1 = [
  {
    symbol: "Holy sacrament",
    description1: "represents that he residents of Pililla are pro-God and pro-people as the first core value.",
  },
  {
    symbol: "Gable and balance scale",
    description1: "symbolizes dynamic leadership in Governance and fiscal reforms by being just.",
  },
  {
    symbol: "Sun and three stars",
    description1: "indicate zealousness, integrity and Ingenuity towards quality of life.",
  },
  {
    symbol: "Palay, Carabao, Fish and Chicken",
    description1: "symbolize agriculture and industries.",
  },
  {
    symbol: "Torch, Book and Caduceus",
    description1: "represents education and health",
  },
  {
    symbol: "Hands",
    description1: "entails peace and prosperity can attained Through collaborative efforts.",
  },
  {
    symbol: "Shield",
    description1: "derived from provincial seal of Rizal where the municipality belongs.",
  },
  {
    symbol: "1583",
    description1: "the year that Pililla was founded as an independent Municipality",
  },
]

const card = [
  {
    logo: "Logo",
    better:"BETTER PILILLA",
    subText: "“BETTER PILILLA” the home of 54 MW Windfarm – our tagline which anchors our governance that leads to the fulfillment of all its Strategic Goals – massive tax campaign, health, special and educational services, human development through skills and development training, increased economic opportunities through business-friendly policies, and infrastructure development which result in attaining the DILG-Seal of Good Local Governance (SGLG) in one year of its first term of public service. (source: LGPMS Profile",
    imgSrc: "https://pilillarizal.gov.ph/wp-content/uploads/2022/09/BetterPilillaLogo-1016x400-1-768x302.png"
  }
]

const two = [
  {
    blue: "Logo",
    araw:"ARAW NG PILILLA",
    text: "Ang hugis ng logo na animo araw ay sumisimbulo sa panahon ng tag-init o panahon ng pag-aani kung kailan din ipinagdiriwang ang Araw ng Pililla. Ito ay ginawang makulay na sumasagisag sa ating pagiging likas na masayahin. Ito ay napapalibutan ng siyam na hugis ng tao na nag mistulang sinag na kumakatawan sa siyam na nagkakaisang Barangay at mga mamamayan nito. Ang logo ay makikitaan din ng mga simbulong sumasagisag sa mga lugar at produktong tanyag sa Bayan ng Pililla.",
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
}</style>