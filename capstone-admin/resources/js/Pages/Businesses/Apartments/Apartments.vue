<template>
  <WrapperContent>
    <!--Remember to add filter for both type and title-->

    <CardApartment v-for="data in searchFilter()" :data="data" :showApartmentModal="showApartmentModal" />
    <ApartmentModal :selectedData="selectedData" :showApartmentModal="showApartmentModal" v-if="isNewModal" />
    
    <button @click="showApartmentModal" class="rounded-full shadow-md p-4 bg-blue-600 flex items-center justify-center w-[50px] h-[50px] fixed bottom-5 right-5 hover:bg-blue-500">
      <i class="uil uil-plus text 2xl text-white"></i>
    </button>

    <AddModal :showAddModal="showApartmentModal" :isAddModal="isAddNewModal" v-if="isAssNewModal" />
    </WrapperContent>
  <!--
    <div>
    <h1 class="font-bold text-xl">Apartments</h1>
    <div class="flex flex-row md:flex-row">
      <div class="items-start flex-row p-3 border w-sm mx-auto hover:bg-white shadow-md overflow-hidden md:max-w-sm">
        <img classs="h-sm w-sm object-cover md:h-10 md:w-48" src="https://www.apartments.com/images/librariesprovider2/blank-images/parkline-apartment-in-miami-flba486679-f59b-475d-885a-ae52659d1e51.jpg?sfvrsn=264e5d72_1" alt="a creamy white theme house">
        <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">type of apartment</p>
        <h3>Apartment's name</h3>
        <p>Location</p>
      </div>
      <div class="items-start md:flex-row p-3 border w-sm mx-auto hover:bg-white shadow-md overflow-hidden md:max-w-sm">
        <img classs="h-sm w-sm object-cover md:h-10 md:w-48" src="https://images.ctfassets.net/pdf29us7flmy/30jdDV7ig6aoq8JR1G8NSP/02ba1881d2bdfcef85e3dc7c10ced839/-IND-001-017-_How_To_Create_a_Successful_Brand_Positioning_Strategy_Final__1_.jpg" alt="A person that is planning">
        <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">type of apartment</p>
        <h3>Apartment's name</h3>
        <p>Location</p>
      </div>
      <div class="p-3 border w-sm mx-auto hover:bg-white shadow-md overflow-hidden md:max-w-sm">
        <img classs="h-smcd w-sm object-cover md:h-10 md:w-48" src="https://images.ctfassets.net/pdf29us7flmy/30jdDV7ig6aoq8JR1G8NSP/02ba1881d2bdfcef85e3dc7c10ced839/-IND-001-017-_How_To_Create_a_Successful_Brand_Positioning_Strategy_Final__1_.jpg" alt="A person that is planning">
        <p class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">type of apartment</p>
        <h3>Apartment's name</h3>
        <p>Location</p>
      </div>
      
    </div>
  </div> 
  -->
</template>

<script setup>
import CardApartment from './CardApartment.vue';
import ApartmentModal from './ApartmentModal.vue';


import { ref, onUpdated } from 'vue';
import AddModal from '../../../Components/AddModal/AddModal.vue'
const isNewModal = ref(false)
const selectedData = ref();

const isAddNewModal = ref(false);
function showAddNewModal() {
  isAddNewModal.value = !isAddNewModal.value;
}
const sample_data = [
  {
    title:"Aparment #1",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img:"https://www.apartments.com/images/librariesprovider2/blank-images/parkline-apartment-in-miami-flba486679-f59b-475d-885a-ae52659d1e51.jpg?sfvrsn=264e5d72_1",
},
{
    title:"Aparment #2",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img:"https://images.ctfassets.net/pdf29us7flmy/30jdDV7ig6aoq8JR1G8NSP/02ba1881d2bdfcef85e3dc7c10ced839/-IND-001-017-_How_To_Create_a_Successful_Brand_Positioning_Strategy_Final__1_.jpg"
},
{
    title:"Aparment #3",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img:"https://www.apartments.com/images/librariesprovider2/blank-images/parkline-apartment-in-miami-flba486679-f59b-475d-885a-ae52659d1e51.jpg?sfvrsn=264e5d72_1",
},
{
    title:"Aparment #4",
    content: "Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta ipsam labore, laborum neque praesentium ullam eos quam eaque laboriosam expedita, ut dicta veritatis rerum molestiae, nemo quod accusantium repellendus corrupti?",
    img:"https://images.ctfassets.net/pdf29us7flmy/30jdDV7ig6aoq8JR1G8NSP/02ba1881d2bdfcef85e3dc7c10ced839/-IND-001-017-_How_To_Create_a_Successful_Brand_Positioning_Strategy_Final__1_.jpg"
},
];

function showApartmentModal(data){
  isNewModal.value = !isNewModal.value;
  selectedData.value = data;
}
// Should Add data filtering search input


onUpdated(() => {
  if(isNewModal.value || isNewModal.value) {
    document.body.classList.add('overflow-hidden');
  }
  else {
    document.body.classList.remove('overflow-hidden');
  }
});
</script>

<style scoped>

</style>