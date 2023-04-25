<template>
    <div @click="showDisplayRequestModal(notif)"
        class="border border-gray-400 w-full p-5 flex items-center group hover:bg-blue-500 hover:text-white cursor-pointer duration-100"
        :class="{ 'bg-blue-600 text-white': notif.status }">
        <div>
            <p class="text-xs text-gray-600 group-hover:text-slate-100" :class="{ 'text-slate-200': notif.status }">{{
                relTime
            }}</p>
            <h5 class="font-[500] text-base">Request to post on the
                {{ request }}
            </h5>

            <!-- from -->
            <div class="flex items-center gap-2 mt-3">
                <i class="uil uil-user text-sm"></i>
                <span class="capitalize text-sm">{{ notif.author }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import moment from "moment";

const relTime = moment(notif.created_at).fromNow();
const request = notif.type_of_request.toLowerCase() !== "business" ? "job opportunities" : "business";

const { notif } = defineProps({
    showDisplayRequestModal: Function,
    notif: Object
});
</script>