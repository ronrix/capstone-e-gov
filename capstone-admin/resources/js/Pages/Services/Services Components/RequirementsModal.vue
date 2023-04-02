<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showRequirementModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Add new requirement</h4>
            <p class="text-sm text-gray-500">Add new requirement for awareness of the citizen</p>
            <!-- form -->
            <!-- <div class="form"></div> -->
            <form @submit="submitFn" class="w-full mt-3 flex flex-col gap-3">
                <div ref="add">
                    <label class="flex flex-col w-full">
                        <p class="text-xs text-gray-500">add the new requirement</p>
                        <div class="flex flex-row items-center">
                            <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <div class="bg-white pl-2 mr-3"><button
                                    class="bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md">remove</button>
                            </div>
                        </div>

                    </label>
                </div>

                <input @click="addMore" type="button" value="Add more"
                    class="text-xs text-center bg-white text-blue-500 font-bold py-1 px-2 border-[1px] border-blue-500 hover:bg-blue-500 hover:text-white rounded-lg uppercase cursor-pointer self-end">
                <input type="submit" value="Save"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer">
            </form>
        </div>
    </div>
</template>
   
<script setup>
import { ref } from 'vue';




const add = ref(null)
function addMore() {
    const labels = document.createElement('label');
    const inputs = document.createElement('input');
    const p = document.createElement('p');
    const div1 =  document.createElement('div');
    const div2 =  document.createElement('div');
    const btn =  document.createElement('button');

    p.className = "text-xs text-gray-500";
    labels.className = "flex flex-row w-full";
    inputs.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600";
    btn.textContent = "remove";
    btn.className = "bg-red-100 text-red-600 hover:bg-red-600 hover:text-white px-3 text-sm rounded-md";
    div2.className = "bg-white pl-2 mr-3";
    div1.className = "flex flex-row items-center";

    p.textContent = "add the new requirment";
    labels.appendChild(p);
    div1.appendChild(inputs);
    div2.appendChild(btn);
    // added the div2 to div1
    div1.appendChild(div2)
    // added all elements to label
    labels.appendChild(div1);
    
    

    add.value.appendChild(div1);
}



function submitFn(e) {
    e.preventDefault('you submit me');
}

defineProps({
    showRequirementModal: Function,

})
</script>