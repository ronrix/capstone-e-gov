<template>
    <HeadTitle title="Ease of Doing Business"></HeadTitle>
    <WrapperContent>

        <!--businesses -->
        <h4 class=" text-xl lg:text-2xl font-bold text-gray-800 my-5">Businesses</h4>
        <!-- filter -->

        <div class="w-full flex flex-col md:flex-row md:items-center">
            <SearchInput placeholder="search" class="mr-2 w-auto" @searchFn="searchFn" />
            <SelectTag type="category" value="All" :filterFn="filterBy" :filterArray="filterBusiness" />
        </div>
        <!-- card businesses -->
        <CardBusiness  v-for="(data, index) in business" :data="data" />

    </WrapperContent>
</template>
  
<script setup>
import WrapperContent from '../../../Components/WrapperContent.vue';
import CardBusiness from './CardBusiness.vue';
import SelectTag from '../../../Components/SelectTag.vue';
import SearchInput from '../../../Components/SearchInput.vue';



// filter selecTag
const filterBusiness = ["All", "Restaurant", "Departnemnt Store", "Gast Station", "Pharmacy", "Bank"];
const business = [
    {
        title: "Bulawan Floating Restaurant",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        imgSrc: "https://3.bp.blogspot.com/-DO8GFOij0pA/WZhuUvHzanI/AAAAAAAAAd0/ZX_zREEA0O86R3UYiZLGOHR3gawDqR8ewCPcBGAYYCw/s400/DSC_0165.jpg"
    },
    {
        title: "7-Eleven",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        imgSrc: "https://images.summitmedia-digital.com/esquiremagph/images/2021/04/19/shutterstock_1404051692%20(1).jpg"
    },
    {
        title: "Generika Pililla, Rizal",
        description: "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.",
        imgSrc: "https://fab.ph/wp-content/uploads/2019/03/8cSDwpg0d9YbVTRxUqrM1.png"
    }
]



</script>
  
<style scoped></style>