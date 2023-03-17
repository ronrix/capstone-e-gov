<template>
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
              placeName:"Pililla Wind Farm",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1",
              address: "Pililla Windmills - 54 MW Pililla Windfarm - Sitio Bugarin, Pililla Rizal"
            },
      {
              placeName:"Lyger Animal Sanctuary - ZOO",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?stp=dst-jpg_p480x480&_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=vZzU1pyI1gIAX-769R_&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfAimQATg8SzNiIGyE-4nRqoGtM7Iv-aEOfqIBbpgMCvcQ&oe=64157420",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            },
      {
              placeName:"Mt. Sembrano",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg",
              address: "99R6+574, Malaya Trail, Pililla, Riza"
            },
      {
              placeName:"St. Mary Magdalene Church",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650",
              address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal"
            },
            {
              placeName:"Bahay na Bato",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg",
              address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal"
            }]
            // search Bar//
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