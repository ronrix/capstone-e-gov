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

  <!-- card -->
    <CardSeal v-for="(data, index) in seals" :data="data" :index="index"  :showPreviewModal="showPreviewModal"/>

    <PreviewModal :selectedData="selectedData" :showPreviewModal="showPreviewModal" v-if="isPreviewModal" />
        
        <!-- add new news btn -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />

<!-- add modal -->
<AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" :handleCreateSubmit="handleCreateSubmit" title="Headline" />

  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import CardSeal from './CardSeal.vue';
import AddModal from '../../../Components/AddModal/AddModal.vue';
import AddBtn from '../../../Components/AddModal/AddBtn.vue';
import PreviewModal from '../../../Components/PreviewModal.vue';
import { ref } from 'vue'

// select file
const inputFile = ref(null);

function showInputFileSelection() {
  // will click the hidden input file to show the file selection
  inputFile.value.click();
}

// preview modal
const isPreviewModal = ref(false)
const selectedData = ref()
function showPreviewModal(data) {
  isPreviewModal.value = !isPreviewModal.value;
  selectedData.value = data;
}

// AddModal

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
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
    description: "“BETTER PILILLA” the home of 54 MW Windfarm – our tagline which anchors our governance that leads to the fulfillment of all its Strategic Goals – massive tax campaign, health, special and educational services, human development through skills and development training, increased economic opportunities through business-friendly policies, and infrastructure development which result in attaining the DILG-Seal of Good Local Governance (SGLG) in one year of its first term of public service. (source: LGPMS Profile",
    img_link: "https://pilillarizal.gov.ph/wp-content/uploads/2022/09/BetterPilillaLogo-1016x400-1-768x302.png"
  },
  {
    title: "ARAW NG PILILLA",
    description: "Ang hugis ng logo na animo araw ay sumisimbulo sa panahon ng tag-init o panahon ng pag-aani kung kailan din ipinagdiriwang ang Araw ng Pililla. Ito ay ginawang makulay na sumasagisag sa ating pagiging likas na masayahin. Ito ay napapalibutan ng siyam na hugis ng tao na nag mistulang sinag na kumakatawan sa siyam na nagkakaisang Barangay at mga mamamayan nito. Ang logo ay makikitaan din ng mga simbulong sumasagisag sa mga lugar at produktong tanyag sa Bayan ng Pililla.",
    img_link: "https://pilillarizal.gov.ph/wp-content/uploads/2022/12/araw-ng-pililla-logo-png.png"
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