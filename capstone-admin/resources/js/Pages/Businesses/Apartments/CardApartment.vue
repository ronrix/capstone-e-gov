<template>
    <div class="flex">
        <button @click="showPreviewModal(data)">
    <div class="card1 flex flex-col h-[200px] w-full md:w-auto">
        <!---Image-->
        <div :style="{ backgroundImage: `url(${data.img})` }"
            class="rounded-md bg-no-repeat bg-cover bg-center h-[150px] relative">
        </div>
        <!--content-->
        <div class="p-4 flex-1 flex flex-col justify-between">
            <h3 class="apartment-name font-bold uppercase text-xl tracking-wide">{{ data.title }}</h3>
            <h5 class="text-xs text-gray-500 font-bold tracking-wide text-center">{{ data.type }}</h5>
            
        </div>
    </div>
    </button>
</div>
</template>

<script setup>
defineProps({
    showPreviewModal: Function,
    data: Object
});
</script>

<style scoped>
.APcontent {
    margin-bottom: 5px;
    width: 260px
}

.apartment-name {
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