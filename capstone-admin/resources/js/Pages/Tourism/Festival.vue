<template>
  <WrapperContent class="flex flex-col gap-5">

      <div class="flex items-start gap-5 justify-start flex-wrap">
          <!-- card -->
          <div v-for="data in arr" class="card1 flex flex-col h-[330px] w-full md:w-auto">
              <img class="text-center h-[150px]" :src="data.imgSrc">
              <div class="h-[100px]"></div>
              
          </div>
      </div>
      <div v-for="data in content_data" class="flex flex-col md:flex-row items-start shadow-lg bg-white rounded-lg">
    <!-- contentBox -->
    <div class="flex-1 p-5 flex flex-col items-start justify-between">
      <h3 class="font-bold uppercase text-xl tracking-wide">{{ data.Festival }}</h3>
      <p class="mt-3 text-ellipsis text-sm h-[100px] overflow-hidden">
        {{ data.content2 }}
      </p>
    </div>
  </div>
    </WrapperContent>
</template>

<script setup>
const arr = [{

        imgSrc: "https://cdn271.picsart.com/41f9d848-d6f8-4be2-bbfd-19cfa9ae0791/412873726059201.jpg?type=webp&to=min&r=200"

        },
        {
        imgSrc: "https://cdn271.picsart.com/41f9d848-d6f8-4be2-bbfd-19cfa9ae0791/412873726059201.jpg?type=webp&to=min&r=200"

        },
        {
        imgSrc: "https://cdn271.picsart.com/41f9d848-d6f8-4be2-bbfd-19cfa9ae0791/412873726059201.jpg?type=webp&to=min&r=200"

        }]
        const content_data = [{
                      Festival:"Kal'baw Festival",
                      content2:"Renewable energy is becoming more popular in the Philippines. As an alternative source of power and electricity, wind energy produces no waste and it is beneficial both for the people and the environment. It was in 2008 when the Department of Energy granted permission to Alternergy in creating a wind farm in the mountain slopes of Pililla, Rizal. Its purpose is to serve the nearby towns and municipalities of Rizal and Laguna with clean source of energy.",
                      
                    }]
        </script>
        <style scoped>
        .address {
            margin-bottom: 5px;
            width: 260px
        }

        .place-name {
            margin-top: 0.5em;
            font-weight: bold;
            margin-left: 5px;
            margin-bottom: 5px;
            width: 250px
        }

        .card1 {
            /* padding: 0.5em; */
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            transition: .5s;
        }

        .card1:hover {
            transform: scale(1.05);

        }
        </style>