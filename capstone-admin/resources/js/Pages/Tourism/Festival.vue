<template>
  <HeadTitle title="Festval"></HeadTitle>
  <WrapperContent class="flex flex-col gap-5">

        <!-- search filter -->
        <SearchInput class="mb-5" @searchFn="searchFn" />

    <div v-for="data in filteredData" class="flex flex-col md:flex-row items-start shadow-lg bg-white rounded-lg">
      
    <!-- image -->
    <div class="flex-1 flex flex-col gap-3 items-start justify-between">
    <div :style="{ backgroundImage: `url(${data.img})` }" class="bg-no-repeat  bg-center h-[250px] mt-2 ml-2 md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm"> </div>
    <div class="flex">
    <i style="margin-top: 2px;" class="ml-2 uil uil-location-point text-cyan-400"></i>
    <p class="text-ellipsis overflow-hidden pt-1" style="font-size: 12px;">{{ data.address }}</p>
    </div>
    </div>
    <!-- content -->
    <div class="flex-1 p-5 flex flex-col items-start justify-between">
      <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.placeName }}</h3>
      <p class="mt-5 text-ellipsis text-sm h-[100px] overflow-hidden">
        {{ data.content }}
      </p>
      <!-- PreviewButton -->
      <button @click="showTouristSpotPreviewModal(data)" class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-20 uppercase">view </button>
    </div>
  </div>
  
  <!-- PreviewModal -->
  <TouristSpotPreviewModal :selectedData="selectedData" :showTouristSpotPreviewModal="showTouristSpotPreviewModal" v-if="isTouristSpotPreviewModal" />
  
  <!-- Add new tourist Button -->
  <button @click="showAddNewModal" class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text-2xl text-white"></i>
    </button>
    
    <!-- Add Modal -->
  <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
</WrapperContent>
</template>
<script setup>
import { ref, onUpdated } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import TouristSpotPreviewModal from '../../Components/TouristSpotPreviewModal.vue'
const isTouristSpotPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();



        const sample_data = [{
              placeName:"Magsolangtan Festival",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://cdn.dribbble.com/users/2089694/screenshots/15254872/media/72cb5ad92a61d36de040a5a7433a2e07.png?compress=1&resize=700x525&vertical=top",
              address: "M.A. Roxas St.Brgy. Bagumbayan Pililla, Rizal, Pililla, Philippines"
            },
      {
              placeName:"Kal'baw Festival",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://cdn.dribbble.com/users/2089694/screenshots/15254872/media/72cb5ad92a61d36de040a5a7433a2e07.png?compress=1&resize=700x525&vertical=top",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            },
      {
              placeName:"Festival",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://cdn.dribbble.com/users/2089694/screenshots/15254872/media/72cb5ad92a61d36de040a5a7433a2e07.png?compress=1&resize=700x525&vertical=top",
              address: "99R6+574, Malaya Trail, Pililla, Riza"
            }]
                    const filteredData = ref(searchFilter(""));
        function searchFilter(value) {
          const first_option = sample_data.filter(data => {
            return data.placeName.toLowerCase().includes(value.toLowerCase());
          });

          const second_option = sample_data.filter(data => {
            return data.address.toLowerCase().includes(value.toLowerCase());
          });

          if(first_option.length) {
            return first_option;
          }
          return second_option;
        }
        function showAddNewModal() {
          isAddNewModal.value = !isAddNewModal.value;
        }
        function searchFn(value) {
          filteredData.value = searchFilter(value);
        }
              defineProps({
          showTouristSpotPreviewModal: Function,
          data: Object
        });

        function showTouristSpotPreviewModal(data) {
          isTouristSpotPreviewModal.value = !isTouristSpotPreviewModal.value;
          selectedData.value = data;
          
        }
        onUpdated(() => {
          if(isTouristSpotPreviewModal.value || isTouristSpotPreviewModal.value) {
            document.body.classList.add('overflow-hidden');
          }
          else {
            document.body.classList.remove('overflow-hidden');
          }
        });

  </script>