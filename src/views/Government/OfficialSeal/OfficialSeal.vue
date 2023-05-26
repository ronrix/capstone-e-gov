<script setup>
import HeaderSection from '../../../components/Header/HeaderSection.vue'
import FooterSection from '../../../components/FooterSection/FooterSection.vue'
import TablesRows from './TablesRows.vue'
import CardOfficialSeal from './CardOfficialSeal.vue'
import { fetchData } from '../../../utils/axios-instance'
import { onMounted, onUnmounted } from 'vue'
import { ref } from 'vue'
import Loading from '../../../components/Loading.vue'
import { be_url } from '../../../assets/config/config'

const seal = ref([])
const loading = ref(true)
const axiosCall = () => {
  fetchData('/official-seal')
    .then((data) => {
      seal.value = data.official_seal[0]
      loading.value = false
    })
    .catch((err) => {
      console.log(err)
    })
}

onMounted(() => {
  // scroll on top when this component rendered
  window.scrollTo(0, 0)

  // add tab title
  document.title = 'Official Seal | Pililla Rizal'

  axiosCall()
})
onUnmounted(() => {
  // add tab title
  document.title = 'Municipality of Pililla Rizal'
})

const colors = [
  {
    name: 'BLUE',
    desc: 'It represents the abundance of water resources and the Productivity of Pililla as a town. It is dependent upon livelihood and natural resources.'
  },
  {
    name: 'RED',
    desc: 'Entails active involvement in community transformation and Development towards global competitiveness.'
  },
  {
    name: 'GREEN',
    desc: 'Implies the protection and preservation of environment as a  key factor for achieving quality life of the residents through sustainable, massive campaign in crops and animal production.'
  },
  {
    name: 'YELLOW',
    desc: 'Indicates zealousness.'
  },
  {
    name: 'SKY BLUE',
    desc: 'Symbolizes peace and unity.'
  }
]

const symbols = [
  {
    name: 'Holy sacrament',
    desc: 'represents that he residents of Pililla are pro-God and pro-people as the first core value.'
  },
  {
    name: 'Gable and balance scaled',
    desc: 'symbolizes dynamic leadership in Governance and fiscal reforms by being just.'
  },
  {
    name: 'Sun and three stars',
    desc: 'symbolize agriculture and industries.'
  },
  {
    name: 'Torch, Book and Caduceus',
    desc: 'represents education and health'
  },
  {
    name: 'Hands',
    desc: 'entails peace and prosperity can attained Through collaborative efforts.'
  },
  {
    name: 'Shield',
    desc: 'derived from provincial seal of Rizal where the municipality belongs.'
  },
  {
    name: '1583',
    desc: 'the year that Pililla was founded as an independent Municipality'
  }
]
</script>

<template>
  <HeaderSection />
  <WrapperContainer>
    <div class="w-full flex flex-col mt-10 mb-10">
      <h1
        class="self-center text-center text-xl sm:text-2xl lg:text-3xl text-primary dark:text-primarylight font-bold mb-5 lg:mb-10 uppercase"
      >
        photographs and symbolism of <span class="block">component of pililla logo</span>
      </h1>
      <img
        v-if="seal?.symbol_logo_img_link"
        class="self-center xs:w-full sm:w-[500px] md:w-[600px] h-300 md:h-[390px] lg:h-[400px] rounded-md"
        :src="be_url + '/' + seal?.symbol_logo_img_link"
        alt="symbolism of component of pililla rizal logo"
      />
      <!-- tables -->
      <div class="flex flex-col md:flex-row gap-5 mt-20 mx-2 md:mx-5 lg:mx-24">
        <div class="flex-1">
          <h2 class="text-center font-bold bg-primary text-white text-sm md:text-lg p-2">
            Color Representation
          </h2>
          <table class="table-auto">
            <thead class="text-sm md:text-lg text-gray-700">
              <tr>
                <th class="bg-blue-100 font-bold">Color</th>
                <th class="bg-blue-50 font-bold">Description</th>
              </tr>
            </thead>
            <!-- table body 1 -->
            <TablesRows v-for="(data, idx) in colors" :key="idx" :idx="idx" :data="data" />
          </table>
        </div>

        <div class="flex-1">
          <h2 class="text-center font-bold bg-primary text-white text-lg p-2">
            Symbol Representation
          </h2>
          <table class="table-auto">
            <thead class="text-sm md:text-lg text-gray-700">
              <tr>
                <th class="bg-blue-100 font-bold">Symbol</th>
                <th class="bg-blue-50 font-bold">Description</th>
              </tr>
            </thead>
            <!-- table body 2 -->
            <TablesRows v-for="(data, idx) in symbols" :key="idx" :idx="idx" :data="data" />
          </table>
        </div>
      </div>
    </div>

    <Loading v-if="loading" class="w-10 h-10 mx-auto" />
    <div v-else>
      <CardOfficialSeal
        v-for="(data, idx) in JSON.parse(seal?.logo)"
        :key="idx"
        :idx="idx"
        :data="data"
      />
    </div>
  </WrapperContainer>
  <FooterSection />
</template>

<style scoped>
th {
  padding: 0.5em 2em;
}
</style>