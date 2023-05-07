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
                    <p class="font-[500] text-xs mt-2">Author:</p>
                    <h5 class="underline capitalize">{{ selectedData?.author }}</h5>

                    <p class="font-[500] text-xs mt-2">Email:</p>
                    <h5 class="underline">{{ selectedData?.email }}</h5>

                    <p class="font-[500] text-xs mt-2">Company name: </p>
                    <h5 class="underline capitalize">{{ JSON.parse(selectedData?.data)?.companyName }}</h5>

                    <div v-if="selectedData?.type_of_request !== 'business'">
                        <p class="font-[500] text-xs mt-2">Salary:</p>
                        <h5 class="underline capitalize">
                            {{ new Intl.NumberFormat("en-US", {
                                style: "currency", currency: "php"
                            }).format(JSON.parse(selectedData?.data).salary) }}
                        </h5>
                    </div>

                    <div v-if="selectedData?.type_of_request !== 'business'">
                        <p class="font-[500] text-xs mt-2">Schedules:</p>
                        <div class="flex items-center gap-2">
                            <h5 class="underline capitalize" v-for="(sche, id) in JSON.parse(selectedData?.data).schedules"
                                :key="id">
                                {{ sche }},
                            </h5>
                        </div>
                    </div>

                    <p class="font-[500] text-xs mt-2">Description:</p>
                    <div class="line-clamp-2 h-[100px] max-h-[120px] overflow-y-auto scrollbar">
                        {{
                            JSON.parse(selectedData?.data)?.description
                        }}
                    </div>

                    <p class="font-[500] text-xs mt-2">View pdf:</p>
                    <a :href="be_url + '/' + JSON.parse(selectedData?.data)?.proofFiles" target="_blank"
                        class="underline">{{
                            JSON.parse(selectedData?.data)?.proofFiles
                        }}</a>
                </div>

                <div class="overflow-y-auto scrollbar w-[150px]">
                    <p class="font-[500] text-xs mt-2">pictures:</p>
                    <div class="flex items-center flex-wrap">
                        <div class="relative group" v-for="img in imgs" :key="img">
                            <img class="w-[120px] object-cover" :src="img" />
                            <div
                                class="absolute top-0 left-0 right-0 bottom-0 hidden group-hover:flex items-center justify-center bg-black/40">
                                <button @click="toggleImgPreview(img)" type="button" class="border text-xs text-white px-2">
                                    view
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="self-end mt-3 flex items-center">
                <button @click="onDecline(selectedData?.id)" type="button"
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
import { onMounted, onUnmounted } from "vue";
import { ref } from "vue";
import ImgPreview from "./ImgPreview.vue";
import Loading from "./Loading.vue";
import emailjs from "@emailjs/browser";
import {
    businessDeclinedMsg,
    businessAcceptMsg,
    jobAcceptMsg,
    jobDeclinedMsg,
} from "../config/email-msg";
import { be_url } from "../config/config";

const selectedImg = ref("");
const isPreviewImg = ref(false);
const isAcceptSubmit = ref(false);
const isDeclineSubmit = ref(false);
const imgs = selectedData ? JSON.parse(selectedData?.data).imgs : [];

// sending email to the requester on the update of their request
function sendEmail(msg, companyName) {
    const emailJSForm = {
        to_email: selectedData.email,
        to_name: selectedData.author,
        message: msg,
        company_name: companyName,
    };

    emailjs
        .send(
            import.meta.env.VITE_EMAILJS_SERVIER_ID,
            import.meta.env.VITE_EMAILJS_TEMPLATE_ID,
            emailJSForm,
            import.meta.env.VITE_EMAILJS_PUBLIC_KEY
        )
        .then(
            (result) => {
                console.log("SUCCESS!", result.text);
            },
            (error) => {
                console.log("FAILED...", error.text);
            }
        );
}

// decline post request fetching
function onDecline(id) {
    isDeclineSubmit.value = true;
    declineRequest(id)
        .then((data) => {
            if (data.res.status === 400) { // don't send the email if error occurs
                isDeclineSubmit.value = false
                return;
            }
            // send an email after deleting the request
            const companyName = selectedData?.data?.companyName
                ? selectedData?.data?.companyName
                : JSON.parse(selectedData?.data)?.companyName;
            if (selectedData.type_of_request === "business") {
                sendEmail(businessDeclinedMsg, ompanyName);
            } else {
                sendEmail(jobDeclinedMsg, companyName);
            }
            isDeclineSubmit.value = false;
            closeModal();
        })
        .catch(() => (isDeclineSubmit.value = false));
}

// accept post request fetching
function onAccept() {
    isAcceptSubmit.value = true;
    acceptRequest(selectedData.id)
        .then((data) => {
            if (data.res.status === 400) { // don't send the email if error occurs
                isAcceptSubmit.value = false;
                return;
            }
            // send an email after accepting the request
            const companyName = selectedData?.data?.companyName
                ? selectedData?.data?.companyName
                : JSON.parse(selectedData?.data)?.companyName;
            if (selectedData.type_of_request === "business") {
                sendEmail(businessAcceptMsg, companyName);
            } else {
                sendEmail(jobAcceptMsg, companyName);
            }
            isAcceptSubmit.value = false;
            closeModal();
        })
        .catch(() => (isDeclineSubmit.value = false));
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

const { acceptRequest, declineRequest, selectedData, closeModal } = defineProps(
    {
        closeModal: Function,
        selectedData: Object,
        acceptRequest: Function,
        declineRequest: Function,
    }
);
</script>