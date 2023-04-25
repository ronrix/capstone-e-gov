<template>
    <ImgPreview v-if="isPreviewImg" :img-src="selectedImg" :close-img-preview="toggleImgPreview" />
    <div class="fixed top-0 left-0 right-0 bottom-0 bg-black/20 flex items-center justify-center z-30">
        <form @submit.prevent="onAccept" class="backdrop-blur-xl bg-white/70 p-5 rounded-lg flex-col flex border w-[500px]">
            <!-- close modal btn -->
            <i @click="closeModal"
                class="uil uil-times text-black hover:text-blue-500 text-xl absolute top-0 right-2 cursor-pointer"></i>

            <div class="flex">
                <div class="flex-1">
                    <h3 class="font-bold">Verify the request</h3>
                    <p class="font-[500] text-xs mt-2">Author: </p>
                    <h5 class="underline capitalize">{{ selectedData.author }}</h5>

                    <p class="font-[500] text-xs mt-2">Email: </p>
                    <h5 class="underline">{{ selectedData.email }}</h5>

                    <p class="font-[500] text-xs mt-2">Type of request: </p>
                    <h5 class="underline">{{ selectedData.type_of_request }}</h5>

                    <p class="font-[500] text-xs mt-2">Company name: </p>
                    <h5 class="underline capitalize">{{ JSON.parse(selectedData.data).companyName }}</h5>

                    <p class="font-[500] text-xs mt-2">Business location: </p>
                    <h5 class="underline capitalize">{{ JSON.parse(selectedData.data).location }}</h5>

                    <p class="font-[500] text-xs mt-2">Description: </p>
                    <div class="line-clamp-2 max-h-[120px] overflow-y-auto scrollbar">{{
                        JSON.parse(selectedData.data).description
                    }}
                    </div>

                    <p class="font-[500] text-xs mt-2">View pdf:</p>
                    <a href="" target="_blank" class="underline">{{ JSON.parse(selectedData.data).proofFiles }}</a>
                </div>

                <div class="overflow-y-auto scrollbar w-[150px]">
                    <p class="font-[500] text-xs mt-2">pictures: </p>
                    <div class="flex items-center flex-wrap">
                        <div class="relative group" v-for="img in JSON.parse(selectedData.data).imgs" :key="img">
                            <img class="w-[120px] object-cover" :src="img">
                            <div
                                class="absolute top-0 left-0 right-0 bottom-0 hidden group-hover:flex items-center justify-center bg-black/40">
                                <button @click="toggleImgPreview(img)" type="button"
                                    class="border text-xs text-white px-2">view</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="self-end mt-3 flex items-center">
                <button @click="onDecline(selectedData.id)" type="button"
                    class="px-3 py-1 border border-gray-500 text-sm hover:bg-gray-300">
                    <Loading class="w-4 h-4" v-if="isDeclineSubmit" />
                    <i v-if="!isDeclineSubmit" class="uil uil-times-circle mr-1"></i>
                    <span v-if="!isDeclineSubmit">decline</span>
                </button>
                <button type="submit" class="px-3 py-1 border border-gray-500 text-sm bg-green-500 ml-1">
                    <Loading class="w-4 h-4" v-if="isAcceptSubmit" />
                    <i v-if="!isAcceptSubmit" class="uil uil-check-circle mr-1"></i>
                    <span v-if="!isAcceptSubmit">accept</span>
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { onMounted, onUnmounted } from 'vue';
import { ref } from 'vue';
import ImgPreview from '../../Components/ImgPreview.vue';
import Loading from '../../Components/Loading.vue';
import emailjs from "@emailjs/browser";
import { businessDeclinedMsg, businessAcceptMsg, jobAcceptMsg, jobDeclinedMsg } from "../../config/email-msg";

const selectedImg = ref("");
const isPreviewImg = ref(false);
const isAcceptSubmit = ref(false);
const isDeclineSubmit = ref(false);

// sending email to the requester on the update of their request
function sendEmail(msg) {
    const emailJSForm = {
        to_email: selectedData.email,
        to_name: selectedData.author,
        message: msg,
    };

    emailjs.send(import.meta.env.VITE_EMAILJS_SERVIER_ID, import.meta.env.VITE_EMAILJS_TEMPLATE_ID, emailJSForm, import.meta.env.VITE_EMAILJS_PUBLIC_KEY)
        .then((result) => {
            console.log('SUCCESS!', result.text);
        }, (error) => {
            console.log('FAILED...', error.text);
        });
}

// decline post request fetching
function onDecline(id) {
    isDeclineSubmit.value = true;
    declineRequest(id).then(() => {
        // send an email after deleting the request 
        if (selectedData.type_of_request === 'business') {
            sendEmail(businessDeclinedMsg);
        }
        else {
            sendEmail(jobDeclinedMsg);
        }
        isDeclineSubmit.value = false;
    });
}

// accept post request fetching 
function onAccept() {
    isAcceptSubmit.value = true;
    acceptRequet(selectedData.id).then(() => {
        // send an email after accepting the request 
        if (selectedData.type_of_request === 'business') {
            sendEmail(businessAcceptMsg);
        }
        else {
            sendEmail(jobAcceptMsg);
        }
        isAcceptSubmit.value = false;
    });
}

function toggleImgPreview(img) {
    selectedImg.value = img;
    isPreviewImg.value = !isPreviewImg.value;
}

// remove the scrolling effect when this modal is visible
onMounted(() => {
    document.body.classList.add("overflow-hidden");
});
onUnmounted(() => {
    document.body.classList.remove("overflow-hidden");
});


const { acceptRequet, declineRequest, selectedData } = defineProps({
    closeModal: Function,
    selectedData: Object,
    acceptRequet: Function,
    declineRequest: Function,
});
</script>