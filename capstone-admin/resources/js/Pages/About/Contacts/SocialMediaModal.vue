<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showSocialMediaModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Add new social media links</h4>
            <p class="text-sm text-gray-500">Add new social media links for contacts</p>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Facebook</span>
                    <p class="text-xs text-gray-500">add the new facebook link</p>
                    <div class="flex flex-row items-center">
                        <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Twitter</span>
                    <p class="text-xs text-gray-500">add the new twitter link</p>
                    <div class="flex flex-row items-center">
                        <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                </label>
                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Gmail</span>
                    <p class="text-xs text-gray-500">add the new gamail email</p>
                    <div class="flex flex-row items-center">
                        <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                </label>

                <!-- <input type="button" value="Add more"
                    class="text-xs text-center bg-white text-blue-500 font-bold py-1 px-2 border-[1px] border-blue-500 hover:bg-blue-500 hover:text-white rounded-lg uppercase cursor-pointer self-end"> -->
                <input type="submit" value="Save"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer">
            </form>
        </div>
    </div>
</template>
   
<script setup>
import { ref } from 'vue';


function submitFn(e) {
    e.preventDefault('you submit me');
}

defineProps({
    showSocialMediaModal: Function,

})
</script>