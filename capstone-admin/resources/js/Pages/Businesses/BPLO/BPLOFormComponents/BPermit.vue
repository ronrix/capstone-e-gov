<template>
    <div class="flex flex-col p-2 bg-white rounded-md">
        <div class="flex items-center">
            <span class="font-bold text-xl text-gray-500 mr-5 uppercase">{{ title }}</span>
            <!-- line -->
            <div class="border flex-1"></div>
        </div>

        <WrapperReq>
            <BList v-for="list in requirements" :title="list" />
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