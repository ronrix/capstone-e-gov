<template>
    <div class="fixed top-0 right-0 bottom-0 left-0 flex items-center justify-center bg-black bg-opacity-20 z-20">
        <div class="div1 bg-white sm:w-[700px] p-5 rounded-lg relative flex flex-col items-start">
            <!-- close btn -->
            <i @click="showContactsModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>
            <h4 class="font-bold text-xl text-gray-900">Add new contacts</h4>
            <p class="text-sm text-gray-500">Add new requirement for awareness of the citizen</p>
            <!-- form -->
            <form @submit="submitFn" class="w-full mt-3 flex flex-col gap-3">

                <label class="flex flex-col w-full">
                    <span class="font-bold text-gray-500">Department</span>
                    <p class="text-xs text-gray-500">add the a department name</p>
                    <div class="flex flex-row items-center">
                        <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                    </div>
                </label>
                <div ref="add">
                    <label class="flex flex-col w-full">
                        <span class="font-bold text-gray-500">Mobile Number</span>
                        <p class="text-xs text-gray-500">add the a new mobile number</p>
                        <div class="flex items-center gap-2">
                            <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <button @click="addMore" type="buttton">
                                <i  class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-500" ></i>
                            </button>
                        </div>
                    </label>

                    <label class="flex flex-col w-full">
                        <span class="font-bold text-gray-500">Telephone Number</span>
                        <p class="text-xs text-gray-500">add the a new telephone number</p>

                        <div class="flex flex-row items-center gap-2">
                            <input type="text" class="border w-full p-2 rounded-lg focus:outline-blue-600">
                            <button @click="addMore">
                                <i  class="uil uil-plus-square text-2xl text-blue-600 hover:text-blue-400" ></i>
                            </button>
                        </div>
                    </label>
                </div>
                <input type="submit" value="Save"
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold p-2 rounded-lg uppercase cursor-pointer">
            </form>
        </div>
    </div>
</template>
   
<script setup>
import { ref } from 'vue';




const add = ref(null)
// const btn = ref(null)

function addMore(e) {
    // console.log( e.target.parentElement);
    parent = e.target.parentElement.parentElement.parentElement;
        append(parent)

}



function append(parentElement) {
    const labels = document.createElement('label');
    const inputs = document.createElement('input');
    const p = document.createElement('p');
    const div1 = document.createElement('div');
    const div2 = document.createElement('div');
    const remove = document.createElement('button');

    p.className = "text-xs text-gray-500";
    labels.className = "flex flex-col w-full";
    inputs.className = "mt-3 border w-full p-2 rounded-lg focus:outline-blue-600";
    remove.innerHTML = `<i class="uil uil-times-square"></i>`;
    remove.className = "text-2xl text-blue-600 ml-1 hover:text-blue-400";
    div1.className = "flex flex-row items-center";

    p.textContent = "add the new requirment";
    labels.appendChild(p);
    div1.appendChild(inputs);
    div1.appendChild(remove);
    // added the div2 to div1
    div1.appendChild(div2)
    // added all elements to label
    labels.appendChild(div1);

     (parentElement).appendChild(div1);
    // console.log(remove);

    remove.addEventListener('click', function(){
       (parentElement).removeChild((parentElement).lastElementChild);
    })
}
function submitFn(e) {
    e.preventDefault();
    // console.log(added.value);
}

defineProps({
    showContactsModal: Function,
    append: Function,
    submitFn: Function,


})
</script>