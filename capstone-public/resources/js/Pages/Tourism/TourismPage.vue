<template>
    <div class="grid place-items-center mt-10 justify-center">
        <div class="text-center w-[400px] ">
            <p class="text-3xl font-semibold font-['display']"><span style="color: rgb(185, 43, 39);">Travel</span> Around the beautiful places in Pililla</p>
        </div>
        <div class="flex relative">
           <div class="mt-6 ">
            <div class="w-[325px] h-[325px] rounded-full opacity-[12%]" style="background-color: rgb(185, 43, 39);"></div>
            <div class="w-[250px] h-[250px] absolute left-10  top-16 rounded-full opacity-[34%]" style="background-color: rgb(185, 43, 39); "></div>
           </div>
            <img class="w-[210px] absolute right-36 top-3" src="https://www.pngaaa.com/api-download/1853846" alt="">
            <img class="w-[200px] absolute left-32 " src="https://png2.cleanpng.com/dy/fe5917c0144c3493c36b68db062ae2c4/L0KzQYm3V8AzN6FvfZH0aYP2gLBuTgRzaadqhJ95YXPucbjsTgRwfaMyj9H2YX6werL3gf4ufpJoeeZyb36wgrL0hgNpf5J3ed82ZHX5crn2jB1qNWZnS9NrOHW1dba9Vcg5NmM3UKYAMUK8QYa6UMU4PWE8TKsCNkWxgLBu/kisspng-travel-package-tour-woman-japan-vacation-rameshwaram-devbhoomi-5b3ab8e2ee6588.2284512915305750749765.png" alt="">
        </div>
        <div class="flex gap-32 h-auto w-[1200px] absolute top-[320px] text-center p-5 text-white" style="background-color: rgb(185, 43, 39);">
            <p class="text-[13px] font-['montserrat']" style="border-right: 2px solid white; right: 50%; height: 50px; padding-right: 35px;">Travel around Pililla to the beauty  of nature easily and safely.</p>
            <p class="text-[16px] font-['display'] ">Better Pililla A better community A better Home</p>
            <p class="text-[13px] font-['montserrat']" style="border-left: 2px solid white; right: 50%; height: 50px; padding-left: 35px;">“ Pamunuang mapagmahal at mapagkalinga ”</p>
        </div>
        <div>
        <img class="w-[1200px]" src="https://pilillarizal.gov.ph/wp-content/uploads/2022/10/pililla_painting-1024x326.png" alt="">
    
        </div>
    </div>
    <div class="flex justify-between items-center pr-[75px] pl-[75px]">
        <p class="font-['display']  text-[30px] font-semibold w-72 mt-10">Find your best destination.</p>
    <div class="pt-8">
        <p class="text-[12px]">We have more destination you can</p>
        <input class="h-9 w-72 pl-3 drop-shadow-md rounded-2xl outline-cyan-300 text-[12px] bg-gray-100 " type="text" placeholder="Search destinations">
    </div>
    </div>
    <div class="flex flex-row flex-wrap mt-4 p-20 pt-0 justify-between gap-y-8 ">
    <div v-for="data in sample_data" >
        <div class="w-[350px] h-[300px] drop-shadow-md bg-white">
          <div class="w-auto h-[200px]">
            <img :src="data.imgSrc" alt="">
          </div>
                <p>{{ data.placeName }}</p>
                <p>{{ data.address }}</p>
        </div>
    </div>
</div>
</template>
<script setup>

const sample_data = [{
        
    placeName: "Pililla Wind Farm",
    address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
    imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"
},
{
        
        placeName: "Pililla Wind Farm",
        address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
        imgSrc: "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?stp=dst-jpg_p480x480&_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=-BS42dF_KM8AX-T8CbR&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfBWtocuUN4QqH_vmhmjJv5BVuDYSIP-lB1UZeVSKAmZNg&oe=643B06E0"
    },
    {
        
        placeName: "Pililla Wind Farm",
        address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
        imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"
    },
    {
        
        placeName: "Pililla Wind Farm",
        address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
        imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"
    },
    {
        
        placeName: "Pililla Wind Farm",
        address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
        imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"
    },
    {
        
        placeName: "Pililla Wind Farm",
        address: "F8CX+VJW, Manila E Rd, Pililla, Rizal",
        imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"
    },
    
    
]


</script>

<style>
    
</style>