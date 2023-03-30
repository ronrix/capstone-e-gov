<template>
  <WrapperContent class="flex flex-col gap-5">

    <!-- search filter -->
    <div class="w-full flex flex-col md:flex-row md:items-center">
        <SearchInput placeholder="search" class="mr-2 w-auto" @searchFn="searchFn"/>
      <SelectTag type="category" value="All" :filter="filterArray" :filterArray="filterTourism" />
    </div>

    <div v-for="(group, category) in groupedItems" :key="category" class="flex flex-col gap-3 mt-5">
      <div class="flex items-center">
        <span class="font-bold text-2xl text-gray-500 mr-5"><h3>{{ category }}</h3></span>
        <div class="flex-1 border"></div>
      </div>

    <!-- TouristSpotCard -->
    <TouristSpotCard  v-for="data in group" :data="data" :key="data.id" :showTouristSpotPreviewModal="showTouristSpotPreviewModal" />
    </div>
    <!-- PreviewModal -->
    <TouristSpotPreviewModal :selectedData="selectedData" :showTouristSpotPreviewModal="showTouristSpotPreviewModal"
      v-if="isTouristSpotPreviewModal" />
    <!-- add new -->
    <AddBtn :showAddModal="showAddNewModal" class="z-20" />
    <!-- Add Modal -->
    <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" />
  </WrapperContent>
</template>

<script setup>
import WrapperContent from '../../Components/WrapperContent.vue';
import { computed, ref, onUpdated } from 'vue';
import SearchInput from '../../Components/SearchInput.vue';
import AddModal from '../../Components/AddModal/AddModal.vue';
import TouristSpotPreviewModal from '../../Components/TouristSpotPreviewModal.vue'
import SelectTag from '../../Components/SelectTag.vue';
import TouristSpotCard from './TouristSpotCard.vue';
import AddBtn from '../../Components/AddModal/AddBtn.vue';
// import Delete from '../../Components/Delete.vue';
// import Carousel from '../../Components/Slides/Carousel.vue'
// import Slide from '../../Components/Slides/Slide.vue'
const isTouristSpotPreviewModal = ref(false);
const isAddNewModal = ref(false);
const selectedData = ref();


const sample_data = [{
  id: 1,
  img: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1",
  placeName: "Pililla Wind Farm",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  address: "Pililla Windmills - 54 MW Pililla Windfarm - Sitio Bugarin, Pililla Rizal",
  category: "Tourist Atraction"
},
{
  id: 2,
  placeName: "Lyger Animal Sanctuary - ZOO",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-4.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_ohc=NAJUjJ_CHgMAX8f-Pic&_nc_ht=scontent.fmnl9-4.fna&oh=00_AfCW92uReO1yw3-pumvUz3Wt0aPHd-e8JKnXvcS-UjsO1Q&oe=64254620",
  address: "Matagbak Rd. 1910 Pililla, Philippines",
  category: "Tourist Attraction"
},
{
  id: 3,
  placeName: "Mt. Sembrano",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg",
  address: "99R6+574, Malaya Trail, Pililla, Riza",
  category: "Tourist Attraction"
},
{
  id: 4,
  placeName: "St. Mary Magdalene Church",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Church"
},
{
  id: 5,
  placeName: "Bahay na Bato",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Tourist Spot"
},
{
  id: 6,
  placeName: "Bulawan Floating Restaurant",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e7/9060Bulawan_Floating_Restaurant_46.jpg/800px-9060Bulawan_Floating_Restaurant_46.jpg?20190506074310",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  id: 7,
  placeName: "BALANGA RESTAURANT",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://img.restaurantguru.com/r40e-BALANGA-RESTAURANT-PILILLA-RIZAL-exterior.jpg",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  id: 8,
  placeName: "Al Fresko Grill and Resto Bar",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-3.fna.fbcdn.net/v/t39.30808-6/278602678_885094395670809_7410699348354667593_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=8bfeb9&_nc_ohc=Tj3NESKNnR0AX8colhq&_nc_ht=scontent.fmnl9-3.fna&oh=00_AfBlosFVr7dW9w4lorNC95NSX2wHNLyXAATCPXNEzpqOaQ&oe=6425D954",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Restaurant"
},
{
  id: 9,
  placeName: "Villa Lorenza Resort",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-1.fna.fbcdn.net/v/t39.30808-6/334953929_231838572541594_3452519380656648569_n.jpg?_nc_cat=110&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeFmvU50yMUx-Q9UbNgvY0kvnwFC5kvFV9-fAULmS8VX33JTAL2B0Af4SOVnc3WgRE6wGjamVu--LKLY87hZ-NR1&_nc_ohc=YGcCVs22oK0AX-TqprU&_nc_ht=scontent.fmnl9-1.fna&oh=00_AfCefBSG6EEepD3JCADalg5_T5PwarEzH80qlg9iPkAnTA&oe=6424F32E",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Resorts"
},
{
  id: 10,
  placeName: "Stagira Farms & Resort",
  content: "Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
  img: "https://scontent.fmnl9-1.fna.fbcdn.net/v/t39.30808-6/274794166_494175622105227_7071963731837566068_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeH9WWSMXnJ745HxZ2u5rny02OCruIoSoJvY4Ku4ihKgmyLMsX59dIdMqtoC-Dp2mWz0Ehz5oaeUF6724izrvosM&_nc_ohc=RxCzGtjR16gAX-s0y-Y&_nc_ht=scontent.fmnl9-1.fna&oh=00_AfAnyNiNzKZxgKBc61GqcuyaoEacjLVSOel42FdHOINXTQ&oe=642597C1",
  address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
  category: "Resorts"
},
]

const filterTourism = ['All', 'Tourist Attraction', 'Church', 'Restaurant']


// search Bar//
// const filteredData = ref(searchFilter(""));
// function searchFilter(value) {
//   const first_option = sample_data.filter(data => {
//     return data.placeName.toLowerCase().includes(value.toLowerCase());
    
//   });

//   const second_option = sample_data.filter(data => {
//     return data.address.toLowerCase().includes(value.toLowerCase());
//   });

//   if (first_option.length) {
//     return first_option;
//   }
//   return second_option;
// }
// function showAddNewModal() {
//   isAddNewModal.value = !isAddNewModal.value;
// }
// function searchFn(value) {
//   filteredData.value = searchFilter(value);
// }
const filterArray = computed(() => {
  const all = sample_data.map(item => item.category);
  return ['All', ...new Set(all)];
});

const searchQuery = ref();

const groupedItems = computed(() => {
  const groups = {};
  for (const item of sample_data) {
    if (!groups[item.category]) {
      groups[item.category] = [];
    }
    groups[item.category].push(item);
  }
  return groups;
});

const Items = computed(() => {
  let result = sample_data;
  if (selectedCategory !== 'All' && selectedCategory !== 'All') {
    result = result.filter(item => item.category === selectedCategory);
  }
  if (searchQuery !== 'All') {
    result = result.filter(item => {
      return item.title.toLowerCase().includes(searchQuery.toLowerCase()) ||
        item.content.toLowerCase().includes(searchQuery.toLowerCase());
    });
  }
  return result;
});


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

// fetch the news data from backend




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