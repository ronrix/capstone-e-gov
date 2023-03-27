<template>
  <WrapperContent class="flex flex-col gap-5">

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">
        <SearchInput placeholder="search" class="mr-2 w-auto" @searchFn="searchFn"/>
      <SelectTag type="category" value="All" :filterFn="filterBy" :filterArray="filterTourism" />
    </div>
    <!-- <div v-for="group in sorteditems" :key="group.category" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5">{{ group.category }}</span>
        <div class="flex-1 border"></div>
      </div>
    </div> -->

    <div v-for="data in filteredData" class="relative bg-white p-5 flex flex-col md:flex-row border border-r-0 border-y-0 border-l-[5px] border-l-blue-600 overflow-hidden shadow-md">
      <Delete :handleDelete="handleDelete" :id="data.id"  />
      <!-- image -->
      <div class="flex-1 flex flex-col gap-3 items-start justify-between ">
          <div class="img-hover-zoom h-[300px] w-full">
          <img class="h-[300px] max-h-[400px] w-full lg:w-[max]" :src="data?.img"></div>
        <div class="flex">
          <i style="margin-top: 2px;" class="ml-2 uil uil-location-point text-cyan-400"></i>
          <p class="text-ellipsis overflow-hidden pt-1" style="font-size: 12px;">{{ data.address }}</p>
        </div>
    </div>
      <!-- content -->
      <div class="flex-1 p-5 flex flex-col items-start justify-between">
        <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.placeName }}</h3>
        <p class="text-ellipsis text-sm h-[100px] overflow-hidden">
          {{ data.content }}
        </p>
        <!-- PreviewButton -->
        <button @click="showTouristSpotPreviewModal(data)"
          class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-20 uppercase md:rounded ">edit</button>
      </div>
    </div>

    <!-- PreviewModal -->
    <TouristSpotPreviewModal :selectedData="selectedData" :showTouristSpotPreviewModal="showTouristSpotPreviewModal"
      v-if="isTouristSpotPreviewModal" />

    <!-- Add new tourist Button -->
    <button @click="showAddNewModal"
      class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text-2xl text-white"></i>
    </button>

    <!-- Add Modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
  </WrapperContent>
</template>
<script setup>
import { computed, ref, onUpdated } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import TouristSpotPreviewModal from '../../Components/TouristSpotPreviewModal.vue'
import SelectTag from '../../Components/SelectTag.vue';
import Delete from '../../Components/Delete.vue';
const isTouristSpotPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();

const sample_data = [{
  placeName: "Pililla Wind Farm",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1",
  address: "Pililla Windmills - 54 MW Pililla Windfarm - Sitio Bugarin, Pililla Rizal",
  category: "Tourist Atraction"
},
{
  placeName: "Lyger Animal Sanctuary - ZOO",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-4.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_ohc=NAJUjJ_CHgMAX8f-Pic&_nc_ht=scontent.fmnl9-4.fna&oh=00_AfCW92uReO1yw3-pumvUz3Wt0aPHd-e8JKnXvcS-UjsO1Q&oe=64254620",
  address: "Matagbak Rd. 1910 Pililla, Philippines",
  category: "Tourist Attraction"
},
{
  placeName: "Mt. Sembrano",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg",
  address: "99R6+574, Malaya Trail, Pililla, Riza",
  category: "Tourist Attraction"
},
{
  placeName: "St. Mary Magdalene Church",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Church"
},
{
  placeName: "Bahay na Bato",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Tourist Spot"
},
{
  placeName: "Bulawan Floating Restaurant",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/9060Bulawan_Floating_Restaurant_46.jpg/800px-9060Bulawan_Floating_Restaurant_46.jpg?20190506074310",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  placeName: "BALANGA RESTAURANT",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://img.restaurantguru.com/r40e-BALANGA-RESTAURANT-PILILLA-RIZAL-exterior.jpg",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  placeName: "Al Fresko Grill and Resto Bar",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-3.fna.fbcdn.net/v/t39.30808-6/278602678_885094395670809_7410699348354667593_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=Tj3NESKNnR0AX8colhq&_nc_ht=scontent.fmnl9-3.fna&oh=00_AfBlosFVr7dW9w4lorNC95NSX2wHNLyXAATCPXNEzpqOaQ&oe=6425D954",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  placeName: "Villa Lorenza Resort",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-1.fna.fbcdn.net/v/t39.30808-6/334953929_231838572541594_3452519380656648569_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeFmvU50yMUx-Q9UbNgvY0kvnwFC5kvFV9-fAULmS8VX33JTAL2B0Af4SOVnc3WgRE6wGjamVu--LKLY87hZ-NR1&_nc_ohc=YGcCVs22oK0AX-TqprU&_nc_ht=scontent.fmnl9-1.fna&oh=00_AfCefBSG6EEepD3JCADalg5_T5PwarEzH80qlg9iPkAnTA&oe=6424F32E",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Resorts"
},
{
  placeName: "Stagira Farms & Resort",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-1.fna.fbcdn.net/v/t39.30808-6/274794166_494175622105227_7071963731837566068_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeH9WWSMXnJ745HxZ2u5rny02OCruIoSoJvY4Ku4ihKgmyLMsX59dIdMqtoC-Dp2mWz0Ehz5oaeUF6724izrvosM&_nc_ohc=RxCzGtjR16gAX-s0y-Y&_nc_ht=scontent.fmnl9-1.fna&oh=00_AfAnyNiNzKZxgKBc61GqcuyaoEacjLVSOel42FdHOINXTQ&oe=642597C1",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Resorts"
},
]
const filterTourism = ['All', 'Tourist Attraction', 'Church', 'Restaurant']
// search Bar//
const filteredData = ref(searchFilter(""));
function searchFilter(value) {
  const first_option = sample_data.filter(data => {
    return data.placeName.toLowerCase().includes(value.toLowerCase());
  });

  const second_option = sample_data.filter(data => {
    return data.address.toLowerCase().includes(value.toLowerCase());
  });

  if (first_option.length) {
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
  if (isTouristSpotPreviewModal.value || isTouristSpotPreviewModal.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});

// const sorteditems = sample_data.reduce((groups, item) => {
//   const category = item.category;
//   if (!groups[category]) {
//     groups[category] = [];
//   }
//   groups[category].push(item);
//   return groups;
// }, {});

// Object.keys(sorteditems).sort().forEach((item) => {
//   sorteditems[key] = sorteditems[key].sort((a, b) => a.category.localeCompare(b.category));
// });

</script>
<style scoped>
.img-hover-zoom {
  overflow: hidden; 
}

.img-hover-zoom img {
  transition: transform .5s ease;
}
.img-hover-zoom:hover img {
  transform: scale(1.5);

}

</style>