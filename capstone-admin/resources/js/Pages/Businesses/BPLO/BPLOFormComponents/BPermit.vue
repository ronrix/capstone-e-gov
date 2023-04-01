<template>
    <div class="flex flex-col p-2 bg-white rounded-md">
        <div class="flex items-center">
            <input type="text" v-model="title" class="font-bold text-xl text-gray-500 mr-5 uppercase outline-blue-600" />
            <!-- line -->
            <div class="border flex-1"></div>
        </div>

        <WrapperReq>
            <BList v-for="list, idx in requirements" :id="idx" :title="list" />
        </WrapperReq>
    </div>
</template>

<script setup>
import BList from './BList.vue';

defineProps({
   title: String,
   requirements: Array 
})
</script>