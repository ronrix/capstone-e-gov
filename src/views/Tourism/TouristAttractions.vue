<script setup>
import HeaderSection from '../../components/Header/HeaderSection.vue'
import FooterSection from '../../components/FooterSection/FooterSection.vue'

 const sample_data = [{
            placeName: 'Pililla Wind Farm',
            address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
            imgSrc:
            'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1',
            date: 'April 13, 2023'
        },
        {
            placeName: 'Pililla Wind Farm',
            address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
            imgSrc:
            'https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=-BS42dF_KM8AX-pnn5m&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfADlapiutu3bBB5gJvkeC6s2ZiZuVJ6Rf_l2O8AxoadSA&oe=643B06E0',
            date: 'April 13, 2023'
        },
        {
            placeName: 'Pililla Wind Farm',
            address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
            imgSrc:
            'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1',
            date: 'April 13, 2023'
        },
        {
            placeName: 'Pililla Wind Farm',
            address: 'F8CX+VJW, Manila E Rd, Pililla, Rizal',
            imgSrc:
            'https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=-BS42dF_KM8AX-pnn5m&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfADlapiutu3bBB5gJvkeC6s2ZiZuVJ6Rf_l2O8AxoadSA&oe=643B06E0',
            date: 'April 13, 2023'
        },]

</script>
<template>
    <HeaderSection></HeaderSection>
    <div class="flex justify-between p-28 pt-5">
       <div>
        <h1 class="text-2xl font-semibold pb-5">Tourist Attractions</h1>
        <p>CHURCH</p>
        <P class="text-2xl font-semibold w-80">The Diocesan Shrine and Parish of St. Mary Magdalene</P>
        <img src="https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg" alt="">
       <p class="text-sm w-[750px] mt-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
    </div>
       <div 
        class="" style="
          border-left: 2px solid gray;
          right: 50%;
          height: auto;
          padding-left: 35px;
          
        
        ">
        <h2 class="mb-3 text-xl font-semibold">SUGGESTIONS</h2>
        <div class="flex flex-col gap-5">
        <div v-for="(data, idn) in sample_data" :key="idn" class="group">
            <div class=" flex h-auto w-96 bg-white drop-shadow-md group-hover:opacity-80">
                <div class="w-80">
                    <img class="object-cover w-full h-40 " :src="data.imgSrc" alt="" />
                </div>
                    <div class="grid p-2">
                        <h2 class="font-semibold">{{ data.placeName }}<span class="block text-xs font-normal">{{ data.date }}</span></h2>
                        <p class="text-sm">Lorem Ipsum is simply dummy text of the printing and typeset</p>
                    </div>
                
        </div>
        </div>
        </div>
       </div>
    </div>
    <FooterSection></FooterSection>
</template>

<style>
    
</style>