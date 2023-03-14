<template>
    <WrapperContent>
        <div v-for="data in arr" class="card-img">
            <div class="img-ratio"><img class="pic1" :src="data.imgSrc"></div>
            <p class="place-name">{{ data.placeName }}</p>
            <div class="flex"> <i class="ml-1 uil uil-location-point text-cyan-400"></i><p class="address pt-1">{{ data.address }}</p></div>
           <button @click="showNewsModal(data)" style="float: right;" class="bg-blue-600 hover:bg-blue-500 px-3 py-2 text-white font-bold text-xs self-center mt-5 uppercase mb-2 mr-2">view </button>
        </div>
        
        
        
    </WrapperContent>
</template>
<script setup>

const arr = [{
    placeName: "Pililla Wind Farm",
    address: "Pililla Windmills - 54 MW Pililla Windfarm - Sitio Bugarin, Pililla Rizal",
    imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

},
    {
    placeName: "Mt. Sebrano",
    address: "99R6+574, Malaya Trail, Pililla, Rizal",
    imgSrc: "http://tarakahitsaan.com/images/spots/mt-sembrano-rizal.jpg"

    },
    {
    placeName: "Pililla Wind Farm",
    address: "Pililla Windmills - 54 MW Pililla Windfarm - Sitio Bugarin, Pililla Rizal",
    imgSrc: "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/17/cd/67/c8/vast-view-of-the-windmills.jpg?w=1000&h=-1&s=1"

    },
    {
    placeName: "St. Mary Magdalene Church",
    address: "Diocesan Shrine and Parish of St. Mary Magdalene - Imatong, Pililla, Rizal",
    imgSrc: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-011.jpg?w=650"

    },
    {
    placeName: "Bahay na Bato",
    address: "F8J4+8MG, Pililla, Rizal",
    imgSrc: "https://boyplakwatsa.files.wordpress.com/2014/04/rizal-tour-march-15-2014-orig-016.jpg"

    },
    {
    placeName: "Pililla Oval",
    address: "F8G8+F4Q, Bayan ng Pililla, Lalawigan ng Rizal",
    imgSrc: "https://lh3.googleusercontent.com/p/AF1QipPRhIWwjDgt5B4_SSlVH1H7u6ZhFxrzI99tEODy=s1600-w400"

    },
    {
    placeName: "CHRIST THE REDEEMER",
    address: "Niogan, Pililla Rizal",
    imgSrc: "https://scontent.fmnl25-2.fna.fbcdn.net/v/t1.6435-9/42959646_238629530151335_2789232954084163584_n.jpg?_nc_cat=111&ccb=1-7&_nc_sid=8bfeb9&_nc_eui2=AeETBr01BWL803J9tLwMAD_6T2PzFTIwsDFPY_MVMjCwMU1mrMZnmolLM_kJupCD0_qYddMaOWuXSDfPRBuXLfmT&_nc_ohc=Y6Bx06NsEH8AX884gGt&_nc_ht=scontent.fmnl25-2.fna&oh=00_AfA0wCs9h4M1qbqO9RjdyOynBrsVTN0a4MfLH6DiFI1E_Q&oe=6437C55D"

    },
    {
    placeName: "Lyger Animal Sanctuary - ZOO",
    address: "Matagbak Rd, Pililla, Rizal",
    imgSrc: "https://scontent.fmnl25-3.fna.fbcdn.net/v/t39.30808-6/274579439_2419634788171057_6700194066240640258_n.jpg?stp=dst-jpg_p480x480&_nc_cat=106&ccb=1-7&_nc_sid=e3f864&_nc_eui2=AeHUaaI-kyM3lhpYUkNDvkobeTkfTFeFN5F5OR9MV4U3kV80MePrW1SKq06pbp3sW46NZSuH74c8GFQv_JGBw2PG&_nc_ohc=vZzU1pyI1gIAX-769R_&_nc_ht=scontent.fmnl25-3.fna&oh=00_AfAimQATg8SzNiIGyE-4nRqoGtM7Iv-aEOfqIBbpgMCvcQ&oe=64157420"

    }]

    defineProps({
  showNewsModal: Function,
  data: Object
});

</script>
<style scoped>
    .img-ratio{
        aspect-ratio: 1/1;
    }
    .pic1 {
        margin-left: 6px;
        margin-top: 6px;
        width: 260px;
 
        
    }
  
    .address{
        
        margin-bottom: 5px;
        font-size: 10px;
        width: 260px 
        
    }
    .place-name {
        font-weight: bold;
        margin-left: 5px;
        margin-top: 10px;
        margin-bottom: 3px;
        width: 250px 

    }
    .card-img{
        
        width: 270px;
        display: inline-block;
        margin-right: 10px;
        background-color: rgb(255, 255, 255);
        margin-bottom: 10px;
        border-radius: 5px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        transition: .5s;
    }
    .card-img:hover{
        transform: scale(1.1); 
		
    }

   
</style>