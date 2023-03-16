<!-- <template> 
  <div>

    
    </div>

<div class="">
<div class="mt-20 bg-cyan-200 border shadow-md" >
    <div >
        <img style=" width: 300px;" class="mt-6 ml-5 mr-0" src="https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1">

        <div class="mb-5 ml-5 mt-2 text-xs mr-0" style="width: 250px;">Pililla Windmills - 54 MW Pililla Windfarm 
            - Sitio Bugarin, Pililla Rizal</div>
    </div>
        <div class="first-letter:mt-5 ">
            <h1 class="font-bold ml-10">Pililla Wind Farm</h1>
        
            <h6 class="ml-10 mt-2 mr-5"  style="font-size: 14px;">
                Renewable energy is becoming more popular in the Philippines. 
                As an alternative source of power and electricity, wind energy produces no waste 
                and it is beneficial both for the people and the environment. It was in 2008 when 
                the Department of Energy granted permission to Alternergy in creating a wind farm 
                in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns 
                and municipalities of Rizal and Laguna with clean source of energy.
           
                The construction of the windmills began by 2013, and the project were finished three 
                years after. The rise of Pililla Wind Farm provides not just electricity, but also a 
                boost in tourism in the municipality. The place became viral across social media, and 
                until today, many travelers visit this place to have a personal encounter with these 
                gigantic wind turbines.
            </h6>
        </div>
    </div>


</div>

<div class="flex mt-5 bg-cyan-200 border shadow-md" >
    <div>
       
    </div>
    <div >
        <img width="300" height="250" class="mt-12 ml-5" src="https://scontent.fmnl4-2.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?stp=dst-jpg_p480x480&_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=RhvRRldNoQ0AX-gx6qk&_nc_ht=scontent.fmnl4-2.fna&oh=00_AfDbYUHwQ788NiV0gQFQLcIa2frwc1QIGrxZjv2uj1hnSg&oe=641379E0">

        <div class="mb-5 ml-5 mt-2 text-xs" style="width: 250px;">Matagbak Rd. 1910 Pililla, Philippines</div>
    </div>
        <div class="mt-5">
            <h1 class="ml-10 font-bold">Lyger Animal Sanctuary - ZOO</h1>
        
        <div>
            <p class="ml-10 mt-2 mr-5" style="font-size: 14px;">
                "Lyger Animal Sanctuary is a local exotic animal sanctuary that houses some of the 
                world's rarest spec."</p>

            <p class="ml-10 mt-2 mr-5" style="font-size: 14px;">
                Open everyday (Mon-Sunday) even Holidays. Lyger Animal Sanctuary is a local exotic 
                animal sanctuary that houses some of the world's rarest species, including Ligers, Strawberry 
                tigers, white lions and indigenous Philippine Birds. Entrance fee for adult is 200 and 160 for Senior Citizen.
            </p>
        </div>
    </div>

</div>
</template>  -->
<template>
  <WrapperContent class="flex flex-col gap-5">
  <div v-for="data in arr" class="flex flex-col md:flex-row items-start shadow-lg bg-white rounded-lg">
     
    <!-- image -->
    <div class="flex-1 flex flex-col gap-3 items-start justify-between">
    <div :style="{ backgroundImage: `url(${data.imgSrc})` }" class="bg-no-repeat  bg-center h-[250px] mt-2 ml-2 md:w-[300px] lg:w-[500px] relative after:h-[50px] after:bottom-0 after:w-full after:bg-gradient-to-t after:from-black/30 after:to-white/10 after:absolute after:blur-sm"> </div>
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
      <button @click="showAddNewModal(data)" class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-end mt-20 uppercase">view </button>
    </div>
  </div>
 
  <!-- <AddModal :showAddModal="showAddNewModal" :isAddModal="isAddNewModal" v-if="isAddNewModal" /> -->
</WrapperContent>
</template>
<script setup>


        const arr = [{
              placeName:"Pililla Wind Farm",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            },
      {
              placeName:"Pililla Wind Farm",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              imgSrc: "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?stp=dst-jpg_p480x480&_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=vZzU1pyI1gIAX-769R_&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfAimQATg8SzNiIGyE-4nRqoGtM7Iv-aEOfqIBbpgMCvcQ&oe=64157420",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            },
      {
              placeName:"Pililla Wind Farm",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              imgSrc: "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            },
      {
              placeName:"Pililla Wind Farm",
              content:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
              imgSrc: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650",
              address: "Matagbak Rd. 1910 Pililla, Philippines"
            }]

      defineProps({
  showTourismModal: Function,
  data: Object
});

</script>